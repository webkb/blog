<?php
require './setting.php';

/** delete */
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
		$id = $_GET['id'];
		$page = mysql_getrow("SELECT * FROM warm_page WHERE id=$id");
		if (empty($page)){
			backreferer('ID不存在');
		}
		$filename = ROOT . '/' . microtime(true) . '.bak';
		file_put_contents($filename, json_encode($page, JSON_UNESCAPED_UNICODE));
		mysql_xquery("DELETE FROM warm_page WHERE id=$id");
		$cid = $page->cid;
		jump('list.php?id=' . $cid, '删除成功');
	}
?>