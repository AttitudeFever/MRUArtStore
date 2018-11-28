window.addEventListener('load' , ()=>{

    document.getElementById('cancel').addEventListener('click', ()=>{

        location.href = "index.php";
    });
    
    function verifyField()
    {
        document.querySelector("#firstName").addEventListener('change', function(){
            if(document.querySelector('#firstName').value)
            {
                //nothing should be happening to prove that a field is not empty
            }
            else{
                
            }
            
        })
            
        
    }
});