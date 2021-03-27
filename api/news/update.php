<?php
 //headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With ');

 include_once '../../config/Database.php';
 include_once '../../models/Post.php';

 $database = new Database();
 $db = $database->connect();

 $post = new Post($db);
 
 $data = json_decode(file_get_contents("php://input"));

 $post->id= $data->id;	

 $post->title = $data->title;
 $post->content_type= $data->content_type;

 if($post->update()){
 	echo json_encode(array(
    array('message'=> 'Post Updated')
 	));
 }
else{
 	echo json_encode(array(
    array('message'=> 'Post Not Updated')
 	));
 }
 ?>