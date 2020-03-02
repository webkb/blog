<?php
require './setting.php';
/** 登陆 */
if (isset($_POST['action']) && $_POST['action'] == 'login') {
	if (! defined('REQUEST_TYPE')) {
		define('REQUEST_TYPE', 'ajax');
	}
	$returnMsg = login();
	echo $returnMsg;
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>登录 Networm</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="static/style.css" />
<script src="static/common.js"></script>
</head>
<body class="loginwrapper">
	<div class="login">
		<div class="loginnotice">
			<h1>登录 Networm</h1>
			<div></div>
		</div>
		<form class="loginform" action="login.php" method="post">
			<label>
				<div class="bfc">
					<span>帐号</span>
					<span class="right forget_password"><a class="link" href="reg.php"></a></span>
				</div>
				<input class="f2" placeholder="" name="username" tabindex="1" />
			</label>
			<label>
				<div class="bfc">
					<label class="left">密码</label>
					<span class="right forget_password"><a class="link" href="reset.php">忘记密码？</a></span>
				</div>
				<input class="f2" placeholder="" name="password" type="password" tabindex="2" />
			</label>
			<input class="submit" type="submit" value="登录" data-logging-value="登录中……" tabindex="3" />
		</form>
	</div>
	<script src="static/login.js"></script>
</body>
</html>