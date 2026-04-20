<?php 

include(ROOT_PATH . "app/database/db.php");
include(ROOT_PATH . "app/helpers/validatePost.php");
include(ROOT_PATH . "app/helpers/middleware.php");

$table = 'posts';
$topics = selectAll('topics');
$posts  = getPublishedPosts();

$errors = [];
$id = "";
$title = "";
$body = "";
$image = "";
$topic_id = "";
$published = "";
$description = "";


if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);

    if ($post) {
        $id           = $post['id'];
        $title        = $post['title'];
        $body         = $post['body'];
        $topic_id     = $post['topic_id'];
        $image        = $post['image'];
        $published    = $post['published'];
        $description  = $post['description'];
    }
}

if (isset($_GET['delete_id'])) {
    usersOnly();

    $deleteId = $_GET['delete_id'];
    delete($table, $deleteId);

    $_SESSION['message'] = "Artykuł został usunięty.";
    $_SESSION['type'] = "success";

    header("Location: " . BASE_URL . "post_index.php");
    exit();
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
    usersOnly();

    $published = $_GET['published'];
    $p_id = $_GET['p_id'];

    update($table, $p_id, ['published' => $published]);

    $_SESSION['message'] = "Status publikacji został zmieniony.";
    $_SESSION['type'] = "success";

    header("Location: " . BASE_URL . "post_index.php");
    exit();
}



function handleImageUpload(&$errors) {
    if (!empty($_FILES['image']['name'])) {

        $allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $errors[] = "Niedozwolony format obrazu.";
            return false;
        }

        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $destination = ROOT_PATH . "assets/images/" . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            return $imageName;
        } else {
            $errors[] = "Wystąpił problem podczas wgrywania obrazu.";
            return false;
        }
    }

    return null; 
}


function getPostsWithAuthors() {
    global $conn;
    $sql = "SELECT posts.*, users.username 
            FROM posts 
            JOIN users ON posts.user_id = users.id
            ORDER BY posts.id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}



if (isset($_POST['add-post'])) {
    usersOnly();
    $errors = validatePost($_POST);

    $body = $_POST['body'];

    $uploadedImage = handleImageUpload($errors);
    if (!$uploadedImage) {
        $errors[] = "Post wymaga obrazu.";
    }

    if (count($errors) === 0) {
        unset($_POST['add-post']);

        $_POST['user_id']   = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['image']     = $uploadedImage;

        // ❗ NIE używamy htmlspecialchars!
        $_POST['body'] = $body;

        $post_id = create($table, $_POST);

        $_SESSION['message'] = "Artykuł został utworzony.";
        $_SESSION['type'] = "success";

        header("Location: " . BASE_URL . "/post_index.php");
        exit();
    } else {
        $title        = $_POST['title'];
        $body         = $_POST['body'];
        $topic_id     = $_POST['topic_id'];
        $published    = isset($_POST['published']) ? 1 : 0;
        $description  = $_POST['description'];
    }
}



if (isset($_POST['update-post'])) {

    usersOnly();
    $errors = validatePost($_POST);

    $body = $_POST['body'];

    $uploadedImage = handleImageUpload($errors);

    if (count($errors) === 0) {

        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);

        // ❗ POPRAWKA (bug u Ciebie)
        $_POST['user_id'] = $_SESSION['id']; 

        $_POST['published'] = isset($_POST['published']) ? 1 : 0;

        if ($uploadedImage !== null) {
            $_POST['image'] = $uploadedImage;
        } else {
            $_POST['image'] = $image;
        }

        $_POST['body'] = $body;

        update($table, $id, $_POST);

        $_SESSION['message'] = "Artykuł został zaktualizowany.";
        $_SESSION['type'] = "success";

        header("Location: " . BASE_URL . "post_index.php");
        exit();
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
        $description = $_POST['description'];
        $image = $post['image'];
    }
}
?>