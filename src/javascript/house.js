let backButton = document.getElementById("houseBack");
let frontButton = document.getElementById("houseFront");

let houseImages = document.getElementsByClassName("houseImage");

let nHouses = houseImages.length;
let pos = 0;
let animating = false;

function goBack() {
    if(pos <= 0) return;

    pos--;
    animating = true;
    //add animation to all houses

    updateHousePositions();
}

function goFoward() {
    if(pos >= nHouses - 1) return;

    pos++;
    animating = true;
    //add animation to all houses

    updateHousePositions();
}

function updateHousePositions() {
    for(let i = 0; i < nHouses; i++) {
        let house = houseImages[i];
        house.style.right = (pos*100 + '%');
    }
}

backButton.addEventListener("click", goBack);
frontButton.addEventListener("click", goFoward);

let reservationCheckIn = document.getElementById("checkInRes");
let reservationCheckOut = document.getElementById("checkOutRes");
let totalPriceRes = document.getElementById("totalPriceRes");
let ppn = parseFloat(document.getElementById("ppn").value);

function date_diff_indays(date1, date2) {
    dt1 = new Date(date1);
    dt2 = new Date(date2);
    return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
}

function updateTotal() {
    if(reservationCheckIn.value == "" || reservationCheckOut.value == "") return;
    let days = date_diff_indays(reservationCheckIn.value, reservationCheckOut.value);
    totalPriceRes.innerText = days*ppn + "€";
    console.log(days*ppn);
}

reservationCheckIn.addEventListener("change", updateTotal);
reservationCheckOut.addEventListener("change", updateTotal);