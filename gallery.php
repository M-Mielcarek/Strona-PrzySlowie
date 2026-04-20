<?php
include("path.php");
include(ROOT_PATH . 'app/controllers/gallery.php');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">

    <title>Galeria</title>

    <style>
        .gallery-wrapper {
            max-width: 1200px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            border: 1px solid #ddd;
            background: #fff;
            transition: transform 0.2s ease;
        }

        .gallery-item:hover {
            transform: scale(1.02);
        }

        .gallery-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .gallery-desc {
            padding: 10px;
            font-size: 14px;
            text-align: center;
            color: #333;
        }
    </style>
</head>

<body>

<?php
include(ROOT_PATH . "app/includes/header.php");
include(ROOT_PATH . "app/includes/messages.php");
?>
  <h1 class="recent-post-title">Galeria</h1>
<div class="gallery-wrapper">

<?php if (!empty($gallery)): ?>
    <?php foreach ($gallery as $image): ?>
        <div class="gallery-item">
            <a href="<?php echo BASE_URL . 'assets/images/gallery/' . $image['image']; ?>" target="_blank">
                <img 
                    src="<?php echo BASE_URL . 'assets/images/gallery/' . $image['image']; ?>" 
                    alt="<?php echo htmlspecialchars($image['description']); ?>">
            </a>
            <?php if (!empty($image['description'])): ?>
                <div class="gallery-desc">
                    <?php echo htmlspecialchars($image['description']); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center;">Brak obrazów w galerii</p>
<?php endif; ?>

</div>

<?php include(ROOT_PATH . "app/includes/footer.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="assets/js/script.js"></script>

</body>
</html>