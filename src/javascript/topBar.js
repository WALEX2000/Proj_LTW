'use strict'

function toggle_search_form() {
    document.getElementById("search_form").classList.toggle("show");
    console.log("ola\n")
}

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

var slider = document.getElementById("budget_slider");
var output = document.getElementById("budget_value");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}