<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/issues.php");
usersOnly();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <title>Admin - Utwórz wydanie gazety</title>
    <style>
        #body {
            min-height: 150px;
            min-width: 880px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
<?php include(ROOT_PATH . "app/includes/admin_header.php"); ?>

<div class="admin-wrapper">

    <?php include(ROOT_PATH . "app/includes/admin_sidebar.php"); ?>

    <div class="admin-content">
        <div class="button-group">
            <a href="issue_create.php" class="btn btn-big">Utwórz wydanie</a>
            <a href="issue_index.php" class="btn btn-big">Zarządzaj wydaniami</a>
        </div>

        <div class="content">
            <h2 class="page-title">Dodaj wydanie gazety</h2>
            <?php include(ROOT_PATH . "app/helpers/formErrors.php"); ?>

            <form action="issue_create.php" method="post" enctype="multipart/form-data">
                <div>
                    <label>Tytuł wydania</label>
                    <input type="text" name="name" value="<?php echo $name; ?>" class="text-input">
                </div>

                <div>
                    <label>Opis wydania</label>
                    <textarea name="description" id="body"><?php echo htmlspecialchars($description); ?></textarea>
                </div>

                <div>
                    <label>Wybierz obraz wydania</label>
                    <input type="file" name="issue_image" id="issue_image" accept="image/*" class="text-input">
                    <div id="image-preview" style="margin-top: 10px;">
                    <?php if(!empty($issue_image)): ?>
                        <img src="<?php echo $issue_image; ?>" alt="Podgląd obrazu" style="max-width: 300px; max-height: 200px;">
                    <?php endif; ?>
                </div>
                
                <div style="margin-top:15px;">
    <label>Dodaj plik PDF wydania</label>
    <input type="file" name="issue_pdf" id="issue_pdf" accept="application/pdf" class="text-input">

    <div id="pdf-preview" style="margin-top:10px;">
        <?php if(!empty($issue_pdf)): ?>
            <p>Aktualny plik: 
                <a href="<?php echo $issue_pdf; ?>" target="_blank">Zobacz PDF</a>
            </p>
        <?php endif; ?>
    </div>
</div>
            </div>

                <div>
<div>
    <label>Wybierz artykuły:</label>

    <select id="article-select" name="article_ids[]" multiple="multiple" class="styled-select">
        <?php foreach ($posts as $post): ?>
            <option 
                value="<?php echo $post['id']; ?>"
                <?php if (!empty($selectedArticles) && in_array($post['id'], $selectedArticles)) echo 'selected'; ?>
            >
                <?php echo htmlspecialchars($post['title']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <ul id="selected-list" class="selected-list"></ul>
</div>

                <div>
                    <button type="submit" name="add-issue" class="btn btn-big">Publikuj wydanie</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/47.1.0/ckeditor5.umd.js"></script>
<script src="assets/js/script.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
$(document).ready(function() {

    $('#article-select').select2({
        placeholder: 'Wyszukaj artykuły...',
        allowClear: true,
        width: '100%'
    });
    buildSelectedList();

    $('#article-select').on('change', buildSelectedList);

    function buildSelectedList() {
        const selected = $('#article-select').select2('data');
        const list = $('#selected-list');

        list.empty();

        selected.forEach(item => {
            list.append(`<li data-id="${item.id}">${item.text}</li>`);
        });

        updateOrder();
    }

    new Sortable(selected-list, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        onSort: updateOrder
    });

    function updateOrder() {
        let order = [];

        $('#selected-list li').each(function() {
            order.push($(this).data('id'));
        });
        $('#article-select').val(order).trigger('change.select2');
    }
});

$('#issue_image').on('change', function() {
    const [file] = this.files;
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#image-preview').html('<img src="' + e.target.result + '" alt="Podgląd obrazu" style="max-width: 300px; max-height: 200px;">');
        }
        reader.readAsDataURL(file);
    }
});

$('#issue_pdf').on('change', function() {
    const file = this.files[0];
    if (file) {
        $('#pdf-preview').html(
            '<p>Wybrany plik: <strong>' + file.name + '</strong></p>'
        );
    }
});

</script>
</body>
</html>
