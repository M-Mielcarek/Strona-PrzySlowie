<?php
include("path.php");
include(ROOT_PATH . "app/controllers/gallery.php");
usersOnly();

$errors = $errors ?? [];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dodaj obraz do galerii</title>

    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
</head>

<body>

<?php include(ROOT_PATH . "app/includes/admin_header.php"); ?>

<div class="admin-wrapper">

    <?php include(ROOT_PATH . "app/includes/admin_sidebar.php"); ?>

    <div class="admin-content">

        <div class="button-group">
            <a href="gallery_create.php" class="btn btn-big">Dodaj obraz</a>
            <a href="gallery_index.php" class="btn btn-big">Zarządzaj galerią</a>
        </div>

        <div class="content">
            <h2 class="page-title">Dodaj obraz do galerii</h2>

            <?php include(ROOT_PATH . "app/helpers/formErrors.php"); ?>

            <form action="gallery_create.php" method="post" enctype="multipart/form-data">

                <div>
                    <label>Tytuł</label>
                    <input 
                        type="text" 
                        name="title" 
                        value="<?php echo htmlspecialchars($title ?? ''); ?>" 
                        class="text-input"
                    >
                </div>

                <div>
                    <label>Obraz</label>

                    <?php if (!empty($image)): ?>
                        <img 
                            src="<?php echo BASE_URL . 'assets/images/' . $image; ?>" 
                            alt="Podgląd obrazu" 
                            style="width:150px; margin-bottom:10px;"
                        >
                    <?php endif; ?>

                    <input type="file" name="image" class="text-input" required>
                </div>

                <div>
                    <label>Opis</label>
                        <textarea name="description"
                        class="text-input"
                        rows="5"><?php echo htmlspecialchars($description ?? ''); ?>
                        </textarea>
                </div>

                <div>
                    <button type="submit" name="add-image" class="btn btn-big">
                        Opublikuj
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="assets/js/script.js"></script>

</body>
</html>