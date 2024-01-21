<?php
session_start();
session_destroy();

header("Location: Alogin.html");
exit();
?>
