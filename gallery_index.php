<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/gallery.php");
usersOnly();
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

    <title>Admin - Zarządzaj galerią</title>
</head>

    <style>
        .gallery-thumb {
            width: 120px;
            height: auto;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<?php include(ROOT_PATH . "app/includes/admin_header.php"); ?>

<div class="admin-wrapper">

    <?php include(ROOT_PATH . "app/includes/admin_sidebar.php"); ?>

    <div class="admin-content">

        <div class="button-group">
            <a href="gallery_create.php" class="btn btn-big">Dodaj obraz</a>
        </div>

        <div class="content">
            <h2 class="page-title">Galeria - obrazy</h2>

            <?php include(ROOT_PATH . "app/includes/messages.php"); ?>

            <table>
                <thead>
                    <tr>
                        <th>l.p</th>
                        <th>podgląd</th>
                        <th>nazwa</th>
                        <th>działanie</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($gallery as $key => $image): ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>

                            <td>
                                <img 
                                    src="<?php echo BASE_URL . 'assets/images/gallery/' . $image['image']; ?>" 
                                    class="gallery-thumb"
                                    alt=""
                                >
                            </td>

                            <td><?php echo htmlspecialchars($image['title']); ?></td>

                            <td>
                                <a href="gallery_index.php?delete_id=<?php echo $image['id']; ?>"
   class="delete"
   onclick="return confirm('Na pewno usunąć ten obraz?');">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="assets/js/script.js"></script>

</body>
</html>