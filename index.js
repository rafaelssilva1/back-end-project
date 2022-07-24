const watchlistBtn = document.querySelector(".watchlist__button");

let url = window.location.pathname;
url = url.split("/");

const addToWatchlist = (e) => {
    try {
        const requestOptions = {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ movie_id: url[url.length - 1], user_id: 1 })
        };
        
        fetch(`/movies`, requestOptions)
            .then(response => response.json());
    } catch (error) {
        console.log(error);
    }

    watchlistBtn.firstElementChild.textContent = "favorite";

};