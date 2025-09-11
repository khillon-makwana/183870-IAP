<?php
require 'ClassAutoLoad.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        try {
            $dsn = "mysql:host={$conf['db_host']};port={$conf['db_port']};dbname={$conf['db_name']}";
            $pdo = new PDO($dsn, $conf['db_user'], $conf['db_pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insert into DB
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);

            // Send verification email
            $verifyLink = $conf['site_url'] . "/verify.php?email=" . urlencode($email);
            $mailCnt = [
                'name_from' => 'ICS 2.2 System',
                'email_from' => 'no-reply@icsccommunity.com',
                'name_to' => $name,
                'email_to' => $email,
                'subject' => 'Welcome to ICS 2.2! Account Verification',
                'body' => "
                    Hello $name,<br><br>
                    You requested an account on ICS 2.2.<br>
                    In order to use this account you need to <a href='$verifyLink'>click here</a> to complete the registration process.<br><br>
                    Regards,<br>
                    Systems admin<br>
                    ICS 2.2
                "
            ];
            $ObjSendMail->Send_Mail($conf, $mailCnt);

            $success = "Signup successful! Please check your email to verify your account.";
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}


$ObjLayout->header($conf);
$ObjLayout->nav($conf);
$ObjLayout->banner($conf);
?>

<div class="container mt-4">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
</div>

<?php
$ObjLayout->form_content($conf, $ObjForm);
$ObjLayout->footer($conf);