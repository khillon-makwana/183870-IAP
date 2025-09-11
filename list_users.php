<?php
require 'ClassAutoLoad.php';

try {
    $dsn = "mysql:host={$conf['db_host']};port={$conf['db_port']};dbname={$conf['db_name']}";
    $pdo = new PDO($dsn, $conf['db_user'], $conf['db_pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, name, email, is_verified FROM users ORDER BY id ASC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}

$ObjLayout->header($conf);
$ObjLayout->nav($conf);
?>
<div class="container mt-5">
    <h2>Registered Users</h2>
    <ol>
        <?php foreach ($users as $user): ?>
            <li>
                <?php echo htmlspecialchars($user['name']); ?> 
                (<?php echo htmlspecialchars($user['email']); ?>) 
                <?php echo $user['is_verified'] ? " Verified" : " Not Verified"; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
<?php
$ObjLayout->footer($conf);
