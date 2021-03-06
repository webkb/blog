<?php
require './setting.php';

	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
		$id = $_GET['id'];
		$page = mysql_getrow("SELECT * FROM warm_page WHERE id=$id");
		if (empty($page)){
			backreferer('找不到对应的文章');
		}
		$gallery = explode(';', $page->gallery);
		$cid = $page->cid;
		$page_title = '编辑 ' . $page->title;
		$navbar_id = $id;
	} else {
		if (isset($_GET['cid']) && is_numeric($_GET['cid']) && $_GET['cid'] > 0) {
			$cid = $_GET['cid'];
		} else {
			$cid = 0;
		}
		$page_title = '新建内容';
		$navbar_id = $cid;
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $page_title; ?> Networm</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo $_APP_STATIC; ?>/style.css" />
		<link rel="stylesheet" href="<?php echo $_APP_EDITOR; ?>/themes/default/default.css" />
		<script charset="utf-8" src="<?php echo $_APP_EDITOR; ?>/kindeditor-all-min.js"></script>
		<script charset="utf-8" src="<?php echo $_APP_EDITOR; ?>/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true
				});
			});
		</script>
</head>
<body>
	<div class="header-wrapper">
		<div class="header bfc">
			<div class="nav left">
				<a class="btn logo" href="index.php">Networm</a><?php echo navbar_url($navbar_id); ?>
			</div>
			<div class="act right">
				<a class="btn" href="javascript:editor.sync();document.forms[0].submit()">保存</a>
<?php if (isset($id)): ?>
				<a class="btn" href="page.php?id=<?php echo $id; ?>" target="_blank">察看</a>
				<a class="btn" href="del.php?id=<?php echo $id; ?>">删除</a>
<?php endif; ?>

			</div>
		</div>
	</div>
	<div class="main-wrapper">
		<div class="main">
			<form class="editform bfc" name="post" action="save.php" method="post" enctype="multipart/form-data">
<?php if (isset($cid)): ?>
				<input type="hidden" name="cid" value="<?php echo $cid;?>" />
<?php endif; ?>
<?php if (isset($id)): ?>
				<input type="hidden" name="id" value="<?php echo $id;?>" />
<?php endif; ?>
				<div class="title_content">
				<h3></h3>
					标题
					<input name="title" value="<?php if (isset($page->title)){echo $page->title;}?>" />
					内容
					<textarea name="content" ><?php if (isset($page->title)){echo $page->content;} ?></textarea>
					<input class="editsubmit" type="submit" value="保存" />
				</div>
				<div class="picture">
				<h3></h3>
					<label for="pagetype" >列表<input name="type" type="hidden" value="<?php if (isset($page->type) && $page->type == 1): ?>1<?php else: ?>0<?php endif ?>" /><input type="checkbox" id="pagetype" <?php if (isset($page->type) && $page->type == 1): ?>checked=""<?php endif ?> onclick="this.previousElementSibling.value=this.previousElementSibling.value==1?0:1" /></label>
					IMG
					<input name="img" value="<?php if (isset($page->img)){echo $page->img;}?>" />
					URL
					<input name="url" value="<?php if (isset($page->url)){echo $page->url;}?>" />
				</div>
			</form>
		</div>
	</div>
<script src="static/common.js"></script>
</body>
</html>