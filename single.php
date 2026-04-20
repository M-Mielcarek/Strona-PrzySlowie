<?php 
include("path.php");
include(ROOT_PATH . 'app/controllers/posts.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>

    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">

    <style>
        .post-content {
        font-family: monospace;
        white-space: pre-line;
        width: 95%;
        margin: 20px auto;

          text-align: left;
  margin-left: 0 !important;
  margin-right: auto !important;
    display: block;
        }

    </style>
</head>

<body>
    <!-- header -->
    <?php include(ROOT_PATH . "app/includes/header.php"); ?>
    <!-- header -->

    <div class="page-wrapper">
        <div class="content clearfix">
            <div class="main-content wrapper">
                <div class="main-content single">
                    <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>

                    <div class="post-content">
                        <?php 
echo $post['body'];
                        ?>
                    </div>
                </div>
            </div>

            <div class="sidebar single">
                <div class="section popular">
                    <h2 class="section-title">Popularne</h2>
                    <?php
                    $counter = 0;
                    foreach ($posts as $p): 
                        if ($counter >= 4) break;
                    ?>
                        <div class="post clearfix">
                            <img src="<?php echo BASE_URL . 'assets/images/' . $p['image']; ?>" alt="">
                            <a href="single.php?id=<?php echo $p['id']; ?>" class="title">
                                <h4><?php echo htmlspecialchars($p['title']); ?></h4>
                            </a>
                        </div>
                    <?php 
                        $counter++;
                    endforeach; 
                    ?>
                </div>

                <div class="section topics">
                    <h2 class="section-title">Tematy</h2>
                    <ul>
                        <?php foreach($topics as $topic): ?>
                            <li><a href="<?php echo BASE_URL . 'index.php?t_id=' . $topic['id']; ?>"><?php echo htmlspecialchars($topic['name']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include(ROOT_PATH . "app/includes/footer.php"); ?>
    <!-- footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
