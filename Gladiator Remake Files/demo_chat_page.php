<?php
session_start();
$_SESSION['user'] = 'Tolis';
$_SESSION['id'] = 1;
?>
<html>
<head><title>Chat Demo</title></head>
<body>
<h2>Demo Σελίδα Chat</h2>
<?php include 'chat_component.php'; ?>
</body>
</html>