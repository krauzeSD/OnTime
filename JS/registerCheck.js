function CheckField(field, type, numberOfChecks, secondField = ""){
    var checker = 0;
    if (field.value !== ""){
        if (type == 'name'){
            if (field.value[0] == field.value[0].toUpperCase()){
                checker++;

            }
        }
        else if (type == 'telephone'){
            if (!isNaN(field.value)){
                checker++;
            }
        }
        else if (type == 'email'){
            for (var e in field.value){
                if (field.value[e] == '@'){
                    checker++;
                }
                else if (field.value[e] == '.'){
                    checker++;
                }
            }
        }
        else if (type == 'pass'){
            if (secondField !== ""){
                if (field.value == secondField.value){
                    checker++;
                }
            }
        }
        if (checker !== numberOfChecks){
            field.style.border = '2px solid red';
            return false;
        }
        else {
            return true;
        }
    }
    else {
        field.style.border = '2px solid red';
        return false;
    }
}






var registerButton = GetByID('registerButton');

registerButton.onclick = function(){
    var checker = 0;
    var errors = [];
    var name = document.getElementsByName('Name')[0];
    var surname = document.getElementsByName('Surname')[0];
    var telephone = document.getElementsByName('Telephone')[0];
    var email = document.getElementsByName('Email')[0];
    var pass1 = document.getElementsByName('Password1')[0];
    var pass2 = document.getElementsByName('Password2')[0];
    name.style.border = '0px solid black';
    surname.style.border = '0px solid black';
    telephone.style.border = '0px solid black';
    email.style.border = '0px solid black';
    pass1.style.border = '0px solid black';
    pass2.style.border = '0px solid black';
    
    
    
    if (CheckField(name, 'name', 1)) checker++;
    if (CheckField(surname, 'name', 1)) checker++;
    if (CheckField(telephone, 'telephone', 1)) checker++;
    if (CheckField(email, 'email', 2)) checker++;
    if (CheckField(pass1, 'pass', 1, pass2)) checker++;

    
    
    
    
    var getparameters = location.search.substr(1).split("&");

    for (var index = 0; index < getparameters.length; index++) {
        var tmp = getparameters[index].split("=");
        if (tmp[1] == 'company') var isCompany = true;
    } 
    if  (isCompany){
        var companyname = document.getElementsByName('companyName')[0];
        var companyID = document.getElementsByName('companyID')[0];
        var companytelephone = document.getElementsByName('companyTelephone')[0];
        var companyemail = document.getElementsByName('companyEmail')[0];
        var companySector = document.getElementsByName('sector')[0];

        companyname.style.border = '0px solid black';
        companyID.style.border = '0px solid black';
        companytelephone.style.border = '0px solid black';
        companyemail.style.border = '0px solid black';
        companySector.style.border = '0px solid black';

        if (companyname.value !== ""){
            if (companyname.value[0] !== companyname.value[0].toUpperCase()){
                errors.push('Your Company name must start with a capital letter.');
                companyname.style.border = '2px solid red';
            }
            else {
                checker++;
            }
        }
        else{
            companyname.style.border = '2px solid red';
        }


        if (companyID.value !== ""){
            //check for social security number
            checker++;
        }
        else{
            companyID.style.border = '2px solid red';
        }


        if (companytelephone.value !== ""){
            if (isNaN(companytelephone.value)){
                companytelephone.style.border = '2px solid red';
            }
            else {
                checker++;
            }
        }
        else {
            companytelephone.style.border = '2px solid red';
        }

        if (companyemail.value !== ""){
            var checkedEmail = 0;
            for (var x in companyemail.value){
                if (companyemail.value[x] == '@'){
                    checkedEmail++;
                }
                else if (companyemail.value[x] == '.'){
                    checkedEmail++;
                }
            }
            if (checkedEmail >= 2){
                checker++;
            }
            else {
                 companyemail.style.border = '2px solid red';
            }
        }
        else {
             companyemail.style.border = '2px solid red';
        }

        if (companySector.value !== ''){
            checker++;
        }
        else{
            companySector.style.border = '2px solid red';
        }
    }
    
    if (isCompany){
       var totalcheck = 10;
    }
    else {
        var totalcheck = 5;
    }
    console.log(checker);
    console.log(totalcheck);

    if (checker == totalcheck){
        
        var forms = document.getElementsByTagName('form');
        for (var f = 0; f < forms.length; f++){
            forms[f].submit();
        }
    }
}
