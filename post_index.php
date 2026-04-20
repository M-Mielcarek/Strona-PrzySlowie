<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/posts.php");

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

    <title>Admin - Zarządzaj artykułami</title>
</head>

<body>
    <?php include(ROOT_PATH . "app/includes/admin_header.php"); ?>

    <div class="admin-wrapper">

        <?php include(ROOT_PATH . "app/includes/admin_sidebar.php"); ?>

        <div class="admin-content">

            <div class="button-group">
                <a href="post_create.php" class="btn btn-big">Utwórz artykuł</a>
                <a href="post_index.php" class="btn btn-big">Zarządzaj artykułami</a>
            </div>

            <div class="content">
                <h2 class="page-title">Zarządzaj artykułami</h2>

                <?php include(ROOT_PATH . "app/includes/messages.php"); ?>

                <table>
                    <thead>
                        <tr>
                            <th>l.p</th>
                            <th>tytuł</th>
                            <th>autor</th>
                            <th colspan="3">działanie</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($posts as $key => $post): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>

                                <td><?php echo htmlspecialchars($post['title']); ?></td>
                                <td><?php echo htmlspecialchars($post['username'] ?? 'Nieznany'); ?></td>

                                <td>
                                    <a href="post_edit.php?id=<?php echo $post['id']; ?>" class="edit">edytuj</a>
                                </td>

                                <td>
                                    <a href="post_index.php?delete_id=<?php echo $post['id']; ?>" class="delete">usuń</a>
                                </td>

                                <?php if ($post['published']): ?>
                                    <td>
                                        <a href="post_index.php?published=0&p_id=<?php echo $post['id']; ?>" 
                                           class="unpublish">cofnij publikacje</a>
                                    </td>
                                <?php else: ?>
                                    <td>
                                        <a href="post_index.php?published=1&p_id=<?php echo $post['id']; ?>" 
                                           class="publish">opublikuj</a>
                                    </td>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>