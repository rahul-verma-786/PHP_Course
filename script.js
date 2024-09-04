
    document.addEventListener("DOMContentLoaded", function () {
        var currentUrl = window.location.pathname.split("/").pop();
        var activeLink = document.querySelector('nav a[href="' + currentUrl + '"]');
        
        console.log("Current URL: " + currentUrl);
        console.log("Active Link: ", activeLink);
    
        if (activeLink) {
            activeLink.classList.add("active");
        }
    });
