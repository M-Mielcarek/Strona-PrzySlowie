<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/issues.php");
usersOnly();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <title>Admin - Zarządzaj wydaniami</title>
</head>

<body>
<?php include(ROOT_PATH ."app/includes/admin_header.php"); ?>

<div class="admin-wrapper">

    <?php include(ROOT_PATH ."app/includes/admin_sidebar.php"); ?>

    <div class="admin-content">
        <div class="button-group">
            <a href="issue_create.php" class="btn btn-big">Utwórz wydanie</a>
            <a href="issue_index.php" class="btn btn-big">Zarządzaj wydaniami</a>
        </div>

        <div class="content">
            <h2 class="page-title">Zarządzaj wydaniami</h2>

            <table>
                <thead>
                    <th>l.p</th>
                    <th>Nazwa wydania</th>
                    <th>Liczba artykułów</th>
                    <th colspan="2">Działanie</th>
                </thead>
                <tbody>

                <?php foreach($issues as $key => $issue): ?>
                    <?php 
                        $count = 0; 
                        if (!empty($issue['posts'])) {
                            $count = count(explode(',', $issue['posts']));
                        }
                    ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo htmlspecialchars($issue['name']); ?></td>
                        <td><?php echo $count; ?></td>
                        <td><a href="issue_edit.php?id=<?php echo $issue['id']; ?>" class="edit">edytuj</a></td>
                        <td><a href="issue_index.php?del_id=<?php echo $issue['id']; ?>" class="delete">usuń</a></td>
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
