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
};

//Search bar add options
let searchField = document.getElementById("searchField");
let extraOptions = document.getElementById("search_form");
let closeExtraOptionsBtn = document.getElementById("closeExtraOption");

searchField.addEventListener("focus", () => {extraOptions.classList.add("show");});

closeExtraOptionsBtn.addEventListener("click", () => {extraOptions.classList.remove("show");});

let searchButton = document.getElementById("searchButton");
let filterForm = document.getElementById("form");
let searchText = document.getElementById("searchField");

function submitSearch() {
    console.log("Submit");
    let location = searchText.value;

    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = "location";
    hiddenField.value = location;
    filterForm.appendChild(hiddenField);

    filterForm.submit();

    filterForm.removeChild(hiddenField);
}

searchButton.addEventListener("click", submitSearch);
