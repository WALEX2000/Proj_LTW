let tripsPanel = document.getElementById("userTrips");
let ownedPanel = document.getElementById("ownedHouses");
let editPanel = document.getElementById("editProfilePanel");

let currentPanel = tripsPanel;
let prevPanel;

let editButton = document.getElementById("editButton");
let tripsButton = document.getElementById("tripsButton");
let ownedHousesButton = document.getElementById("ownedHousesButton");

function changePanel(newPanel) {
    if(newPanel == currentPanel) return;
    prevPanel = currentPanel;

    void currentPanel.offsetWidth;
    currentPanel.classList.add("slideLeftAnimation");

    void newPanel.offsetWidth;
    newPanel.classList.remove("hiddenPanel");
    newPanel.classList.add("currentPanel");
    newPanel.classList.add("slideLeftEnterAnimation");

    currentPanel = newPanel;
}

editButton.addEventListener("click", ()=>{changePanel(editPanel)});
tripsButton.addEventListener("click", ()=>{changePanel(tripsPanel)});
ownedHousesButton.addEventListener("click", ()=>{changePanel(ownedPanel)});

function removePrevPanel() {
    prevPanel.classList.remove("currentPanel");
    prevPanel.classList.add("hiddenPanel");

    prevPanel.classList.remove("slideLeftAnimation");
    currentPanel.classList.remove("slideLeftEnterAnimation");
}

editPanel.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
editPanel.addEventListener("animationend", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
tripsPanel.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
tripsPanel.addEventListener("animationend", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
ownedPanel.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
ownedPanel.addEventListener("animationend", (event) => {if(event.animationName == "translateLeft") removePrevPanel();});
