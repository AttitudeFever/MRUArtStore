//hover over heart filled or empty 
window.addEventListener('load', ()=>{
               
              var quryHeart = document.querySelector('#heart a img');
              var quryHeart_result = quryHeart.getAttribute('src');
              
              if (quryHeart_result.includes("fav.png")){
                    quryHeart.addEventListener('mouseenter', ()=>{
                        quryHeart.setAttribute('src', 'icons/heart_filled.png');
                    });
                    quryHeart.addEventListener('mouseleave', ()=>{
                        quryHeart.setAttribute('src', 'icons/fav.png');
                    }); 
              }else if(quryHeart_result.includes("heart_filled.png")){
                    quryHeart.addEventListener('mouseenter', ()=>{
                        quryHeart.setAttribute('src', 'icons/fav.png');
                    });
                    quryHeart.addEventListener('mouseleave', ()=>{
                        quryHeart.setAttribute('src', 'icons/heart_filled.png');
                    }); 
              }
});