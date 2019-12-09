window.onclick = function (event){
    if (event.target == document.getElementById('login_modal')) {
        document.getElementById('login_modal').style.display='none';
    }

    if (event.target == document.getElementById('register_modal')) {
        document.getElementById('register_modal').style.display='none';
    }
}