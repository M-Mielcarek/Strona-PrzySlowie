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
    <title>Admin - Zarządzaj kalendarzem</title>
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
            <h2 class="page-title">Zarządzaj wydarzeniami</h2>

            <table>
                <thead>
                    <tr>
                        <th>l.p</th>
                        <th>Nazwa wydarzenia</th>
                        <th>Data</th>
                        <th colspan="2">Działanie</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($events as $key => $event): ?>
                    <tr>
                        <td><?= $key + 1; ?></td>

                        <td><?= htmlspecialchars($event['title']); ?></td>

                        <td>
                            <?php
                                echo date('d.m.Y', strtotime($event['start_date']));

                                if (!empty($event['end_date']) && $event['end_date'] !== $event['start_date']) {
                                    echo ' – ' . date('d.m.Y', strtotime($event['end_date']));
                                }
                            ?>
                        </td>

                        <td>
                            <a href="calendar_edit.php?id=<?= $event['id']; ?>" class="edit">
                                edytuj
                            </a>
                        </td>

                        <td>
                            <a href="calendar_index.php?del_id=<?= $event['id']; ?>" 
                               class="delete"
                               onclick="return confirm('Na pewno usunąć to wydarzenie?');">
                                usuń
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
