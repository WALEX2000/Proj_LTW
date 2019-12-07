'use strict'

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function toggle_search_form() {
    document.getElementById("search_form").classList.toggle("show");
    console.log("ola\n")
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches('.dropdown *')) {
        let dropdowns = document.getElementsByClassName("dropdown-content");
        let i;
        for (i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}