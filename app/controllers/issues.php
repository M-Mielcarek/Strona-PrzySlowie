<?php

include(ROOT_PATH . 'app/database/db.php');
include(ROOT_PATH . 'app/helpers/validateIssue.php');
include(ROOT_PATH . "app/helpers/middleware.php");

$table = 'issues';

$uploadDir  = ROOT_PATH . 'assets/images/issues-pic/';
$publicPath = BASE_URL . 'assets/images/issues-pic/';


$errors = [];
$name = '';
$description = '';
$issueImage = '';
$issue_pdf = '';
$selectedArticles = [];

$posts  = selectAll('posts');
$issues = selectAll('issues');


function uploadIssueImage($file)
{
    global $uploadDir;

    if (!isset($file) || $file['error'] !== 0) {
        return null;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        return null;
    }

    $fileName = uniqid('issue_', true) . '.' . $ext;
    $destination = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return $fileName;
    }

    return null;
}

if (isset($_POST['add-issue'])) {

    $errors = validateIssue($_POST);

    $postsCsv = '';

// Upload PDF
if (!empty($_FILES['issue_pdf']['name'])) {

    $pdf_name = time() . '_' . $_FILES['issue_pdf']['name'];
    $destination = ROOT_PATH . "/assets/images/" . $pdf_name;

    $result = move_uploaded_file($_FILES['issue_pdf']['tmp_name'], $destination);

    if ($result) {
        $issue_pdf = "/assets/images/" . $pdf_name;
    } else {
        array_push($errors, "Nie udało się przesłać pliku PDF.");
    }
}
    if (!empty($_POST['article_ids'])) {
        $postsCsv = implode(',', $_POST['article_ids']);
    }

    $imageName = uploadIssueImage($_FILES['issue_image']);

    if (!$imageName && !empty($_FILES['issue_image']['name'])) {
        array_push($errors, "Nieprawidłowy format obrazu (jpg, png, webp).");
    }

    if (count($errors) === 0) {
        $data = [
            'name'        => $_POST['name'],
            'description' => $_POST['description'],
            'posts'       => $postsCsv,
            'image'       => $imageName,
'pdf' => $issue_pdf
        ];

        create($table, $data);
        header('location: ' . BASE_URL . 'issue_index.php');
        exit();
    }

    $name = $_POST['name'];
    $description = $_POST['description'];
    $selectedArticles = $_POST['article_ids'] ?? [];
}


if (isset($_GET['id'])) {
    $issue = selectOne($table, ['id' => $_GET['id']]);

    if ($issue) {
        $name = $issue['name'];
        $description = $issue['description'];
        $issueImage = $issue['image'];
        $selectedArticles = !empty($issue['posts']) ? explode(',', $issue['posts']) : [];
    }
}


if (isset($_POST['update-issue'])) {

    $errors = validateIssue($_POST);
    $issueId = $_POST['id'];

    $postsCsv = '';
    if (!empty($_POST['article_ids'])) {
        $postsCsv = implode(',', $_POST['article_ids']);
    }

    $issue = selectOne($table, ['id' => $issueId]);
    $imageName = $issue['image'];

    if (!empty($_FILES['issue_image']['name'])) {
        $newImage = uploadIssueImage($_FILES['issue_image']);

        if ($newImage) {
            if ($imageName && file_exists($uploadDir . $imageName)) {
                unlink($uploadDir . $imageName);
            }
            $imageName = $newImage;
        } else {
            array_push($errors, "Nieprawidłowy format obrazu (jpg, png, webp).");
        }
    }

    if (count($errors) === 0) {
        $data = [
            'name'        => $_POST['name'],
            'description' => $_POST['description'],
            'posts'       => $postsCsv,
            'image'       => $imageName
        ];

        update($table, $issueId, $data);
        header('location: ' . BASE_URL . 'issue_index.php');
        exit();
    }
}


if (isset($_GET['del_id'])) {

    $issue = selectOne($table, ['id' => $_GET['del_id']]);

    if ($issue && $issue['image'] && file_exists($uploadDir . $issue['image'])) {
        unlink($uploadDir . $issue['image']);
    }

    delete($table, $_GET['del_id']);
    header('location: ' . BASE_URL . 'issue_index.php');
    exit();
}