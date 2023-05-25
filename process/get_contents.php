<?php
include('../include/db/db.php');

$sql =
"SELECT * from board where post_idx = ".$_GET['post_idx'];

$params = array();
$params = $_POST;

$post_contents = sqlQueryAll($sql, $params);

$sql = "SELECT * from comment where board = '1' and post_idx = ".$_GET['post_idx']." order by comment_ref, comment_order, inpt_dttm";
$comments = sqlQueryAll($sql, $params);

$result = (object) array();
$result->exec = true;
$result->post_contents = json_decode($post_contents);
$result->comments = json_decode($comments);

echo json_encode($result);