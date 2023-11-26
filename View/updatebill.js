function letThrough(){
    cp=document.getElementById('consultation_price').value;
    sp=document.getElementById('surgery_price').value;
    tsp=document.getElementById('total_stay_price').value;
    mc=document.getElementById('medication_cost').value;
    if(!(positiveNumber(cp)&&positiveNumber(sp)&&positiveNumber(tsp)&&positiveNumber(mc))){
        alert("Invalid input");
        return false;
    }
    return true;
    
}
function positiveNumber(x){
    return !isNaN(x)&&x>=0;
}