<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=brightness_6" />

<header>

    <a href="<?php echo BASE_URL . 'index.php'; ?>" class="logo">
        <h1 class="logo-text"><span>Przy</span>Słowie</h1>
    </a>

    <i class="fa-solid fa-bars menu-toggle"></i>

    <button id="theme-switch">
        <span class="material-symbols-outlined">brightness_6</span>
    </button>

    <ul class="nav">
        <li><a href="<?php echo BASE_URL . 'wydania_index.php'; ?>">Numery</a></li>
        <li><a href="<?php echo BASE_URL . 'redakcja.php'; ?>">Redakcja</a></li>

        <?php if (isset($_SESSION['id'])): ?>
            <li class="user-menu">
                <a href="#" class="user-toggle">
                    <?php echo $_SESSION['username']; ?>
                </a>

                <ul>
                    <li>
                        <a href="<?php echo BASE_URL . 'dashboard.php'; ?>">
                            Panel użytkownika
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo BASE_URL . 'logout.php'; ?>" class="logout">
                            Wyloguj się
                        </a>
                    </li>
                </ul>
            </li>
        <?php else: ?>
            <li>
                <a href="<?php echo BASE_URL . 'login.php'; ?>">
                    Zaloguj się
                </a>
            </li>
        <?php endif; ?>
    </ul>

</header>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const menuToggle = document.querySelector(".menu-toggle");
    const nav = document.querySelector(".nav");
    const userToggle = document.querySelector(".user-toggle");

    if(menuToggle){
        menuToggle.addEventListener("click", function(){
            if(window.innerWidth <= 770){
                nav.classList.toggle("showing");
            }
        });
    }

    if(userToggle){
        userToggle.addEventListener("click", function(e){
            if(window.innerWidth <= 770){
                e.preventDefault();
                this.parentElement.classList.toggle("active");
            }
        });
    }

});
</script>

<script type="text/javascript" defer>
    let darkmode = localStorage.getItem('darkmode')
    const themeSwitch = document.getElementById('theme-switch')

    const enableDarkmode = () => {
        document.body.classList.add('darkmode')
        localStorage.setItem('darkmode', 'active')
    }

    const disableDarkmode= () => {
        document.body.classList.remove('darkmode')
        localStorage.setItem('darkmode', null)
    }

    if(darkmode === "active") enableDarkmode()

    themeSwitch.addEventListener("click", ()=>{
        darkmode = localStorage.getItem('darkmode')
        darkmode !== "active" ? enableDarkmode() : disableDarkmode()
    })
</script>