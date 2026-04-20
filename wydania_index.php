<?php
include("path.php");
include(ROOT_PATH . "app/controllers/issues.php");

if (!isset($issues) || !is_array($issues)) {
    $issues = [];
}

usort($issues, function ($a, $b) {
    $dateA = isset($a['created_at']) ? strtotime($a['created_at']) : 0;
    $dateB = isset($b['created_at']) ? strtotime($b['created_at']) : 0;
    return $dateB - $dateA;
});

$issuesPerPage = 8;
$totalIssues = count($issues);
$totalPages = max(1, ceil($totalIssues / $issuesPerPage));

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

$start = ($page - 1) * $issuesPerPage;
$issuesToShow = array_slice($issues, $start, $issuesPerPage);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wydania</title>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/scale.css">
<style>
.issue-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 5px;
    float: left;
}
.post-preview { overflow: hidden; }
</style>
</head>
<body>

<?php include(ROOT_PATH . "app/includes/header.php"); ?>

<div class="page-wrapper">
    <div class="content clearfix">
        <div class="main-content wrapper">
            <h1 class="recent-post-title">Wszystkie numery</h1>

            <?php foreach($issuesToShow as $issue): ?>
                <?php 
                $imagePath = !empty($issue['image']) && file_exists(ROOT_PATH . 'assets/images/issues-pic/' . $issue['image']) 
                    ? BASE_URL . 'assets/images/issues-pic/' . $issue['image'] 
                    : BASE_URL . 'assets/images/issues-pic/wyd.png';
                ?>
                <div class="post clearfix">
                    <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($issue['name']); ?>" class="issue-image">
                    <div class="post-preview">
                        <h1>
                            <a href="wydania.php?id=<?php echo $issue['id']; ?>">
                                <?php echo htmlspecialchars($issue['name']); ?>
                            </a>
                        </h1>

                        <i class="far fa-calendar"></i> 
                        <?php echo date('d.m.Y', strtotime($issue['created_at'])); ?>

                        <p class="preview-text">
                            <?php echo html_entity_decode(substr($issue['description'], 0, 150) . '...'); ?>
                        </p>

                        <a href="wydania.php?id=<?php echo $issue['id']; ?>" class="btn read-more">Przeczytaj</a>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a class="fas fa-chevron-left prev" href="?page=<?php echo $page - 1; ?>"></a>
                <?php endif; ?>
                <span class="page-info">Strona <?php echo $page; ?> z <?php echo $totalPages; ?></span>
                <?php if ($page < $totalPages): ?>
                    <a class="fas fa-chevron-right next" href="?page=<?php echo $page + 1; ?>"></a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php include(ROOT_PATH."app/includes/footer.php"); ?>

</body>
</html>
