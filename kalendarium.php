<?php 
include("path.php");
include(ROOT_PATH . 'app/controllers/calendar.php');

$rawEvents = selectAll('calendar');
$events = [];

foreach ($rawEvents as $event) {
    $start = new DateTime($event['start_date']);
    $end   = new DateTime($event['end_date']);

    while ($start <= $end) {
        $events[] = [
            'date'        => $start->format('Y-m-d'),
            'title'       => $event['title'],
            'description' => $event['description'],
            'type'        => $event['type'] ?? 'default'
        ];
        $start->modify('+1 day');
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/f45c1e3753.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/scale.css">
    <link rel="stylesheet" href="assets/css/klein.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <?php include(ROOT_PATH . "app/includes/header.php"); ?>
    <!-- header -->
<div class="calendar">
    <div id="my-calendar"></div>

    <div id="event-details" class="event-details">
        <h3 id="event-date-title">Wydarzenia</h3>
        <div id="event-list"></div>
    </div>
</div>

    <!-- footer -->
    <?php include(ROOT_PATH . "app/includes/footer.php"); ?>
    <!-- footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/klen.js"></script>
</body>

<script>
    const events = <?= json_encode($events, JSON_UNESCAPED_UNICODE); ?>;
    new Calendar("#my-calendar", events);
</script>

</html>
