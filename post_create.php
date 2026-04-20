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
    <title>Admin - Utwórz artykuł</title>

    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <style>
        #body {
            min-height: 400px;
            min-width: 870px;
            overflow-y: scroll;
        }
textarea#body {
    display: none;
}
    </style>
</head>

<body>

    <?php include(ROOT_PATH ."app/includes/admin_header.php"); ?>
    <div class="admin-wrapper">
        <?php include(ROOT_PATH ."app/includes/admin_sidebar.php"); ?>

        <div class="admin-content">
            <div class="button-group">
                <a href="post_create.php" class="btn btn-big">Utwórz artykuł</a>
                <a href="post_index.php" class="btn btn-big">Zarządzaj artykułami</a>
            </div>

<div class="admin-content">
<div class="content">

<h2>Utwórz artykuł</h2>

<?php include(ROOT_PATH . 'app/helpers/formErrors.php');?>

<form action="post_create.php" method="post" enctype="multipart/form-data">

    <div>
        <label>Tytuł</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
    </div>

    <div>
       <label>Treść</label>
       <textarea name="body" id="body"><?php echo htmlspecialchars($body); ?></textarea>
    </div>

                    <div>
                        <label>Opis</label>
                        <textarea name="description" class="text-input" style="min-height:120px;"><?php echo htmlspecialchars($description); ?></textarea>
                    </div>


                    <div>
                        <label>Obraz</label>
                        <?php if (!empty($image)): ?>
                            <img src="<?php echo BASE_URL . 'assets/images/' . $image; ?>" alt="Current Image" style="width:150px; margin-bottom:10px;">
                        <?php endif; ?>
                        <input type="file" name="image" class="text-input">
                    </div>

                    <div>
                        <label>Temat</label>
                        <select name="topic_id" class="text-input">
                            <?php foreach($topics as $topic): ?>
                                <option value="<?php echo $topic['id']; ?>" 
                                    <?php if (!empty($topic_id) && $topic_id == $topic['id']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($topic['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label>
                            <input type="checkbox" name="published" <?php if(!empty($published)) echo 'checked'; ?>>
                            Opublikuj
                        </label>
                    </div>

                    <div>
                        <button type="submit" name="add-post" class="btn btn-big">Publikuj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

<!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="assets/js/script.js"></script>


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
ClassicEditor
    .create(document.querySelector('#body'))
    .then(editor => {
        editor.editing.view.change(writer => {
            writer.setStyle('min-height', '400px', editor.editing.view.document.getRoot());
        });
    })
    .catch(error => console.error(error));
</script>

</body>
</html>