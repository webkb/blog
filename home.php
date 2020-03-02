<?php
require './setting.php';
$page=mysql_getrow('SELECT * FROM warm_setting');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>设置 Networm</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="static/style.css" />
</head>
	
<body>
<div class="wrapper">
	<div class="header-wrapper">
		<div class="header bfc">
			<div class="nav left">
				<a class="btn logo" href="index.php">Networm</a>
			</div>
			<div class="act right">
				<a class="btn" href="javascript:document.forms[0].submit()">保存</a>
			</div>
		</div>
	</div>
	<div class="main">
		<form class="editform bfc" name="post" action="save.php" method="post">
			<div class="title_content">
				<input type="hidden" name="issetting" value="issetting" />
				<h3></h3>
				公司名称
				<input name="company" value="<?php if (isset($page->company)) echo $page->company; ?>" />
				地址
				<input name="address" value="<?php if (isset($page->address)) echo $page->address; ?>" />
				电话
				<input name="tel" value="<?php if (isset($page->tel)) echo $page->tel; ?>" />
				传真
				<input name="fax" value="<?php if (isset($page->fax)) echo $page->fax; ?>" />
				邮编
				<input name="postcode" value="<?php if (isset($page->postcode)) echo $page->postcode; ?>" />
				邮箱
				<input name="mail" value="<?php if (isset($page->mail)) echo $page->mail; ?>" />
				联系人
				<input name="contact" value="<?php if (isset($page->contact)) echo $page->contact; ?>" />
				手机
				<input name="mobile" value="<?php if (isset($page->mobile)) echo $page->mobile; ?>" />
			</div>
			<div class='setting'>
				<h3></h3>
				账户
				<input name="username" value="<?php if (isset($page->username)) echo $page->username; ?>" />
				密码
				<input name="password" value="" />
			</div>
		</form>
	</div>
	<div class="footer-wrapper">
		<div class="footer">
			<span>© 2019 Networm v0.1</span>
		</div>
	</div>
</div>
</body>
</html>