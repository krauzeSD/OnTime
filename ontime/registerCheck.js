var registerButton = GetByID('registerButton');
        registerButton.onclick = function(){
            var errors = [];
            var name = document.getElementsByName('Name')[0];
            var surname = document.getElementsByName('Surname')[0];
            var telephone = document.getElementsByName('telephone')[0];
            var email = document.getElementsByName('email')[0];
            var pass1 = document.getElementsByName('password1')[0];
            var pass2 = document.getElementsByName('password2')[0];
            name.style.border = '0px solid black';
            surname.style.border = '0px solid black';
            telephone.style.border = '0px solid black';
            email.style.border = '0px solid black';
            pass1.style.border = '0px solid black';
            pass2.style.border = '0px solid black';
            
            
            if (name.value !== ""){
                if (name.value[0] !== name.value[0].toUpperCase()){
                    errors.push('Your name must start with a capital letter.');
                    name.style.border = '2px solid red';
                }
            }
            else {
                name.style.border = '2px solid red';
            }
            if (surname.value !== ""){
                if (surname.value[0] !== surname.value[0].toUpperCase()){
                    errors.push('Your surname must start with a capital letter.');
                    surname.style.border = '2px solid red';
                }
            }
            else {
                surname.style.border = '2px solid red';
            }
            if (telephone.value !== ""){
                if (isNaN(telephone.value)){
                    telephone.style.border = '2px solid red';
                }
            }
            else {
                 telephone.style.border = '2px solid red';
            }
            if (email.value !== ""){
                for (var x in email.value){
                    if (email.value[x] == '@'){
                        var checkedEmail = true;
                    }
                }
                if (checkedEmail){
                    
                }
                else {
                     email.style.border = '2px solid red';
                }
            }
            else {
                 email.style.border = '2px solid red';
            }
            if (pass1.value !== "" && pass2.value !== ""){
                if (pass1.value !== pass2.value){
                    errors.push('Passwords are not equal.');
                    pass1.style.border = '2px solid red';
                    pass2.style.border = '2px solid red';
                }
             
            }
            else {
                pass1.style.border = '2px solid red';
                pass2.style.border = '2px solid red';
            }
            
            
        }