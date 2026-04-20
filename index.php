<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/topics.php");

$posts = [];
$postsTitle = 'Ostatnio dodane';
$issues = selectAll('issues');

if (isset($_GET['t_id'])) {
    $posts = getPostsByTopicId($_GET['t_id']);
    $postsTitle = "Wyszukano temat: '" . htmlspecialchars($_GET['name']) . "'";
}
elseif (isset($_POST['search-term'])) {
    $posts = searchPosts($_POST['search-term']);
    $postsTitle = "Wyszukano: '" . htmlspecialchars($_POST['search-term']) . "'";
}
else {
    $posts = getPublishedPosts();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">

    <title>PrzySłowie - Pismo Studentów UŁ</title>
</head>

<body>
    <?php
        include(ROOT_PATH . "app/includes/header.php");
        include(ROOT_PATH . "app/includes/messages.php");
    ?>

    <div class="page-wrapper">


        <div class="post-slider">
            <h1 class="slider-title">Najnowsze wydania</h1>

            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next"></i>

            <div class="post-wrapper">
                <?php

$counter = 0;
foreach ($issues as $issue):
    if ($counter >= 6) break;
?>
    <div class="post">
        <img src="<?php  echo BASE_URL . 'assets/images/issues-pic/' . (!empty($issue['image']) ? htmlspecialchars($issue['image']) : 'wyd.png'); 
    ?>" 
    alt="<?php echo htmlspecialchars($issue['name']); ?>" 
    class="slider-image"
/>
        <div class="post-info">
            <h3>
                <a href="wydania.php?id=<?php echo $issue['id']; ?>">
                    <?php echo htmlspecialchars($issue['name']); ?>
                </a>
            </h3>
            <i class="far fa-calendar">
                <?php echo date('d.m.Y', strtotime($issue['created_at'])); ?>
            </i>

            <p class="preview-text">
                <?php echo htmlspecialchars($issue['description']); ?>
            </p>
        </div>
    </div>
<?php 
    $counter++;
endforeach; 
?>

            </div>
        </div>


        <div class="content clearfix">

            <div class="main-content">
                <h1 class="recent-post-title"><?php echo $postsTitle; ?></h1>

                <?php

                usort($posts, function($a, $b) {
                    return strtotime($b['created_at']) - strtotime($a['created_at']);
                });

                $counter = 0;
                foreach ($posts as $post):
                    if ($counter >= 4) break;
                ?>
                    <div class="post clearfix">
                        <img src="<?php echo BASE_URL . 'assets/images/' . $post['image']; ?>" alt="" class="post-image">
                        
                        <div class="post-preview">
                            <h1><a href="single.php?id=<?php echo $post['id']; ?>">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a></h1>

 <!--
<i class="far fa-user"> <?php echo htmlspecialchars($post['username']); ?> </i> <br> 
-->

                            <i class="far fa-calendar">
                                <?php echo date('d.m.Y', strtotime($post['created_at'])); ?>
                            </i>

                            <p class="preview-text">
                                <?php echo htmlspecialchars($post['description']); ?>
                            </p>

                            <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Przeczytaj</a>
                        </div>
                    </div>
                <?php
                    $counter++;
                endforeach;
                ?>

                <a href="all.php" class="btn">Wyświetl wszystkie</a>
            </div>

            <div class="sidebar">

                <div class="section search">
                    <h2 class="section-title">Szukaj</h2>
                    <form action="index.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Szukaj...">
                    </form>
                </div>

                <div class="section topics">
                    <h2 class="section-title">Wybrane tematy</h2>
                    <ul>

                        <?php 
                        $lastTopics = array_slice($topics, -8);
                        foreach ($lastTopics as $topic):
                        ?>
                            <li>
                                <a href="<?php echo BASE_URL . 'index.php?t_id=' . $topic['id'] . '&name=' . urlencode($topic['name']); ?>">
                                    <?php echo htmlspecialchars($topic['name']); ?>
                                </a>
                            </li>
                            <?php
                endforeach;
                ?>
                    </ul>
                </div>

            </div>
        </div>

    </div>

    <?php include(ROOT_PATH . "app/includes/footer.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>