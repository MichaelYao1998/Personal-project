<?php if (!defined('THINK_PATH')) exit(); session_start(); if(isset($_GET['logout'])){ session_destroy(); unset($_SESSION['username']); header("location: login.html"); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Test</title>
</head>
<body>
<p>You are login successfully! </p>
<p> <a href="test.html?logout='1'" style="color: red;">logout</a> </p>
</body>
</html>