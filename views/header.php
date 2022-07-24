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
                <a href="movie-night-ideas">Movie Night Ideas</a>
            </li>
            <li>
                <a href="watchlist">Watchlist</a>
            </li>
            <form class="nav__form" method="GET" action="/search/">
                <input class="nav__input" type="text" name="filter" id="filter" placeholder="Find a movie here..." required>
                <button type="submit" class="nav__button"><span class="material-symbols-outlined">search</span></button>
            </form>
        </ul>
    </nav>
</header>