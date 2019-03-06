<?php
require './setting.php';
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		$navbar_id = $id;
		$page = mysql_getrow("SELECT * FROM warm_page WHERE id=$id");
		if (empty($page)){
			jump(referer(), 'ID不存在');
		}
		//$gallery = explode(';',$page->gallery);
		$cid = $page->cid;
		$post = mysql_select("SELECT * FROM warm_post WHERE id=$id");
		
		$item_uid = $page->uid;
		$user = mysql_getrow("SELECT * FROM warm_setting WHERE uid=$item_uid");
		if ($user) {
			$username = $user->username;
		} else {
			$username = '已注销';
		}
		
	} else {
		jump(referer(), 'ID不存在');
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $page->title; ?></title>
<link rel="stylesheet/less" href="static/style.less" />
<script src="static/less.min.js"></script>

<link rel="stylesheet" href="../kindeditor/themes/default/default.css" />
<script charset="utf-8" src="../kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../kindeditor/lang/zh_CN.js"></script>
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
<div class="wrapper">

<?php include 'header.php' ?>
	<div class="main"><div class="file-navigation"><?php if (isset($navbar_id)): ?><?php echo navbar_url($navbar_id);?><?php endif; ?></div></div>	
	<div class="post_body" >
		<div class="main">
			<h1 class="thin"><?php echo $page->title; ?></h1>

		</div>
		<div class="main bfc"  style="color:#555;border-bottom:1px solid #dadada;">
			<div class="left" style="color:#555;width:120px;">
				
				<img src="http://bbs-static.smartisan.cn/uc_server/data/avatar/000/16/07/88_avatar_middle.jpg" /></div>
			<div class="bfc acontent">
				<div class="content">
					<?php echo $page->content; ?>
				</div>
				<h6 style=""><?php echo $username; ?> <?php echo $page->createtime; ?><?php if (LOGIN_ID == $page->uid): ?> <a class="btn" href="write.php?id=<?php echo $id; ?>">编辑</a><?php endif; ?></h6>
			</div>
		</div>
<?php foreach ($post as $item):
	$item_uid = $item->uid;
	$user = mysql_getrow("SELECT * FROM warm_setting WHERE uid=$item_uid");
	if ($user) {
		$username = $user->username;
	} else {
		$username = '已注销';
	}
?>
		<div class="main bfc post_item"  style="color:#555;border-bottom:1px solid #dadada;">
			<div class="left" style="color:#555;width:120px;"><img src="http://bbs-static.smartisan.cn/uc_server/data/avatar/000/16/07/88_avatar_middle.jpg" /></div>
			<div class="bfc acontent">
				<div class="content">
					<?php echo $item->content; ?>
				</div>
				 <h6 style=""><?php echo $username; ?>  <?php echo $item->createtime; ?><?php if (LOGIN_ID == $item_uid): ?> <a class="btn" href="write.php?action=edit_post&post_id=<?php echo $item->post_id; ?>">编辑</a><?php endif; ?></h6>		
			</div>
		</div>
<?php endforeach; ?>
	</div>
<?php if (LOGIN_ID): ?>
		<div class="main bfc post_item"  style="color:#555;border-bottom:1px solid #dadada;">
			<div class="left" style="color:#555;width:120px;"><img src="http://bbs-static.smartisan.cn/uc_server/data/avatar/000/16/07/88_avatar_middle.jpg" /></div>
			<div class="bfc acontent">

		<form class="bfc" name="post" action="save.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id;?>" />
			<input type="hidden" name="action" value="add_post" />
			<div class="">
				<textarea name="content" rows="30" ></textarea>
			</div>
			<a class="submitbtn btn" href="javascript:editor.sync();document.forms[0].submit()">保存</a>
		</form>
					
		</div>
	</div>
<?php endif; ?>
<?php include 'footer.php' ?>	
<script src="static/common.js"></script>
</div>
<br />
<br />
<br />
<br />
<br />
</body>
</html>