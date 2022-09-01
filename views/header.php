<header class="header">
    <nav class="container nav">
        <div class="nav__logo" >
            <a href="/"><img src="/assets/logo.svg"></a>
        </div>
        <ul class="nav__links hamburguer">
            <li>
                <a href="/movies">All Movies</a>
            </li>
            <li>
                <a href="/movie-night-ideas">Movie Night Ideas</a>
            </li>
            <li>
                <a href="/watchlist">Watchlist</a>
            </li>
            <li>
                <?php
                    if(!isset($_COOKIE["token"])) {
                        ?>
                            <a href="/login">
                                <span >
                                    Login
                                </span>
                            </a>
                        <?php
                    } else {
                        ?>
                            <a href="/login">
                                <span>
                                    My Account
                                </span>
                            </a>
                        <?php
                    }
                ?>
            </li>
            <?php
                if(isset($_COOKIE["token"]) and $userPayload["is_admin"] == 1) {
                    ?>
                        <li>
                            <a href="/admin/">
                                <span >
                                    Admin Area
                                </span>
                            </a>
                        </li>
                    <?php
                }

                if(isset($_COOKIE["token"])) {
                    ?>
                        <li>
                            <a class="log_button">
                                <span class="material-icons-outlined">
                                    exit_to_app
                                </span>
                            </a>
                        </li>
                    <?php
                }
            ?>
            
            <form class="nav__form" method="GET" action="/search/">
                <input class="nav__input" type="text" name="filter" id="filter" placeholder="Find a movie here..." required>
                <button type="submit" class="nav__button"><span class="material-icons-outlined">search</span></button>
            </form>
        </ul>
        <div class="nav__hamburguer">
            <span class="material-icons-outlined">menu</span>
        </div>
    </nav>
    <script>
        hamburguerBtn = document.querySelector(".nav__hamburguer");
        linksBtn = document.querySelector(".nav__links");
        
        hamburguerBtn.addEventListener("click", () => {
            linksBtn.classList.toggle("active");
        });
    </script>
    <script src="/js/logout.js"></script>
    
</header>