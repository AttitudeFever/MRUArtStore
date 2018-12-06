window.addEventListener('load' , ()=>{

    document.getElementById('cancel').addEventListener('click', ()=>{

        location.href = "index.php";
    });
    
    const fName = document.querySelector('#firstName');
    const lName = document.querySelector('#lastName');
    const city = document.querySelector('#city');
    const country = document.querySelector('#country');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const verifyPass = document.querySelector('#verifyPassword');
    const signUp = document.querySelector('#signUp');
    const error = document.querySelector('#error');
    const eError = document.querySelector('#eError');
    const pError = document.querySelector('#pError');
    const fError = document.querySelector('#fError');

    password.maxLength = "6"; //sets it as max length of 6 in input field
    verifyPass.maxLength = "6"; 

    function checkREGEX(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }


    signUp.addEventListener('click', function(e){
        let blankMSG = "Fields with * can't be blank!";
        let emailFormatMSG = "Invalid Email!";
        let verifyPassMSG = "Password verification does not match!";
        let formError = "Validation Error";

        if(!(fName).value || !(lName).value || !(city).value || !(country).value || !(email).value ||  !(password).value || !(verifyPass).value){
            
            e.preventDefault();
            error.textContent = blankMSG;
            fError.textContent = formError;
            
            if(!(fName).value){
                fName.style.backgroundColor = "#EF9A9A";
            }

            if(!(lName).value ){   
                lName.style.backgroundColor = "#EF9A9A";
            }

            if(!(city).value ){   
                city.style.backgroundColor = "#EF9A9A";
            }
            
            if(!(country).value){  
                country.style.backgroundColor = "#EF9A9A";
            }
            
            if(!(email).value){
                email.style.backgroundColor = "#EF9A9A";
            }
            
            if(!(password).value){
            password.style.backgroundColor = "#EF9A9A";
            }
                
            if(!(verifyPass).value){
                verifyPass.style.backgroundColor = "#EF9A9A";
            }
        }else{
            error.textContent = "";

        }
               
        if(!checkREGEX( (email).value) ){
            e.preventDefault();
            eError.textContent = emailFormatMSG;
            email.style.backgroundColor = "#EF9A9A";
            fError.textContent = formError;
        }else{
            eError.textContent = "";
            email.style.backgroundColor = "white";
        }
           
        if(password.value != verifyPass.value){
            e.preventDefault();
            pError.textContent = verifyPassMSG;
            verifyPass.style.backgroundColor = "#EF9A9A";
            password.style.backgroundColor = "#EF9A9A";
            password.value = "";
            verifyPass.value = "";
            fError.textContent = formError;
        }else{
            pError.textContent = "";
            verifyPass.style.backgroundColor = "white";
            password.style.backgroundColor = "white";
        }
          
    });
    
});