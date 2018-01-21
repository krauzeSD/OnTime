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
        // More fields we need to check like the ID.
        else {
            checker++;
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
    //Check counter and error array.  
    var checker = 0;
    var errors = [];
    //Individual information elements.
    var name = document.getElementsByName('Name')[0];
    var surname = document.getElementsByName('Surname')[0];
    var telephone = document.getElementsByName('Telephone')[0];
    var email = document.getElementsByName('Email')[0];
    var pass1 = document.getElementsByName('Password1')[0];
    var pass2 = document.getElementsByName('Password2')[0];
    //Reset elements style
    name.style.border = '0px solid black';
    surname.style.border = '0px solid black';
    telephone.style.border = '0px solid black';
    email.style.border = '0px solid black';
    pass1.style.border = '0px solid black';
    pass2.style.border = '0px solid black';
    //Check individual information.
    if (CheckField(name, 'name', 1)) checker++;
    if (CheckField(surname, 'name', 1)) checker++;
    if (CheckField(telephone, 'telephone', 1)) checker++;
    if (CheckField(email, 'email', 2)) checker++;
    if (CheckField(pass1, 'pass', 1, pass2)) checker++;
    
    //Get parameters to check if it's a company or not.
    var getparameters = location.search.substr(1).split("&");
    for (var index = 0; index < getparameters.length; index++) {
        var tmp = getparameters[index].split("=");
        if (tmp[1] == 'company') var isCompany = true;
    } 
    //Company information
    if  (isCompany){
        //Company elements.
        var companyname = document.getElementsByName('companyName')[0];
        var companyID = document.getElementsByName('companyID')[0];
        var companytelephone = document.getElementsByName('companyTelephone')[0];
        var companyemail = document.getElementsByName('companyEmail')[0];
        var companySector = document.getElementsByName('sector')[0];
        //Reset style
        companyname.style.border = '0px solid black';
        companyID.style.border = '0px solid black';
        companytelephone.style.border = '0px solid black';
        companyemail.style.border = '0px solid black';
        companySector.style.border = '0px solid black';
        //Check information.
        if (CheckField(companyname, 'name', 1)) checker++;
        if (CheckField(companyID, 'id', 1)) checker++;
        if (CheckField(companytelephone, 'telephone', 1)) checker++;
        if (CheckField(companyemail, 'email', 2)) checker++;
        if (CheckField(companySector, 'sector', 1)) checker++;
    }
    //Set total checks to pass.
    if (isCompany){
       var totalcheck = 10;
    }
    else {
        var totalcheck = 5;
    }
    if (checker == totalcheck){
        //Submit all forms (only individual or individual and company).
        var forms = document.getElementsByTagName('form');
        for (var f = 0; f < forms.length; f++){
            forms[f].submit();
        }
    }
}
