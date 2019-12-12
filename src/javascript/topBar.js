'use strict'

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
let body = document.getElementById("body");

searchField.addEventListener("focus", () => {
                                                if(!extraOptions.classList.contains("show")) {
                                                    extraOptions.classList.add("show");
                                                    
                                                    extraOptions.classList.remove("dropdownAnimation");
                                                    void extraOptions.offsetWidth;
                                                    extraOptions.classList.add("dropdownAnimation");

                                                    body.classList.remove("dropdownAnimation");
                                                    void body.offsetWidth;
                                                    body.classList.add("dropdownAnimation");
                                                }
                                            });

closeExtraOptionsBtn.addEventListener("click", () => {
                                                        if(extraOptions.classList.contains("show")) {
                                                            extraOptions.classList.remove("dropUpAnimation");
                                                            void extraOptions.offsetWidth;
                                                            extraOptions.classList.add("dropUpAnimation");

                                                            body.classList.remove("dropUpAnimation");
                                                            void body.offsetWidth;
                                                            body.classList.add("dropUpAnimation");
                                                        }
                                                    });

extraOptions.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateUp") {
                                                                    extraOptions.classList.remove("show");
                                                                    extraOptions.classList.remove("dropUpAnimation");
                                                                    body.classList.remove("dropUpAnimation");
                                                                    body.classList.remove("dropdownAnimation");
                                                                }});
extraOptions.addEventListener("animationend", (event) => {if(event.animationName == "translateUp") {
                                                            extraOptions.classList.remove("show");
                                                            extraOptions.classList.remove("dropUpAnimation");
                                                            body.classList.remove("dropUpAnimation");
                                                            body.classList.remove("dropdownAnimation");
                                                        }});

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
