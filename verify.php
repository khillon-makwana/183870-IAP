<?php
require 'ClassAutoLoad.php';

if (isset($_GET['email'])) {
    $email = urldecode($_GET['email']);

    try {
        $dsn = "mysql:host={$conf['db_host']};port={$conf['db_port']};dbname={$conf['db_name']}";
        $pdo = new PDO($dsn, $conf['db_user'], $conf['db_pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if email exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['is_verified'] == 1) {
                $message = "Your account is already verified!";
            } else {
                // Update verification
                $stmt = $pdo->prepare("UPDATE users SET is_verified = 1 WHERE email = ?");
                $stmt->execute([$email]);
                $message = "Your account has been successfully verified!";
            }
        } else {
            $message = "Invalid verification link.";
        }
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
    }
} else {
    $message = "No verification link provided.";
}

$ObjLayout->header($conf);
$ObjLayout->nav($conf);
?>
<div class="container mt-5">
  <div class="alert alert-info">
    <?php echo htmlspecialchars($message); ?>
  </div>
</div>
<?php
$ObjLayout->footer($conf);
