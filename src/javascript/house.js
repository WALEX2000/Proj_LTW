let backButton = document.getElementById("houseBack");
let frontButton = document.getElementById("houseFront");

let houseImages = document.getElementsByClassName("houseImage");

let nHouses = houseImages.length;
let pos = 0;
let animating = false;
let moving = false;

function greyOutButton() {
    if(pos == 0) {
        backButton.style.color = "#75757588";
    } 
    else {
        backButton.style.color = "#789BD0FF";
    }
    if(pos == nHouses - 1) {
        frontButton.style.color = "#75757588";
    }
    else {
        frontButton.style.color = "#789BD0FF";
    }
}

greyOutButton();

function goBack() {
    if(pos <= 0 || moving) return;

    pos--;
    animating = true;
    //add animation to all houses
    for(let i = 0; i < nHouses; i++) {
        let house = houseImages[i];
        void house.offsetWidth;
        house.classList.add("slideRightAnimation");
    }
    greyOutButton();
    moving = true;
}

function goFoward() {
    if(pos >= nHouses - 1 || moving) return;

    pos++;
    animating = true;
    //add animation to all houses
    for(let i = 0; i < nHouses; i++) {
        let house = houseImages[i];
        void house.offsetWidth;
        house.classList.add("slideLeftAnimation");
    }
    greyOutButton();
    moving = true;
}

function updateHousePositions() {
    for(let i = 0; i < nHouses; i++) {
        let house = houseImages[i];
        void house.offsetWidth;
        house.classList.remove("slideLeftAnimation");
        house.classList.remove("slideRightAnimation");
        house.style.right = (pos*100 + '%');
    }
    moving = false;
}

backButton.addEventListener("click", goBack);
frontButton.addEventListener("click", goFoward);

for(let i = 0; i < nHouses; i++) {
    let house = houseImages[i];
    house.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateLeft") updateHousePositions();});
    house.addEventListener("animationend", (event) => {if(event.animationName == "translateLeft") updateHousePositions();});
    house.addEventListener("webkitAnimationEnd", (event) => {if(event.animationName == "translateRight") updateHousePositions();});
    house.addEventListener("animationend", (event) => {if(event.animationName == "translateRight") updateHousePositions();});
}

let reservationCheckIn = document.getElementById("checkInRes");
let reservationCheckOut = document.getElementById("checkOutRes");
let totalPriceRes = document.getElementById("totalPriceRes");
let ppn = 0;
let ppnElement = document.getElementById("ppn");
if(ppnElement != null) ppn = parseFloat(ppnElement.value);

function date_diff_indays(date1, date2) {
    dt1 = new Date(date1);
    dt2 = new Date(date2);
    return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
}

function updateTotal() {
    if(reservationCheckIn.value == "" || reservationCheckOut.value == "") return;
    let days = date_diff_indays(reservationCheckIn.value, reservationCheckOut.value);
    if(days > 0) totalPriceRes.innerText = days*ppn + "€";
    else totalPriceRes.innerText = "Invalid Dates!";
}

if(reservationCheckIn != null) reservationCheckIn.addEventListener("change", updateTotal);
if(reservationCheckOut != null) reservationCheckOut.addEventListener("change", updateTotal);