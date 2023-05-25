<?php
include('db_conn.php');

function sqlQueryAll($sql, $params){
    $pdo = new PDO(DSN, USERNAME, PASSWORD);
    $statement = $pdo->prepare($sql);
    foreach($params as $row=>$value){
        $pattern = '/:'.$row.'\b/';
        if(preg_match($pattern, $sql)){
            $statement->bindValue($row, $value);
        }
    }
    $exec = $statement->execute();
    $fetch = $statement->fetchAll();

    $result = (object) array();
    $result->data = array();
    foreach($fetch as $row){
        $row = array_filter($row, function ($key) {
            return !is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);
        array_push($result->data, $row);
    }

    $result->exec = $exec;
    return json_encode($result);
}