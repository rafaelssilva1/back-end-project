const watchlistBtn = document.querySelector(".watchlist__button");

let url = window.location.pathname;
url = url.split("/");

watchlistBtn.addEventListener("click", (e) => {
    if(watchlistBtn.firstElementChild.innerText == "favorite") {
        try {
            const requestOptions = {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ movie_id: url[url.length - 1], watchlist: true})
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
                body: JSON.stringify({ movie_id: url[url.length - 1], watchlist: true })
            };
            
            fetch(`/movies`, requestOptions)
                .then(response => response.json());
        } catch (error) {
            console.log(error);
        }
    
        watchlistBtn.firstElementChild.textContent = "favorite";
    };
});

const reviewsBtns = document.querySelectorAll(".reviews__button");

reviewsBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        if(e.target.previousElementSibling.firstElementChild.hasAttribute("class", "reviews__content")) {
            e.target.previousElementSibling.firstElementChild.removeAttribute("class", "reviews__content");
            e.target.textContent = "Show less";
        } else {
            e.target.previousElementSibling.firstElementChild.setAttribute("class", "reviews__content");
            e.target.textContent = "Show more";
        }
    });
});

tinymce.init({
    selector: 'textarea',
    plugins: 'advcode casechange export formatpainter linkchecker autolink lists checklist permanentpen powerpaste table advtable tableofcontents tinycomments',
    toolbar: 'undo redo | styles | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
    menubar: false,
    content_style: '@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap");',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name'
});
