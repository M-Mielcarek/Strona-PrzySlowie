<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/topics.php");

$posts = array();
$postsTitle = 'Ostatnio dodane';

if (isset($_GET['t_id'])) {
    $posts = getPostsByTopicId($_GET['t_id']);
    $postsTitle = "Wyszukano '" . htmlspecialchars($_GET['name']) . "'";
} 
else if (isset($_POST['search-term'])) {
    $posts = searchPosts($_POST['search-term']);
    $postsTitle = "Wyszukano '" . htmlspecialchars($_POST['search-term']) . "'";
} 
else {
    $posts = getPublishedPosts();
}

usort($posts, function($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});

$postsPerPage = 8;
$totalPosts = count($posts);
$totalPages = ceil($totalPosts / $postsPerPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

$start = ($page - 1) * $postsPerPage;
$postsToShow = array_slice($posts, $start, $postsPerPage);
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

    <title>PrzySłowie - teksty</title>

</head>

<body>

    <!-- header -->
    <?php include(ROOT_PATH . "app/includes/header.php"); ?>
    <!-- header -->

    <div class="page-wrapper">

        <div class="content clearfix">
            <div class="main-content wrapper">

                <h1 class="recent-post-title">Wszystkie teksty</h1>

                <?php foreach($postsToShow as $post): ?>
                    <div class="post clearfix">
                        
                        <img src="<?php echo BASE_URL . 'assets/images/' . $post['image']; ?>" alt="" class="post-image">

                        <div class="post-preview">
                            <h1>
                                <a href="single.php?id=<?php echo $post['id']; ?>">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h1>

                            <i class="far fa-user"></i> <?php echo htmlspecialchars($post['username']); ?><br>

                            <i class="far fa-calendar"></i>
                            <?php echo date('d.m.Y', strtotime($post['created_at'])); ?>

                            <p class="preview-text">
                                <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
                            </p>

                            <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Przeczytaj</a>
                        </div>

                    </div>
                <?php endforeach; ?>

                <div class="pagination">

                <?php if ($page > 1): ?>
                    <a class="fas fa-chevron-left prev" href="?page=<?php echo $page - 1; ?>"></a>
                <?php endif; ?>

    <span class="page-info">
        Strona <?php echo $page; ?> z <?php echo $totalPages; ?>
    </span>

    <?php if ($page < $totalPages): ?>
        <a class="fas fa-chevron-right next" href="?page=<?php echo $page + 1; ?>"></a>
    <?php endif; ?>

</div>

            </div>
        </div>

    </div>

    <!-- footer -->
    <?php include(ROOT_PATH."app/includes/footer.php"); ?>
    <!-- footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>