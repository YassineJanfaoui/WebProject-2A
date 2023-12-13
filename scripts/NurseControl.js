function checknurseid(){
    var nurse = document.getElementById("nurse_id").value;
    var message = document.getElementById("nurse_id_msg");
    if (!(/^[1-4]$/.test(nurse)) && (nurse.length>4 || nurse.length<1)) {
        message.style.color = "red";
        message.innerHTML = "Please enter a valid Nurse ID number.";
    }
    else{
        message.style.color = "green";
        message.innerHTML = "Nurse ID number is valid.";
    }
}

function checkcareid(){
    var care = document.getElementById("care_id").value;
    var message = document.getElementById("care_id_msg");
    if (!(/^[1-4]$/.test(care)) && (care.length>4 || care.length<1)) {
        message.style.color = "red";
        message.innerHTML = "Please enter a valid Care ID number.";
    }
    else{
        message.style.color = "green";
        message.innerHTML = "Care ID number is valid.";
    }
}

document.getElementById("nurseid").addEventListener("keyup", checknurseid);
document.getElementById("care_id").addEventListener("keyup", checkcareid);