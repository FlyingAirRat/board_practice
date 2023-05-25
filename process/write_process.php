<?php

include('../include/db/db.php');

$sql =
"INSERT INTO board
(
    title,
    contents,
    inpt_dttm,
    updt_dttm
)
    VALUES
(
    :title,
    :contents,
    now(),
    now()
)";

$params = array();
$params = $_POST;

echo sqlQueryAll($sql, $params);
