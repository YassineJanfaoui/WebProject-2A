function checkPassword() {
    let password = document.getElementById("password").value;
    let passwordError = document.getElementById("password-message");
    if (password.length < 8) {
        passwordError.innerHTML = "At least 8 characters long";
        passwordError.style.color = "red";
        return true;
    }
    passwordError.innerHTML = "";
    return false;
}

function checkConfirm() {
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirm").value;
    let confirmError = document.getElementById("confirm-message");
    if (password != confirm) {
        confirmError.innerHTML = "Passwords must match";
        confirmError.style.color = "red";
        return true;
    }
    confirmError.innerHTML = "";
    return false;
}

function checkEmail() {
    let email = document.getElementById("email").value;
    let emailError = document.getElementById("email-message");
    if (!/^[a-zA-Z0-9._-]+@gmail.com/.test(email)) {
        emailError.innerHTML = "Please enter a valid Email";
        emailError.style.color = "red";
        return true;
    }
    emailError.innerHTML = "";
    return false;
}

function checkNumber() {
    let number = document.getElementById("num").value;
    let numberError = document.getElementById("phone-message");
    if (!/^[0-9]{8}$/.test(number)) {
        numberError.innerHTML = "Number must be '8 digits'";
        numberError.style.color = "red";
        return true;
    }
    numberError.innerHTML = "";
    return false;
}

document.getElementById("password").addEventListener("keyup", checkPassword);
document.getElementById("confirm").addEventListener("keyup", checkConfirm);
document.getElementById("email").addEventListener("keyup", checkEmail);
document.getElementById("num").addEventListener("keyup", checkNumber);


document.getElementById("form").addEventListener("submit", function (event) {
    let a = checkPassword();
    let b = checkConfirm();
    let c = checkEmail();
    let d = checkNumber();
    if (a || b || c || d) {
        event.preventDefault();
    }
});