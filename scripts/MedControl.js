function checkmedid(){
    var med = document.getElementById("med_id").value;
    var message = document.getElementById("med_id_msg");
    if ((med.length>4 || med.length<1)) {
        message.style.color = "red";
        console.log ('red');
        message.innerHTML = "Please enter a valid Medication ID number.";
    }
    else{
        message.style.color = "green";
        console.log ('green');
        message.innerHTML = "Medication ID number is valid.";
    }
}

function checkpatientid(){
    var patient = document.getElementById("patient_id").value;
    var message = document.getElementById("patient_id_msg");
    if (!(/^[1-4]$/.test(patient)) && (patient.length>4 || patient.length<1)) {
        message.style.color = "red";
        message.innerHTML = "Please enter a valid Patient ID number.";
    }
    else{
        message.style.color = "green";
        message.innerHTML = "Patient ID number is valid.";
    }
}

document.getElementById("med_id").addEventListener("keyup", checkmedid);
document.getElementById("patient_id").addEventListener("keyup", checkpatientid);