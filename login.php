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
<link rel="stylesheet/less" href="static/style.less" />
<script src="static/less.min.js"></script>
<script src="static/common.js"></script>
</head>
<body class="login">
	<div class="login_outer">
		<div class="errorMsgDiv">
			<div id="notice" class="errorMsg"></div>
		</div>
		<h1>登录 Networm</h1>
		<div class="logindiv">
			
			<form class="loginform" action="login.php" method="post">
				<div class="username bfc">
					<label>帐号</label>
					<span class="right forget_password"><a class="link" href="reg.php">注册</a></span>
					<input class="f2" placeholder="" name="username" tabindex="1" />
				</div>
				<div class="username bfc">
					<label class="left">密码</label>
					<span class="right forget_password"><a class="link" href="reset.php">忘记密码？</a></span>
					<input class="f2" placeholder="" name="password" type="password" tabindex="2" />
				</div>
				<input class="submit" type="submit" value="登录" tabindex="3" />
			</form>
		</div>
	</div>
<script>
document.getElementsByClassName("loginform")[0].onsubmit = function () {
	var username = document.getElementsByName("username")[0].value;
	var password = document.getElementsByName("password")[0].value;
	var eleNotice = document.getElementById("notice");

	eleNotice.innerHTML = '';
	eleNotice.className = 'errorMsg';
	document.querySelector(".login_outer h1").className = 'loginStatus';
	document.querySelector(".login").className = 'login loginStatus';
	document.getElementsByClassName("submit")[0].value = '登录中。。。';

	var data = 'action=login&username=' + username + '&password=' + password;

	xc_ajax.post(this.action, data ,function(responseMsg) {
		if (responseMsg.status=='error') {
			eleNotice.innerHTML = responseMsg.content;
			eleNotice.className = 'errorMsg errorStatus';
			document.querySelector(".login_outer h1").className = '';
			document.querySelector(".login").className = 'login';
			document.getElementsByClassName("submit")[0].value = '登录';
		} else {
			if (document.referrer.indexOf('reg.php')<0 || document.referrer.indexOf('login.php')<0 || document.referrer.indexOf('logout.php')<0) {
				location = 'index.php';
			} else {
				location = document.referrer;
			}
		}
	});
	return false;
}
</script>
</body>
</html>