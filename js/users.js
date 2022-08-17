const deleteBtns = document.querySelectorAll(".delete_btn");
const adminBtns = document.querySelectorAll(".make_admin_btn");
const deleteMovieBtns = document.querySelectorAll(".deleteMovie_btn");
const deleteOwnBtn = document.querySelector(".delete_ownaccount");

deleteBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        let isExecuted = confirm("Are you sure you want to delete this user?");


        if(isExecuted) {
            try {
                const requestOptions = {
                    method: "DELETE",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ user_id: parseInt(btn.parentElement.firstElementChild.innerText)})
                };
                
                fetch(`/users`, requestOptions)
                    .then(response => response.json());

                alert("User deleted");
                location.reload();
            } catch (error) {
                console.log(error);
            }
        };
    });
});

adminBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        let isExecuted = confirm("Are you sure you want to proceed?");

        if(isExecuted) {
            try {
                const requestOptions = {
                    method: "PUT",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ user_id: parseInt(btn.parentElement.firstElementChild.innerText)})
                };
                
                fetch("/users", requestOptions)
                    .then(response => response.json());

                alert("User privileges updated");
                location.reload();
            } catch (error) {
                console.log(error);
            }
        };
    });
});

deleteMovieBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        let isExecuted = confirm("Are you sure you want to proceed?");

        if(isExecuted) {
            try {
                const requestOptions = {
                    method: "DELETE",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ movie_id: parseInt(btn.getAttribute("data-id")), deleteMovie: true})
                };
                
                fetch(`/movies`, requestOptions)
                    .then(response => response.json());

                alert("Movie deleted");
                location.reload();
            } catch (error) {
                console.log(error);
            }
        };
    });
});

deleteOwnBtn.addEventListener("click", () => {
    let isExecuted = confirm("Are you sure you want to delete your account?");

    if(isExecuted) {
        try {
            const requestOptions = {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ ownAccount: true})
            };
            
            fetch(`/users`, requestOptions)
                .then(response => response.json());

            alert("Account deleted");            
            document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.href = "/";
        } catch (error) {
            console.log(error);
        }
    };
});