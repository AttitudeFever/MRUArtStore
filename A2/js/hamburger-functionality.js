window.addEventListener('load' , ()=>{


    document.getElementById('hamburger').addEventListener('click', ()=>{

        if (document.querySelector('.show') !== null) {

            document.getElementById("navigation_mobile").classList.remove('show');

            document.getElementById("hamburger").src="icons/menu_cancel.png";

            document.querySelector('#navigation_mobile ul').style = "height:230px";
                    
            var list =  document.querySelectorAll('#navigation_mobile ul li');
            for (let i=1; i<6; i++){
                list[i].style = "display:block"
            }
        }else{
            document.getElementById("navigation_mobile").classList.add('show');
            document.getElementById("hamburger").src="icons/hamburger_white.png";
            document.querySelector('#navigation_mobile ul').style = "height:60px";
            var list =  document.querySelectorAll('#navigation_mobile ul li');
 
        }

        
    });

});
