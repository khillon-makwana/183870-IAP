<?php
class Auth {
    public function signup($conf, $ObjFncs) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {

            $errors = [];

            // --- Gather and sanitize input ---
            $fullname = $_SESSION['fullname'] = ucwords(strtolower(trim($_POST['fullname'])));
            $email    = $_SESSION['email']    = strtolower(trim($_POST['email']));
            $password = $_SESSION['password'] = $_POST['password'];

            // --- Validations ---
            if (!preg_match("/^[a-zA-Z-' ]*$/", $fullname)) {
                $errors['nameFormat_error'] = "Only letters and spaces allowed.";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['mailFormat_error'] = "Invalid email format.";
            }
            $emailDomain = substr(strrchr($email, "@"), 1);
            if (!in_array($emailDomain, $conf['valid_email_domains'])) {
                $errors['emailDomain_error'] = "Invalid email domain.";
            }
            if (strlen($password) < $conf['min_password_length']) {
                $errors['passwordLength_error'] =
                    "Password must be at least {$conf['min_password_length']} characters.";
            }

            if (!empty($errors)) {
                $ObjFncs->setMsg('errors', $errors, 'danger');
                $ObjFncs->setMsg('msg', 'Please fix the errors below and try again.', 'danger');
                return;
            }

            // --- DB insert and mail ---
            try {
                $dsn = "mysql:host={$conf['db_host']};port={$conf['db_port']};dbname={$conf['db_name']}";
                $pdo = new PDO($dsn, $conf['db_user'], $conf['db_pass']);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Check for duplicate email
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetchColumn() > 0) {
                    $ObjFncs->setMsg('msg', 'This email is already registered.', 'danger');
                    return;
                }

                // Insert user
                $stmt = $pdo->prepare(
                    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
                );
                $stmt->execute([$fullname, $email, password_hash($password, PASSWORD_DEFAULT)]);

                // Send verification email
                global $ObjSendMail;
                $verifyLink = $conf['site_url'] . "/verify.php?email=" . urlencode($email);
                $mailCnt = [
                    'name_from' => 'ThoughtNest System',
                    'email_from' => 'no-reply@icsccommunity.com',
                    'name_to' => $fullname,
                    'email_to' => $email,
                    'subject' => 'Welcome to ThoughtNest! Account Verification',
                    'body'    => "
                        Hello $fullname,<br><br>
                        You requested an account in ThoughtNest.<br>
                        Please <a href='$verifyLink'>click here</a> to verify your account.<br><br>
                        Regards,<br>Systems admin<br>ThoughtNest
                    "
                ];
                $ObjSendMail->Send_Mail($conf, $mailCnt);

                $ObjFncs->setMsg('msg',
                    'Signup successful! Please check your email to verify your account.',
                    'success'
                );
                unset($_SESSION['fullname'], $_SESSION['email'], $_SESSION['password']);
                header('Location: signup.php');
                exit;

            } catch (PDOException $e) {
                $ObjFncs->setMsg('msg', 'Database error: ' . $e->getMessage(), 'danger');
            }
        }
    }
}
