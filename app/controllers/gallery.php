<?php

include_once(ROOT_PATH . "app/database/db.php");
include_once(ROOT_PATH . "app/helpers/middleware.php");

$table = 'gallery';

$errors = [];
$gallery = [];


$gallery = selectAll($table);

if (isset($_POST['add-image'])) {

    $errors = [];

    if (empty($_POST['title'])) {
        array_push($errors, "Tytuł jest wymagany");
    }

    if (empty($_POST['description'])) {
        array_push($errors, "Opis jest wymagany");
    }

    if (empty($_FILES['image']['name'])) {
        array_push($errors, "Obraz jest wymagany");
    }

    if (count($errors) === 0) {

        // Upload image
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "assets/images/gallery/" . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            array_push($errors, "Błąd podczas przesyłania obrazu");
        } else {

            $imageData = [
                'title'       => $_POST['title'],
                'description' => $_POST['description'],
                'image'       => $image_name,
                'published'   => isset($_POST['published']) ? 1 : 0
            ];

            create($table, $imageData);

            $_SESSION['message'] = "Obraz dodany pomyślnie";
            $_SESSION['type'] = "success";

            header("Location: " . BASE_URL . "gallery_index.php");
            exit();
        }
    }
}

if (isset($_GET['delete_id'])) {

    adminOnly();

    $id = $_GET['delete_id'];
    $image = selectOne($table, ['id' => $id]);

    if ($image) {

        $filePath = ROOT_PATH . "assets/images/gallery/" . $image['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        delete($table, $id);

        $_SESSION['message'] = "Obraz usunięty";
        $_SESSION['type'] = "success";
    }

    header("Location: " . BASE_URL . "gallery_index.php");
    exit();
}


if (isset($_GET['published']) && isset($_GET['p_id'])) {

    adminOnly();

    update($table, $_GET['p_id'], [
        'published' => $_GET['published']
    ]);

    $_SESSION['message'] = $_GET['published']
        ? "Obraz opublikowany"
        : "Publikacja cofnięta";

    $_SESSION['type'] = "success";

    header("Location: " . BASE_URL . "gallery_index.php");
    exit();
}