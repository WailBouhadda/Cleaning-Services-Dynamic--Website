
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