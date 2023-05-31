<?php
session_start();
session_unset();
session_destroy();
header('Location: administration menu page.php');
exit();
?>