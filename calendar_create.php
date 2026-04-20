<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/calendar.php");
usersOnly();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <title>Admin - Utwórz wydarzenie</title>
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
            <h2 class="page-title">Dodaj wydarzenie</h2>

            <?php include(ROOT_PATH . "app/helpers/formErrors.php"); ?>

            <form action="calendar_create.php" method="post">

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
                    <label>Data zakończenia (opcjonalna)</label>
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
                        class="text-input" 
                        style="min-height:150px;"
                    ><?= htmlspecialchars($description); ?></textarea>
                </div>

                <div>
                    <button type="submit" name="add-event" class="btn btn-big">
                        Dodaj wydarzenie
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/47.1.0/ckeditor5.umd.js"></script>
<script src="assets/js/script.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</body>
</html>