function validateForm() {
    'use strict';

    // Get references to the form elements:
    var email = document.getElementById('email');
    var password = document.getElementById('password');

    // Validate the login
    if ((email.value.length > 0) && (password.value.length > 0)) {
        return true;
    } else {
        alert('Please complete the form!');
        return false;
    }
}

function check(form) {

    var emailArray = ("myemail@live.com", "");
    var passwordArray = ("MyLogIn", "");

    if (email.value == "email" && password.value == "password") {
        window.open('myaccount.html');
    } else {
        alert('Please enter correct username or password!');
        return false;
    }   
}

function init() {
    'use strict';

    // Confirm that document.getElementById() can be used:
    if (document && document.getElementById) {
        var loginForm = document.getElementById('lgform');
        loginForm.onsubmit = validateForm;
    }
}
window.onload = init;
window.location = "/index.html"

