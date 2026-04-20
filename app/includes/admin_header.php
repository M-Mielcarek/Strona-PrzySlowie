<header>
    <a class="logo" href="<?php echo BASE_URL . 'index.php'; ?>"> 
        <h1 class="logo-text"><span>Przy</span>Słowie</h1>
    </a>

    <i class="fa fa-bars menu-toggle"></i>

    <button id="theme-switch">

    </button>

    <ul class="nav">
        <?php if (isset($_SESSION['username'])): ?>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                        <?php echo $_SESSION['username']; ?>
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>

                <ul>
                    <li>
                        <a href="<?php echo BASE_URL . 'logout.php'; ?>" class="logout">Wyloguj</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</header>

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

    if(darkmode ==="active") enableDarkmode()

    themeSwitch.addEventListener("click", ()=>{
        darkmode = localStorage.getItem('darkmode')
        darkmode!== "active" ? enableDarkmode() : disableDarkmode()
    })
</script>