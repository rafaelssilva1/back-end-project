const logBtn = document.querySelector(".log_button");

logBtn.addEventListener("click", (e) => {
    document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    location.reload();
});