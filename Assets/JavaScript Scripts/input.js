function validate(){
    b=true;
    if(!numeral(document.getElementById("id_patient").value)){
        b=false;
        alert("Invalid ID");
    }
    else if(!numeral(document.getElementById("consultation_price").value)){
        b=false;
        alert("Invalid consultation price");
    }
    else if(!numeral(document.getElementById("surgery_price").value)){
        b=false;
        alert("Invalid surgery price");
    }
    else if(!numeral(document.getElementById("total_stay_price").value)){
        b=false;
        alert("Invalid total stay price");
    }
    else if(!numeral(document.getElementById("medication_cost").value)){
        b=false;
        alert("Invalid medication cost");
    }
    
    return b;
}
function numeral(ch){
    
        if (ch.length>0) {
            for (let i = 0; i < ch.length; i++) {
                if ((ch[i].toUpperCase() < '0') || (ch[i].toUpperCase() > '9')) {
                    return false;
                    break;
                }
            }
            return true;
        } else {
            return false;
        }
    
}