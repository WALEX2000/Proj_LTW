'use strict'

window.onclick = function (event){
    if (event.target == document.getElementById('login_modal')) {
        document.getElementById('login_modal').style.display='none';
    }

    if (event.target == document.getElementById('register_modal')) {
        document.getElementById('register_modal').style.display='none';
    }
}

let recommendedHouses = document.getElementsByClassName("RecommendedHouse");
let recIndex = 0;
let trendingHouses = document.getElementsByClassName("TrendingHouse");
let trendIndex = 0;
let newHouses = document.getElementsByClassName("NewHouse");
let newIndex = 0;

var numberOfHouses = 3;

let RecBack = document.getElementById("recommendedBack");
let RecFront = document.getElementById("recommendedFront");

let TrendBack = document.getElementById("trendingBack");
let TrendFront = document.getElementById("trendingFront");

let NewBack = document.getElementById("newBack");
let NewFront = document.getElementById("newFront");

function applyVisibility(houseList, index) {
    let validIndexes = [];
    for(let i = 0; i < numberOfHouses; i++) {
        let validIndex = index + i;
        if(validIndex >= houseList.length) validIndex = validIndex - houseList.length;
        validIndexes.push(validIndex);
    }

    for(let i = 0; i < houseList.length; i++) {
        let house = houseList[i];
        if(validIndexes.includes(i)) house.style.display = "block";
        else house.style.display = "none";
    }
}

function goBack(houseList, index) {
    index--;
    if(index < 0) index = houseList.length - 1;
    applyVisibility(houseList, index);

    return index;
}

function goFoward(houseList, index) {
    index++;
    if(index >= houseList.length) index = 0;
    applyVisibility(houseList, index);

    return index;
}

RecBack.addEventListener("click", ()=>{ recIndex = goBack(recommendedHouses, recIndex); });
RecFront.addEventListener("click", ()=>{ recIndex = goFoward(recommendedHouses, recIndex); });

TrendBack.addEventListener("click", ()=>{ trendIndex = goBack(trendingHouses, trendIndex); });
TrendFront.addEventListener("click", ()=>{ trendIndex = goFoward(trendingHouses, trendIndex); });

NewBack.addEventListener("click", ()=>{ newIndex = goBack(newHouses, newIndex); });
NewFront.addEventListener("click", ()=>{ newIndex = goFoward(newHouses, newIndex); });

window.addEventListener('resize', ()=>{ if(window.innerWidth <= 1050){
                                            numberOfHouses = 1;
                                            applyVisibility(recommendedHouses, recIndex);
                                            applyVisibility(trendingHouses, trendIndex);
                                            applyVisibility(newHouses, newIndex);
                                        }
                                        else if(window.innerWidth <= 1450) {
                                            numberOfHouses = 2;
                                            applyVisibility(recommendedHouses, recIndex);
                                            applyVisibility(trendingHouses, trendIndex);
                                            applyVisibility(newHouses, newIndex);
                                        } else {
                                            numberOfHouses = 3;
                                            applyVisibility(recommendedHouses, recIndex);
                                            applyVisibility(trendingHouses, trendIndex);
                                            applyVisibility(newHouses, newIndex);
                                        }});

if(window.innerWidth <= 1050) numberOfHouses = 1;
else if(window.innerWidth <= 1450) numberOfHouses = 2;
else numberOfHouses = 3;

applyVisibility(recommendedHouses, recIndex);
applyVisibility(trendingHouses, trendIndex);
applyVisibility(newHouses, newIndex);