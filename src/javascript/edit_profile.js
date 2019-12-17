"use strict";
if (document.getElementById('editProfileDiv') != null) {
    document.getElementById('editProfileDiv').addEventListener('submit', function (event) {
        let current_pw = document.getElementsByName('current_password')[0].value;
        let new_pw = document.getElementsByName('new_password')[0].value;
        let new_name = document.getElementsByName('name')[0].value;
        let new_email = document.getElementsByName('email')[0].value;
        let birthday = document.getElementsByName('birthday')[0].value;
        let nationality = document.getElementsByName('nationality')[0].value;
        let csrf = document.getElementsByName('csrf')[0].value;
        console.log(csrf);
        let request = new XMLHttpRequest();
        request.open('post', '../actions/action_edit_profile.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onload = reload_profile_info;
        request.send(encodeForAjax({ 'name': new_name, 'email': new_email, 'birthday': birthday, 'nationality': nationality, 'current_password': current_pw, 'new_password': new_pw, 'csrf': csrf}));
        event.preventDefault();
    });
}

function reload_profile_info() {
    console.log(this.responseText);
    let data = JSON.parse(this.responseText);
    let name = document.getElementById("user_info_name");
    console.log(name.value);
    let nationality = document.getElementById("user_info_nationality_age");
    name.innerHTML = data['name'];
    nationality.innerHTML = data["nationality"] + "| " + data["age"];
    

    
}
