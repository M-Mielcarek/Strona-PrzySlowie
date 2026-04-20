<?php 
include(ROOT_PATH . "app/database/db.php");
include(ROOT_PATH . "app/helpers/validateUser.php");
include(ROOT_PATH . "app/helpers/middleware.php");

$table = 'users';
$admin_users = selectAll($table);

$errors = array();
$username = '';
$id = '';
$email = '';
$password = '';
$admin = "";

function loginUser($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = "Zalogowano pomyślnie."; 
    $_SESSION['type'] = 'success';

    if($_SESSION['id']){
        header('location: ' . BASE_URL . 'dashboard.php');
    } else {
        header('location: ' . BASE_URL . 'index.php');
    }
    exit();
}

if (isset($_POST['register-btn']) || isset($_POST['create-admin'])){
    $errors = validateUser($_POST);

    if (count($errors) === 0){
        unset($_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if(isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);
            $_SESSION['message'] = "Utworzono admina";
            $_SESSION['type'] = "success";
            header('location: ' . BASE_URL . 'user_index.php');
            exit();
        } else {
            $_POST['admin'] = 0;
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id' => $user_id]);
            loginUser($user);
        }

    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admin = isset($_POST['admin']) ? 1 : 0;
    }
}

if (isset($_POST['update-user'])){
    adminOnly();
    $errors = validateUser($_POST);

    if (count($errors) === 0){
        $id = $_POST['id'];
        unset($_POST['update-user']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;

        $count = update($table, $_POST['id'], $_POST);
        $_SESSION['message'] = "Zaktualizowano użytkownika";
        $_SESSION['type'] = "success";
        header('location: ' . BASE_URL . 'user_index.php');
        exit();
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admin = isset($_POST['admin']) ? 1 : 0;
    }
}

if (isset($_GET['id'])){
    $user = selectOne($table, ['id' => $_GET['id']]);

    $id = $user['id'];
    $username = $user['username'];
    $email = $user['email'];
    $admin = $user['admin'];
}

if (isset($_POST['login-btn'])){
    $errors = validateLogin($_POST);

    if(count($errors) === 0){
        $user = selectOne($table, ['username' => $_POST['username']]);

        if($user && password_verify($_POST['password'], $user['password'])){
            loginUser($user);
        } else {
            array_push($errors, 'Błędne dane logowania.');
        }
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
}

if (isset($_GET['delete_id'])){
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = "Usunięto użytkownika";
    $_SESSION['type'] = "success";
    header('location: ' . BASE_URL . 'user_index.php');
    exit();
}
?>