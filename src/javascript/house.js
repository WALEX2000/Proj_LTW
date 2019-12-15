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

