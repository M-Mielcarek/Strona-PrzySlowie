<?php 

function validatePost($post)
{
    $errors=array();

    if(empty($post['title'])) {
        array_push($errors, 'Wymagany tytuł artykułu.');
    }

    if(empty($post['body'])) {
        array_push($errors, 'Wymagana treść artykułu.');
    }

    if (empty($post['description'])) {
        $errors[] = "Wymagany opis.";
    }

    if(empty($post['topic_id'])) {
        array_push($errors, 'Wymagany tag.');
    }

$existingPost = selectOne('posts', ['title' => $post['title']]);

if (isset($_POST['id'])) {
    $existingPost = selectOne('posts', ['title' => $post['title']]);

    if ($existingPost && $existingPost['id'] != $_POST['id']) {
        $errors[] = "Article under such name already exists";
    }
}

return $errors;
}
