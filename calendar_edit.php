<?php 
include("path.php");
require_once(ROOT_PATH . "app/controllers/calendar.php");
usersOnly();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Edytuj wydarzenie</title>

    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/admin.css">

    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">

    <style>
        #body {
            min-height: 150px;
            resize: vertical;
        }
    </style>
</head>

<body>

<?php include(ROOT_PATH . "app/includes/admin_header.php"); ?>

<div class="admin-wrapper">

    <?php include(ROOT_PATH . "app/includes/admin_sidebar.php"); ?>

    <div class="admin-content">

        <div class="button-group">
            <a href="calendar_create.php" class="btn btn-big">Utwórz wydarzenie</a>
            <a href="calendar_index.php" class="btn btn-big">Zarządzaj kalendarzem</a>
        </div>

        <div class="content">
            <h2 class="page-title">Edytuj wydarzenie</h2>

            <?php include(ROOT_PATH . "app/helpers/formErrors.php"); ?>

            <form action="calendar_edit.php" method="post">

                <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">

                <div>
                    <label>Nazwa wydarzenia</label>
                    <input 
                        type="text" 
                        name="title" 
                        value="<?= htmlspecialchars($title); ?>" 
                        class="text-input"
                        required
                    >
                </div>

                <div>
                    <label>Data rozpoczęcia</label>
                    <input 
                        type="date" 
                        name="start_date" 
                        value="<?= htmlspecialchars($start_date); ?>" 
                        class="text-input"
                        required
                    >
                </div>

                <div>
                    <label>Data zakończenia</label>
                    <input 
                        type="date" 
                        name="end_date" 
                        value="<?= htmlspecialchars($end_date); ?>" 
                        class="text-input"
                    >
                </div>

                <div>
                    <label>Opis wydarzenia</label>
                    <textarea 
                        name="description" 
                        id="body" 
                        class="text-input"
                    ><?= htmlspecialchars($description); ?></textarea>
                </div>

                <div>
                    <button type="submit" name="update-event" class="btn btn-big">
                        Zapisz zmiany
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>