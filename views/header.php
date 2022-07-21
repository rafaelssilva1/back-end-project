<header class="header">
    <nav class="container nav">
        <div class="nav__logo" >
            <a href="/"><img src="/assets/logo.svg"></a>
        </div>
        <ul class="hamburguer">
            <form class="nav__form" onSubmit={redirectForm}>
                <button class="nav__search">
                <span class="material-symbols-outlined">
                    search
                </span>
                </button>
                <input type="text" id="navSearch" class="nav__input" placeholder="Find any movie..." />
            </form>
        </ul>
    </nav>
</header>