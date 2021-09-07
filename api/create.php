<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/articles.php';

$database = new Database();
$db = $database->getConnection();

$item = new articles($db);

$data = json_decode(file_get_contents("php://input"));

$item->title = $data->title;
$item->content = $data->content;
$item->date = date('Y-m-d H:i:s');

if($item->createArticles()){
    echo 'Article created successfully.';
} else{
    echo 'Article could not be created.';
}
?>