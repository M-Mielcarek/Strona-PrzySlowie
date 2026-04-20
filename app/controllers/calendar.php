<?php

include(ROOT_PATH . "app/database/db.php");
include(ROOT_PATH . "app/helpers/middleware.php");
include(ROOT_PATH . "app/helpers/validateCalendar.php");

$table = 'calendar';
$errors = [];

$id = '';
$title = '';
$start_date = '';
$end_date = '';
$description = '';


$events = selectAll($table);

if (isset($_GET['del_id'])) {
    usersOnly();

    delete($table, $_GET['del_id']);

    $_SESSION['message'] = 'Wydarzenie zostało usunięte';
    $_SESSION['type'] = 'success';

    header('location: ' . BASE_URL . '/calendar_index.php');
    exit();
}

if (isset($_POST['add-event'])) {
    usersOnly();

    $errors = validateCalendar($_POST);

    if (count($errors) === 0) {
        $_POST['start_date'] = date('Y-m-d', strtotime($_POST['start_date']));
        $_POST['end_date'] = !empty($_POST['end_date'])
            ? date('Y-m-d', strtotime($_POST['end_date']))
            : $_POST['start_date'];

        create($table, [
            'title'       => $_POST['title'],
            'description' => $_POST['description'] ?? '',
            'start_date'  => $_POST['start_date'],
            'end_date'    => $_POST['end_date'],
        ]);

        $_SESSION['message'] = 'Wydarzenie zostało utworzone';
        $_SESSION['type'] = 'success';

        header('location: ' . BASE_URL . 'calendar_index.php');
        exit();
    }

    $title       = $_POST['title'];
    $start_date  = $_POST['start_date'];
    $end_date    = $_POST['end_date'] ?? '';
    $description = $_POST['description'] ?? '';
}

if (isset($_GET['id'])) {
    $event = selectOne($table, ['id' => $_GET['id']]);

    if (!$event) {
        $_SESSION['message'] = 'Nie znaleziono wydarzenia';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . 'calendar_index.php');
        exit();
    }

    $id          = $event['id'];
    $title       = $event['title'];
    $start_date  = $event['start_date'];
    $end_date    = $event['end_date'];
    $description = $event['description'];
}

if (isset($_POST['update-event'])) {
    usersOnly();

    $errors = validateCalendar($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];

        $_POST['start_date'] = date('Y-m-d', strtotime($_POST['start_date']));
        $_POST['end_date'] = !empty($_POST['end_date'])
            ? date('Y-m-d', strtotime($_POST['end_date']))
            : $_POST['start_date'];

        update($table, $id, [
            'title'       => $_POST['title'],
            'description' => $_POST['description'] ?? '',
            'start_date'  => $_POST['start_date'],
            'end_date'    => $_POST['end_date'],
        ]);

        $_SESSION['message'] = 'Wydarzenie zostało zaktualizowane';
        $_SESSION['type'] = 'success';

        header('location: ' . BASE_URL . 'calendar_index.php');
        exit();
    }

    $id          = $_POST['id'];
    $title       = $_POST['title'];
    $start_date  = $_POST['start_date'];
    $end_date    = $_POST['end_date'] ?? '';
    $description = $_POST['description'] ?? '';
}