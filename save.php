<?php
require './setting.php';

	$data = getItemData();

	$id			= isset($_POST['id'])		&& is_numeric($_POST['id'])		? (int) $_POST['id']							: null;
	$issetting	= isset($_POST['issetting'])								? (int) $_POST['issetting']						: null;
	$password	= isset($_POST['password'])									? db_real_escape_string($_POST['password'])		: '';

	if ($issetting) {
		if ($password == '') {
			mysql_xquery("UPDATE `warm_setting` SET $data");
		} else {
			mysql_xquery("UPDATE `warm_setting` SET $data, `password` = MD5(CONCAT(salt, '$password'))");
		}
		jump($_SERVER['HTTP_REFERER'], '编辑成功');
	}

	//page
	if (is_int($id)) {
		if (mysql_xquery("UPDATE `warm_page` SET $data WHERE id=$id"))
		{
			jump($_SERVER['HTTP_REFERER'], '编辑成功');
		}
	} else {
		if (mysql_xquery("INSERT INTO `warm_page` SET $data"))
		{
			$id = $mysqli->insert_id;
			jump("page.php?id=$id", '发表成功');
		}
	}
?>
