<!-- header for each page after login -->
<header>
    <div class="container">
        <div class="navbar flex">
            <div class="logo">
                <img src="/assets/img/logo.png" alt="Logo" class="logo-img">
            </div>
            <div class="nav-items">
                <a href="http://assignment4.net/dashboardController/showUserProfile">Hi!
                    <?php if (isset($_SESSION['Nname'])) {
                        echo $_SESSION['Nname'];
                    } ?>
                </a>
                <a href="http://assignment4.net/dashboardController/show">Dashboard </a>
                <a href="/dashboardController/showFavourates">Favourates</a>
                <a href="http://assignment4.net/dashboardController/showAddMusic">Add Music </a>
                <a href="http://assignment4.net/dashboardController/signOut">Sign Out</a>
            </div>
        </div>
    </div>
</header>