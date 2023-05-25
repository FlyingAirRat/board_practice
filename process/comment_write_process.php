<?php

include('../include/db/db.php');



$params = array();
$params = $_POST;
var_dump($params);

$sql =
    "SELECT ifnull(max(comment_order), 0) as max_comment_order, ifnull(max(comment_ref), 0) as max_comment_ref from comment where board = '1' and post_idx = :post_idx";
$result = json_decode(sqlQueryAll($sql, $params));
$max_comment_order = $result->data[0]->max_comment_order;
$max_comment_ref = $result->data[0]->max_comment_ref;

if($params['depth_level'] == ''){
    $params['depth_level'] = 1;
    $params['comment_order'] = 1;
    $params['comment_ref'] = $max_comment_ref + 1;
}
else{
    
    $sql = "UPDATE comment SET
    comment_order = comment_order + 1
    where board = '1' and post_idx = :post_idx and comment_ref = :comment_ref and comment_order > :comment_order
    and depth_level >= :depth_level
    ";
    $result = sqlQueryAll($sql, $params);

    

    $params['depth_level'] = $params['depth_level'] + 1;
    $params['comment_order'] = $params['comment_order'] + 1;
}

$sql =
"SELECT ifnull(max(depth_order), 1) as max_depth_order from comment where board = '1' and post_idx = :post_idx and depth_level = :depth_level + 1 and comment_ref = :comment_ref";
$result = json_decode(sqlQueryAll($sql, $params));

$params['max_depth_order'] = $result->data[0]->max_depth_order;
$params['depth_order'] = $params['max_depth_order'];
// $params['max_comment_order'] = $result->data[0]->max_comment_order;





$sql =
"INSERT INTO comment
(
    board,
    post_idx,
    comment_ref,
    comment_order,
    depth_level,
    depth_order,
    writer,
    contents
)
    VALUES
(
    '1',
    :post_idx,
    :comment_ref,
    :comment_order,
    :depth_level,
    :depth_order,
    :comment_writer,
    :contents
)";

echo sqlQueryAll($sql, $params);
