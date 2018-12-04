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
const errorE = document.querySelector('#eError');

password.maxLength = "6"; //sets it as max length of 6 in input field
verifyPass.maxLength = "6"; 

function checkREGEX(email) {
    var eFormat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ ;
    return eFormat.test(email);
}

signUp.addEventListener('click', function(e){
      if(!(fName).value || !(lName).value || !(city).value || !(country).value)
      {
            e.preventDefault();
           
           var blank = "One or more of your fields is blank";
           
            if(!(fName).value)
            {   
               error.innerHTML = ""; 
                error.innerHTML = blank;
                fName.style.backgroundColor = "#EF9A9A";
                
            }
            
            if(!(lName).value)
            {
                error.innerHTML = ""; 
                error.innerHTML = blank;
                lName.style.backgroundColor = "#EF9A9A";
            }
            
            if(!(city).value)
            {
                error.innerHTML = ""; 
                error.innerHTML = blank;
                city.style.backgroundColor = "#EF9A9A";
            }
            
            if(!(country).value)
            {
                error.innerHTML = ""; 
                error.innerHTML = blank;
                country.style.backgroundColor = "#EF9A9A";
            }
            
            if(!checkREGEX((email).value))
            {
                 errorE.innerHTML = "";
                 errorE.innerHTML = "Invalid Email";
            }
            
           if(!(email).value)
           {
               error.innerHTML = "";
               error.innerHTML = blank;
           }
            if(password.value != verifyPass.value)
            {
                alert("Error passwords do not match, please try again.");
                password.value = "";
                verifyPass.value = "";
            }
      }
      
    });
    

    

  
    
});