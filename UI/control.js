function validation() {
    let b = true;
    let name=document.getElementById("name").value;
    let mm = document.getElementById("expirationDateMM").value;
    let yyyy = document.getElementById("expirationDateYYYY").value;
    let cvv = document.getElementById("cvv").value;
    let ccnb =document.getElementById("cardNumber").value;
    if(!alpha(name)){
        b=false;
        alert("Invalid name");
    }
    else if(!ccn(ccnb)){
        alert("Invalid credit card number");
        b=false;
    }
    else if (!back(2, mm,1,12) || !back(4, yyyy,2023,2040) || !back(3, cvv,100,999)) {
        b = false;
        alert("Invalid card information");
    }
    return b;
}

function back(l,ch,beg,end) {
    if ((ch.length === l)&&(parseInt(ch)<=end)&&(parseInt(ch)>=beg)) {
        for (let i = 0; i < l; i++) {
            if ((ch[i] < '0') || (ch[i] > '9')) {
                return false;
            }
        }
        return true; 
    } else {
        return false;
    }
}
function alpha(ch) {
    if (ch.length>1) {
        for (let i = 0; i < ch.length; i++) {
            if ((ch[i].toUpperCase() < 'A') || (ch[i].toUpperCase() > 'Z')) {
                return false;
                break;
            }
        }
        return true;
    } else {
        return false;
    }
}
function ccn(ch) {
    if (ch.length === 16) {
        for (let i = 0; i < 16; i++) {
            if ((ch[i] < '0') || (ch[i] > '9')) {
                return false;
                break;
            }
        }
        return true;
    } else {
        return false;
    }
}
