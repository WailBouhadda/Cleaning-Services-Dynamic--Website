
/*Start --- Change navigation Bar on scroll --- */


window.addEventListener("scroll", function (){
	
    let navbar = document.querySelector(".navbar");

    let scroll = window.scrollY;
    
    
    if(scroll >0){
        
        navbar.style ="position: fixed;top: 0;";
        
        
    }else{
        
        navbar.style ="position:relative;";
    }
    
    })
    
    /*End --- Change navigation Bar on scroll --- */


    /* Start show login password  */

	function showPassword(name){
        var password = document.getElementById(name);
        var show = document.getElementById("eyeShow"+name);
        var hide = document.getElementById("eyeHide"+name);
        show.style.color = "red";


            if(password.type === 'password'){
                password.type = "text"
                show.style.display = "block";
                hide.style.display = "none";
            }
            else{
                password.type = "password"
                show.style.display = "none";
                hide.style.display = "block";
            }
    }
    

        /* end show login password  */