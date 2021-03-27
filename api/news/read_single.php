<?php
 //headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/Database.php';
 include_once '../../models/Post.php';

 $database = new Database();
 $db = $database->connect();

 $post = new Post($db);

 $post->id = isset($_GET['id']) ? $_GET['id'] : die();

 $post->read_single();
 
 $post_arr = array(
	'id' =>  $post->id,
	'title' =>  $post->title,
	'desc' =>  $post->desc
 );
 print_r(json_encode($post_arr));
?>