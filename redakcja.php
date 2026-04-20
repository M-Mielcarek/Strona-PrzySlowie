<?php 
include("path.php");
include(ROOT_PATH . "app/controllers/users.php");
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

    <title>PrzySłowie - Redakcja</title>
</head>

<style>
.team-member {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.team-member img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    margin-left: 15px;
}

.team-info h3 {
    margin: 0;
    font-weight: bold;
    font-size: 18px;
}

.info-info {
color: var(--text-colour);
    display: flex;
    flex-direction: column;
    align-items: center;   
    text-align: center;   
}

.info-info h3 {
    font-weight: bold;
    font-size: 18px;
    margin: 0;
}

.info-info p {
    margin-top: 5px;
}

.team-info p {
color: var(--text-colour);
    margin: 15px 5px 5px 5px;
    font-size: 14px;
}
</style>

<body>
    <?php
        include(ROOT_PATH . "app/includes/header.php");
        include(ROOT_PATH . "app/includes/messages.php");
    ?>

    <div class="page-wrapper">

<div class "content clearfix"

            <div class="main-content wrapper">

<p></p>
<p></p>
<p></p>

    <div class="info-info">
        <h3>Nasza redakcja</h3>
<p></p>
<p> Za każdym wydaniem czasopisma PrzySłowie kryje się grupa pasjonatów i marzycieli, oto oni! </p>
<p> Mieszanka charakterów, ale jeden wspólny mianownik: niezwykła przyjemność czerpana z zabawy piórem.</p>
</div>

<p></p>
<p></p>
<p></p>

<div class="team-member">
    <img src="assets/images/static/7.png" alt="Livia Czechowicz">
    <div class="team-info">
        <h3>Livia Czechowicz</h3>
        <p> • Pisarka, felietonistka i miłośniczka literatury XX wieku, przede wszystkim międzywojnia. <p/>
<p>• Jej ulubionymi autorami są Bruno Schulz, Franz Kafka i Samuel Beckett.</p>
<p>• Inspiracji szuka w absurdach codzienności, dostrzegając w nich głębsze dno.</p>
<p>• Wyznaje radykalną ideę konieczności uwolnienia sztuki z więzów komercjalizacji.</p>
<p>• Prócz literatury interesuje się teatrem, działalnością społeczną i filozofią.</p>
<p>• Ma osobowość stworzoną do radia - uwielbia rozmawiać na przeróżne tematy, ale niekoniecznie przed kamerą.</p>
<p>• Recytowała kiedyś Ze szczytu schodów na szczycie schodów. </p>
<p></p>
    </div>
</div>

<div class="team-member">
    <img src="assets/images/static/5.png" alt="Kacper Hanczyc">
    <div class="team-info">
        <h3>Kacper Hanczyc</h3>
        <p>Nie śmiem nazwać się pisarzem, bo i po co? Pełnię rolę sekretarza dwóch kół naukowych. Od czasu do czasu nabazgrzę tekst, który może się podobać.</p>
<p>Nie wierze w ugrupowania artystyczne, to jakby podpisać się nazwiskiem pod słowami obcych ludzi. Jestem też hipokryta, bo moje teksty widnieją na stronie. </p>
<p></p>
    </div>
</div>

<div class="team-member">
    <img src="assets/images/static/2.png" alt="Antoni Jajczak">
    <div class="team-info">
        <h3>Antoni Jajczak</h3>
        <p>• Student II roku filologii polskiej, miłośnik literatury i kinematografii.</p>
<p>• Wśród jego ulubionych pisarzy znajdują się refleksyjny i introspektywny Wiesław Myśliwski, Haruki Murakami, u którego ceni szczególnie absurdalny humor, drążący ludzką duszę Fiodor Dostojewski, czy Tadeusz Konwicki, istotny również jako twórca filmowy.</p>
<p>• Słucha wielu gatunków muzycznych od jazzu przez hip hop i folk po indie rock.</p>
<p>• Poza tym lubi spacerować po lasach, tworzyć sytuacyjne memy i bez kontekstu recytować inwokację Pana Tadeusza. </p>
<p></p>
    </div>
</div>

<div class="team-member">
    <img src="assets/images/static/6.png" alt="Karina Józefiak">
    <div class="team-info">
        <h3>Karina Józefiak</h3>
        <p>• Studentka II roku filologii polskiej, profesjonalna gaduła i haterka, ilustratorka maczająca palce w felietonistyce i recenzjach.</p>
