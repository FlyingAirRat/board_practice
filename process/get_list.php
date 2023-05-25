<?php
include('../include/db/db.php');

$sql =
"SELECT * from board";

$params = array();
$params = $_POST;

echo sqlQueryAll($sql, $params);