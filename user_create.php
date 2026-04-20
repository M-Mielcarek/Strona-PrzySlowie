<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/users.php");
adminOnly();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <title>Admin - dodaj użytkownika</title>
</head>

<body>
    <?php include(ROOT_PATH ."app/includes/admin_header.php"); ?>

    <div class="admin-wrapper">
    <?php include(ROOT_PATH ."app/includes/admin_sidebar.php"); ?>

        <div class="admin-content">
            <div class="button-group">
                <a href="user_create.php" class="btn btn-big">Utwórz użytkownika</a>
                <a href="user_index.php" class="btn btn-big">Zarządzaj użytkownikami</a>
            </div>

            <div class="content">

               <h2 class="page-title">dodaj użytkownika</h2>

                <?php include(ROOT_PATH ."app/helpers/formErrors.php"); ?>

               <form action="user_create.php" method="post">
                <div>
                    <label>Nazwa</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
                    </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
                </div>

                <div>
                    <label>Hasło</label>
                    <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
                </div>

                <div>
                    <?php if (isset($admin) && $admin == 1): ?>
                    <label>
                        <input type="checkbox" name="admin" checked>
                        Admin
                    </label>
                        <?php else: ?>
                            <label>
                             <input type="checkbox" name="admin">
                             Admin
                            </label>
                            <?php endif; ?>
                </div>

                 <div>
                    <button type="submit" name = "create-admin" class="btn btn-big">Publikuj</button>
                </div>

               </form>

            </div>

        </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/47.1.0/ckeditor5.umd.js"></script>

    <script src="assets/js/script.js"></script>
    
</body>

</html>