
<?php
session_start();
unset($_SESSION['email']);
session_destroy();

header("Location: http://localhost:5173/");
exit;
?>
