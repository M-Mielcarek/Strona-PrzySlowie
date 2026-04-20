<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("path.php");
include(ROOT_PATH . "app/database/db.php");
include(ROOT_PATH . "app/helpers/middleware.php");
include(ROOT_PATH . "app/controllers/posts.php");  

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
usersOnly();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel użytkownika</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <?php include(ROOT_PATH ."app/includes/admin_header.php"); ?>
    <div class="admin-wrapper">
        <?php include(ROOT_PATH ."app/includes/admin_sidebar.php"); ?>
        <div class="admin-content">
            <div class="content">
               <h2 class="page-title">Panel użytkownika</h2>
               <?php include(ROOT_PATH . 'app/includes/messages.php');?>
            </div>
        </div>
    </div>
</body>
</html>