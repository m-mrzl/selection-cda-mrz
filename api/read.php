<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../class/articles.php';

$database = new Database();
$db = $database->getConnection();

$items = new articles($db);

$stmt = $items->getArticles();
$itemCount = $stmt->rowCount();


echo json_encode($itemCount);

if($itemCount > 0){

    $articleArr = array();
    $articleArr["body"] = array();
    $articleArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "date" => $date
        );

        array_push($articleArr["body"], $e);
    }
    echo json_encode($articleArr);
}

else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>