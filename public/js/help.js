/**
 * Created by fcl on 27-11-2016.
 */
 var button = $('.container-faq h3');

 for(var i = 0; i <button.length; i++){
     button[i].onclick = function(){
         $(this).toggleClass("active");
         $(this.nextElementSibling).toggleClass("show");
     }
 }