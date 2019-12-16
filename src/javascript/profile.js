'use strict'

let tripsPanel = document.getElementById("userTrips");
let ownedPanel = document.getElementById("ownedHouses");
let editPanel = document.getElementById("editProfilePanel");

let currentPanel = tripsPanel;
let prevPanel;
let moving = false;

let editButton = document.getElementById("editButton");
let tripsButton = document.getElementById("tripsButton");
let ownedHousesButton = document.getElementById("ownedHousesButton");

function changePanel(newPanel) {
    if(newPanel == currentPanel || moving) return;
    prevPanel = currentPanel;
    moving = true;

    void currentPanel.offsetWidth;
    currentPanel.classList.add("slideLeftAnimation");

    void newPanel.offsetWidth;
    newPanel.classList.remove("hiddenPanel");
    newPanel.classList.add("currentPanel");
    newPanel.classList.add("slideLeftEnterAnimation");

    currentPanel = newPanel;
}

function highlightButton(button) {
    if(moving) return;
    editButton.style.background = "rgba(255,255,255,0.95)";
    tripsButton.style.background = "#789BD0";
    ownedHousesButton.style.background = "#789BD0";

    button.style.background = "#e6e227";
}

highlightButton(tripsButton);

editButton.addEventListener("click", ()=>{highlightButton(editButton); changePanel(editPanel);});
tripsButton.addEventListener("click", ()=>{highlightButton(tripsButton); changePanel(tripsPanel);});
ownedHousesButton.addEventListener("click", ()=>{highlightButton(ownedHousesButton); changePanel(ownedPanel);});

function removePrevPanel() {
    prevPanel.classList.remove("currentPanel");
    prevPanel.classList.add("hiddenPanel");

    prevPanel.classList.remove("slideLeftAnimation");
    currentPanel.classList.remove("slideLeftEnterAnimation");

    moving = false;
}

editPanel.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
editPanel.addEventListener("animationend", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
tripsPanel.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
tripsPanel.addEventListener("animationend", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
ownedPanel.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
ownedPanel.addEventListener("animationend", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
