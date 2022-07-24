const watchlistBtn = document.querySelector(".watchlist__button");

let url = window.location.pathname;
url = url.split("/");

const addToWatchlist = () => {
    if(watchlistBtn.firstElementChild.innerText == "favorite") {
        try {
            const requestOptions = {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ movie_id: url[url.length - 1], user_id: 1 })
            };
            
            fetch(`/movies`, requestOptions)
                .then(response => response.json());
        } catch (error) {
            console.log(error);
        }
    
        watchlistBtn.firstElementChild.textContent = "favorite_border";
    } else {
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
};

tinymce.init({
    selector: 'textarea',
    plugins: 'advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
    toolbar: 'undo redo | styles | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    menubar: false,
    content_style: '@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap");',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name'
});
