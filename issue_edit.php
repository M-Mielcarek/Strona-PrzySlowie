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
    <title>Admin - Edytuj wydanie</title>
    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #body { min-height: 150px; min-width: 880px; overflow-y: scroll; }
    </style>
</head>
<body>
<?php include(ROOT_PATH ."app/includes/admin_header.php"); ?>

<div class="admin-wrapper">
    <?php include(ROOT_PATH ."app/includes/admin_sidebar.php"); ?>

    <div class="admin-content">
        <div class="button-group">
            <a href="issue_create.php" class="btn btn-big">Utwórz wydanie</a>
            <a href="issue_index.php" class="btn btn-big">Zarządzaj wydaniami</a>
        </div>

        <div class="content">
            <h2 class="page-title">Edytuj wydanie</h2>
            <?php include(ROOT_PATH . "app/helpers/formErrors.php"); ?>

            <form action="issue_edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $issue['id']; ?>">

                <div>
                    <label>Tytuł</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" class="text-input">
                </div>

                <div>
                    <label>Opis</label>
                    <textarea name="description" id="body"><?php echo htmlspecialchars($description); ?></textarea>
                </div>

                <div>
                    <label>Wybierz artykuły:</label>
                    <select id="article-select" name="article_ids[]" class="styled-select" multiple>
                        <?php foreach ($allPosts as $post): ?>
                            <option value="<?php echo $post['id']; ?>" 
                                <?php if(in_array($post['id'], $selectedArticles)) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($post['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <ul id="selected-list" class="selected-list"></ul>
                </div>

                <div>
                    <button type="submit" name="update-issue" class="btn btn-big">Wprowadź zmiany</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="assets/js/script.js"></script>

<script>
$(document).ready(function() {
    $('#article-select').select2({
        placeholder: 'Wyszukaj artykuły...',
        allowClear: true,
        width: '100%'
    });

    const selectedList = document.getElementById('selected-list');

    function buildSelectedList() {
        const selected = $('#article-select').select2('data');
        const existingIds = new Set();
        $('#selected-list').empty();
        selected.forEach(item => {
            if(!existingIds.has(item.id)){
                $('#selected-list').append(`<li data-id="${item.id}"><span class="handle">≡</span>${item.text}</li>`);
                existingIds.add(item.id);
            }
        });
    }

    buildSelectedList();
    $('#article-select').on('change', buildSelectedList);

    Sortable.create(selectedList, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        handle: '.handle',
        onEnd: function() {
            const newOrder = [];
            $('#selected-list li').each(function() {
                newOrder.push($(this).data('id'));
            });
            $('#article-select').val(newOrder).trigger('change.select2');
        }
    });
});
</script>

</body>
</html>