<p>• Do jej ulubionych twórców należą bell hooks, Joan Didion i Julian Tuwim.</p>
<p>• Jej pasją jest wszystko co związane z ludźmi i kulturą. Interesuje się literaturą, historią mody, sztuką i ruchami społecznymi, popkulturą, filozofią (prosimy nie pytać czy się na tym zna). </p>
<p>• Ironia to jej drugie imię, a feministyczne książki czyta bez mieszania ich z labubu dubai matchą, poza coffee ravami.</p>
<p>• Jeśli nie macie dużo czasu na rękach, prosimy nie pytać o ciekawostki biologiczne, do jakich ma dostęp.</p>
<p></p>
    </div>
</div>

<div class="team-member">
    <img src="assets/images/static/1.png" alt="Olga Jurek">
    <div class="team-info">
        <h3>Olga Jurek</h3>
        <p>• Studentka polonistyki, ambitna marzycielka, wrażliwa obserwatorka współczesnego świata i jego problemów.</p>
<p>• Zakochana w słowie, zwłaszcza tym spod pióra Różewicza i Leśmiana.</p>
<p>• Fascynuje ją ludzka psychika, szczególnie zależności między doświadczeniami z dzieciństwa a zachowaniami w dorosłym życiu. </p>
<p>• Wiecznie rozgadana i chętna na długa pogawędkę przy herbacie.</p>
<p>• Dumna posiadaczka duszy, którą nieustannie zamęcza metafizycznymi rozterkami. </p>
<p></p>
    </div>
</div>

<div class="team-member">
    <img src="assets/images/static/3.png" alt="Julita Michałek">
    <div class="team-info">
        <h3>Julita Michałek</h3>
        <p>• Jest miłośniczką skandynawskiego literackiego chłodu, psychologizmu, dystopii i wszystkiego, co pachnie szpitalnym korytarzem.</p>
<p>• Jej ulubionym pisarzem jest Michał Choromański.</p>
<p>• Pisze krótko i zazwyczaj z przymrużeniem oka, choć jako czytelniczka najczęściej wybiera teksty, po których musi zbierać się z podłogi.</p>
<p>• Pracoholizm traktuje jak hobby, a rozwój warsztatu jak misję.</p>
<p>• Członkowski Pokemon, który - podobnie jak jej ulubiony Ditto - nieustannie zmienia formę, by doskonalić swój warsztat. </p>
<p></p>
    </div>
</div>

<div class="team-member">
    <img src="assets/images/static/8.png" alt="Aleksander Mielcarek">
    <div class="team-info">
        <h3>Aleksander Mielcarek</h3>
        <p>• Pisarz, poeta i były aktor teatralny. </p>
<p>• Zafascynowany twórczością Zbigniewa Herberta i poezją byłych krajów sowieckich. </p>
<p>• Głęboko związany z Morzem Bałtyckim i Kaszubami. </p>
<p>• Natchnienie znajduje w pochylaniu się nad szczegółami życia i w ludziach dookoła.</p>
<p>• Poza pisaniem zajmuje się programowaniem, działalnością społeczną i meteorologią.</p>
<p>• Jest autorem naszej strony internetowej. </p>
<p>• Uwielbia rozmowy projektach, które czekają na ukończenie w szufladzie i o lepszym jutrze.</p>
<p></p>
    </div>
</div>

<div class="team-member">
    <img src="assets/images/static/4.png" alt="Anna Barbara Romanowska">
    <div class="team-info">
        <h3>Anna Barbara Romanowska</h3>
        <p>• Młoda pisarka, poetka i satyryczka, której słowa czerpią z ironii i bezwzględnej prawdy. Sceptyczna realistka o duszy z innej epoki.</p>
<p>• Patrzy na świat z gorzkim uśmiechem - nie po to, by go potępiać, lecz by go pozbawić pozorów i zrozumieć. Pisze wiersze, opowiadania, satyry i scenariusze teatralne, w których rozlicza współczesność z jej fałszywego indywidualizmu, społecznych podziałów i wirtualnych złudzeń.</p>
<p>• Inspiruje się Tuwimem i Hłaską.</p>
<p>• Wierzy, że sztuka, choć poturbowana i bliska upadku, wciąż potrafi ocalić człowieka, jeśli ten odważy się spojrzeć w stronę prawdy.</p>
<p></p>
    </div>
</div>

</div>
</div>
</div>
    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>