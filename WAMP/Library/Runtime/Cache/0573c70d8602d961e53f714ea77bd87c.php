<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Library</title>
<link rel='stylesheet' type='text/css' href='__ROOT__/css/style.css'>
</head>
<body>
<h1>Library</h1>
<form method="POST" action="__URL__/login">
<table>
<tr><td>Name:</td><td><input type="text" name="username" /></td></tr>
<tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
<tr><td></td><td><input type="submit" value="Sign in" /><a href="__URL__/register">Register</a></td></tr>
</table>
</form>
</body>
</html>