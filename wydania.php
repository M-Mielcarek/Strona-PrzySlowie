<?php 
include("path.php");
include(ROOT_PATH . 'app/controllers/issues.php');

if (isset($_GET['id'])) {
    $issue = selectOne('issues', ['id' => $_GET['id']]);
    if ($issue) {
        $postIds = !empty($issue['posts']) ? explode(',', $issue['posts']) : [];
        $posts = [];
        foreach ($postIds as $pid) {
            $p = selectOne('posts', ['id' => $pid]);
            if ($p) $posts[] = $p;
        }
    }
}
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <title><?php echo htmlspecialchars($issue['name']); ?></title>
</head>

<body>
    <!-- header -->
    <?php include(ROOT_PATH . "app/includes/header.php"); ?>
    <!-- header -->

    <div class="page-wrapper">
        <div class="content clearfix">
            <div class="main-content wrapper">
                <div class="main-content single">
                    
                    <h1 class="post-title">
                        <?php echo htmlspecialchars($issue['name']); ?>
                    </h1>

                    <p>
                        <?php echo html_entity_decode($issue['description']); ?>
                    </p>

                    <?php if (!empty($issue['pdf'])): ?>
                        <div style="margin: 20px 0;">
                            <a href="<?php echo BASE_URL . $issue['pdf']; ?>" 
                               class="btn read-more pdf-download"
                               download>
                                <i class="fas fa-file-pdf"></i> Pobierz pełne wydanie (PDF)
                            </a>
                        </div>
                    <?php endif; ?>

                    <h2>Artykuły w tym wydaniu:</h2>

                    <?php if (!empty($posts)): ?>
                        <?php foreach($posts as $post): ?>
                            
                            <?php 
                                $author = selectOne('users', ['id' => $post['user_id']]);
                                $username = $author ? $author['username'] : 'Nieznany';
                            ?>

                            <div class="post clearfix">
                                <img src="<?php echo BASE_URL . 'assets/images/' . $post['image']; ?>" 
                                     alt="" 
                                     class="post-image">

                                <div class="post-preview">
                                    <h3>
                                        <a href="single.php?id=<?php echo $post['id']; ?>">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h3>

                                    <i class="far fa-user"></i> 
                                    <?php echo htmlspecialchars($username); ?><br>

                                    <i class="far fa-calendar"></i> 
                                    <?php echo date('d.m.Y', strtotime($post['created_at'])); ?>

                                    <p class="preview-text">
                                        <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
                                    </p>

                                    <a href="single.php?id=<?php echo $post['id']; ?>" 
                                       class="btn read-more">
                                        Przeczytaj
                                    </a>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Brak artykułów w tym wydaniu.</p>
                    <?php endif; ?>

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