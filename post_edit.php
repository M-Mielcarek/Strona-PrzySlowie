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
    <title>Admin - Utwórz artykuł</title>

    <style>
        #body {
            min-height: 400px;
            min-width: 870px;
            overflow-y: scroll;
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
                <a href="post_index.php" class="btn btn-big">Zarządzaj artykułem</a>
            </div>

            <div class="content">

               <h2 class="page-title">Utwórz artykuł</h2>

               <?php include(ROOT_PATH . 'app/helpers/formErrors.php');?>

               <form action="post_create.php" method="post" enctype="multipart/form-data">
                   <div>
                       <label>Tytuł</label>
                       <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                   </div>

                   <div>
                       <label>Treść</label>
                       <textarea name="body" id="body"><?php echo $body ?></textarea>
                   </div>

                   <div>
                       <label>Opis</label>
                       <textarea name="description" class="text-input" style="min-height:140px;"><?php echo $description ?></textarea>
                   </div>

                   <div>
                       <label>Obraz</label>
                       <input type="file" name="image" class="text-input"> 
                   </div>

                   <div>
                       <label>Temat</label>
                       <select name="topic_id" class="text-input">
                           <?php foreach($topics as $key => $topic): ?>
                               <?php if (!empty($topic_id) && $topic_id == $topic['id']): ?>
                                   <option selected value="<?php echo $topic['id'];?>"><?php echo $topic['name'];?></option>
                               <?php else: ?>
                                   <option value="<?php echo $topic['id'];?>"><?php echo $topic['name'];?></option>
                               <?php endif; ?>
                           <?php endforeach; ?>
                       </select>
                   </div>

                   <div>
                       <?php if (empty($published)): ?>
                           <label> 
                               <input type="checkbox" name="published">
                               Opublikuj
                           </label>
                       <?php else: ?>
                           <label> 
                               <input type="checkbox" name="published" checked>
                               Opublikuj
                           </label>
                       <?php endif; ?>
                   </div>

                   <div>
                       <button type="submit" name="add-post" class="btn btn-big">Publikuj</button>
                   </div>

               </form>

            </div>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="assets/js/script.js"></script>
    <script
    >const textarea = document.getElementById('body');
const TAB = "    ";

textarea.addEventListener('keydown', function (e) {
  if (e.key !== 'Tab') return;

  e.preventDefault();

  const start = this.selectionStart;
  const end = this.selectionEnd;

  this.value =
    this.value.slice(0, start) +
    TAB +
    this.value.slice(end);

  this.selectionStart = this.selectionEnd = start + TAB.length;
});
    </script>
    
</body>

</html>