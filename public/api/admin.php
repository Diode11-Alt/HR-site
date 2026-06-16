<?php
session_start();
require_once 'config.php';

if (isset($_POST['password'])) {
    if ($_POST['password'] === ADMIN_PASSWORD) {
        $_SESSION['authenticated'] = true;
    } else {
        $error = "Incorrect password.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PrimePath Admin Login</title>
    <style>
        body { font-family: system-ui; background: #f8fafc; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; }
        input[type="password"] { width: 100%; padding: 0.8rem; margin: 1rem 0; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        button { background: #0f172a; color: white; border: none; padding: 0.8rem; width: 100%; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .error { color: #ef4444; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Portal</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="password" name="password" placeholder="Enter Admin Password" required>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>
<?php
    exit();
}

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
    $inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $db_error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PrimePath Leads</title>
    <style>
        body { font-family: system-ui; background: #f8fafc; margin: 0; padding: 2rem; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 2rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 1rem; border-bottom: 1px solid #e2e8f0; }
        th { background: #f1f5f9; color: #0f172a; }
        .error-card { background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 1rem; border-radius: 4px; }
        a.logout { color: #ef4444; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Captured Inquiries</h1>
            <a href="?logout=1" class="logout">Log Out</a>
        </div>

        <?php if (isset($db_error)): ?>
            <div class="error-card">
                <strong>Database Connection Error:</strong> <?php echo htmlspecialchars($db_error); ?><br><br>
                Please ensure you have created the MySQL database in cPanel and updated <code>config.php</code> with the correct credentials.
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($inquiries)): ?>
                        <tr><td colspan="5">No inquiries found yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($inquiries as $inq): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($inq['created_at']); ?></td>
                                <td><?php echo htmlspecialchars($inq['name']); ?></td>
                                <td><a href="mailto:<?php echo htmlspecialchars($inq['email']); ?>"><?php echo htmlspecialchars($inq['email']); ?></a></td>
                                <td><?php echo htmlspecialchars($inq['phone']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($inq['message'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
