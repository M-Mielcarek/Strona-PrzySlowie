<?php 

include(ROOT_PATH . "app/database/db.php");
include(ROOT_PATH . "app/helpers/validateTopic.php");
include(ROOT_PATH . "app/includes/messages.php");
include(ROOT_PATH . "app/helpers/middleware.php");

$table = 'topics';

$errors= array();
$id='';
$name='';
$description='';

$topics = selectAll($table);


if (isset($_POST['add-topic'])){
    usersOnly();
    $errors= validateTopic($_POST);

    if(count($errors)===0){
        unset($_POST['add-topic']);
        $topic_id= create('topics', $_POST);
        $_SESSION['message'] = 'Topic created.';
        $_SESSION['type'] = 'success';
        header ('location: ' . BASE_URL . 'topic_index.php');
        exit();    
    } else{
        $name=$_POST['name'];
        $description=$_POST['description'];
    }
}

if (isset ($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id'=>$id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    usersOnly();
    $id= $_GET['del_id'];
    $count=delete($table, $id);
    $_SESSION['message'] = 'Topic deleted.';
    $_SESSION['type'] = 'success';
    header ('location: ' . BASE_URL . 'topic_index.php');
    exit();
}

if (isset ($_POST['update-topic'])){
    usersOnly();
    $errors= validateTopic($_POST);

    if(count($errors)===0){
        $id= $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        $topic_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Topic updated.';
        $_SESSION['type'] = 'success';
        header ('location: ' . BASE_URL . 'topic_index.php');
        exit();
    } else {
        $name=$_POST['name'];
        $description=$_POST['description'];
    }
}