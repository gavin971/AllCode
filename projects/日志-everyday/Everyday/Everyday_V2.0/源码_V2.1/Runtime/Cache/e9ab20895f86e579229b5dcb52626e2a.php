<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Everyday</title>
<link href="__ROOT__/Everyday/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="__ROOT__/Everyday/css/theme_1_blue.css" rel="stylesheet" type="text/css"/>
<link href="__ROOT__/Everyday/css/histogram.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
var cur_url = "__URL__";
</script>
<script type="text/javascript" src="__ROOT__/Everyday/js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="__ROOT__/Everyday/js/userAction.js"></script>
</head>
<body>
<div id="loginContainer">
	<div id="logoContainer"></div>
	<form id="loginForm" method='post' action="__URL__/regSubmit">
		<table>
			<tr><td>账号：</td><td><input type="text" name="account" /></td></tr>
			<tr><td>密码：</td><td><input type="password" name="password" /></td></tr>
			<tr><td>密码验证：</td><td><input type="password" name="repassword" /></td></tr>
			<tr><td>验证码：</td><td><input id="verify" type="text" name="verify" /><img id="verifyImg" alt="" src="__APP__/Index/verify/" /><a href="javascript:changeCode();">看不清楚，换一张</a></td></tr>
			<tr><td></td><td><input type="submit" value="注册" /><input type="reset" value="重置" /><a href="__URL__/index">登陆</a></td></tr>
		</table>
		<?php echo ($verifyError1); ?>
	</form>
</div>
 </body>
</html>