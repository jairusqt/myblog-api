<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/post.php';

    $database = new db();
    $db = $database->connect();

    $post = new post($db);

    $result = $post->read();
    $num = $result->rowCount();

    if($num > 0) {
        $posts_array = array();
        $posts_array['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );
            array_push($posts_array['data'], $post_item);
        }

        echo json_encode($posts_array);
    } else {
        echo json_encode(
            array('message' => 'No post found')
        );
    }
