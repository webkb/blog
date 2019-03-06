<?php
require './setting.php';
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
		$id = $_GET['id'];
		$page = mysql_getrow("SELECT * FROM warm_page WHERE id=$id");
		if (empty($page)){
			backreferer('ID不存在');
		}
		$gallery = explode(';',$page->gallery);
		$cid = $page->cid;
		$page_title = '查看 ' . $page->title;
		$navbar_id = $id;
		$post = mysql_select("SELECT * FROM warm_post WHERE id=$id");
	} else {
		backreferer('ID不存在');
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $page_title; ?>Networm</title>
<link rel="stylesheet/less" href="static/style.less" />
<script src="static/less.min.js"></script>
</head>
<body class="pagewrapper">
<div class="wrapper">
	<div class="header-wrapper">
		<div class="header bfc">
			<div class="nav left">
				<a class="btn logo" href="index.php">Networm</a><?php echo navbar_url($navbar_id); ?>
			</div>
			<div class="act right">
				<a class="btn" href="write.php?id=<?php echo $id; ?>">编辑</a>
			</div>
		</div>
	</div>
	<div class="main" style="background: #ecdfcf;color:#333;font-family:FangSong;font-size:32px;">
		<h1 style="margin: 2rem;"><?php echo $page->title; ?></h1>
		<div style="margin: 2rem;"><?php echo $page->content; ?></div>
	</div>
</div>
<script src="static/common.js"></script>
</body>
</html>