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

signUp.addEventListener('click', function(e){
      if(!(fName).value || !(lName).value || !(city).value || !(country).value)
      {
            e.preventDefault();
            if(!(fName).value)
            {
                fName.value = "This is to test";
            }
            
            if(!(lName).value)
            {
                lName.value = "This is to test";
            }
            
            if(!(city).value)
            {
                city.value = "This is to test";
            }
            
            if(!(country).value)
            {
                country.value = "This is to test"; 
            }
      }
      else
      {
          //redirect to php page that confirms it was a success, haven't decided what to do after yet. 
      }
    })
    

    

  
    
});