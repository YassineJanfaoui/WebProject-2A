
function validateEquipmentForm() {
    var eqName = document.getElementById("eq_name").value;
    var eqQuantity = document.getElementById("eq_quantity").value;
    var eqPurchasePrice = document.getElementById("eq_purchase_price").value;
    var eqPurchaseHistory = document.getElementById("eq_purchase_history").value;


    if (!isValidAlphabetic(eqName)) {
        alert("Please enter a valid alphabetic name.");
        return false;
    }

    if (!isValidNumericAndPositive(eqQuantity)) {
        alert("Please enter a valid numeric and positive quantity.");
        return false;
    }

    if (!isValidNumericAndPositive(eqPurchasePrice)) {
        alert("Please enter a valid numeric and positive purchase price.");
        return false;
    }

    if (!isValidDate(eqPurchaseHistory)) {
        alert("Please enter a valid date in the format YYYY-MM-DD.");
        return false;
    }

    return true;
}

function isValidAlphabetic(input) {
    return /^[a-zA-Z]+$/.test(input);
}

function isValidNumericAndPositive(input) {
    return input>0 && !isNaN(input);
}
function isValidDate(input) {
    var date = new Date(input);
    var isValid = !isNaN(date) && date.getFullYear() >= 2020 && date.getFullYear() <= 2023;
    return isValid;
}


