<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Library</title>
<link rel='stylesheet' type='text/css' href='__ROOT__/css/style.css'>
</head>
<body>
<h1>Edit my data</h1>
<form id="userForm" method="POST" action="__URL__/reviseUserData">
<input type="hidden" name="id" value="<?php echo ($id); ?>" />
<table>
<tr><td>Name:</td><td><?php echo ($username); ?></td></tr>
<tr><td>Password:</td><td><input id="password" type="password" name="password" /></td></tr>
<tr><td>Password confirm:</td><td><input id="confirm" type="password" name="confirm" /></td></tr>
<tr><td>E-mail:</td><td><input id="email" type="text" name="email" value=<?php echo ($email); ?> /></td></tr>
<tr><td></td><td><input type="submit" value="Submit" /><a href="__URL__/main">Go back</a></td></tr>
</table>
</form>
</body>
<script type="text/javascript">
var web_action = "__URL__";
var user_action = "edit";
</script>
<script type="text/javascript" src="__ROOT__/js/validate.js"></script>
<script type="text/javascript">
V.result = 
{
	username: true, password: false, confirm:false, email: true
};
</script>
</html>