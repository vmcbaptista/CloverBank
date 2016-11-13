 var slideIndex = 0;
 var timer;

 showAuto(); //The first call of the script when the page starts

 /**
  * When a button is clicked the control variable is changed
  * @param nextSlide -> has default value of 1
  */
 function previous_slide(prevSlide){
    slideIndex = slideIndex + prevSlide;
    clearTimeout(timer);
    showSlidesUserClick();
    timer = setTimeout(showAuto, 5000); // Change image every 5 seconds

 }
 /**
  * When a button is clicked the control variable is changed
  * @param prevSlide has a default value of -1
  */
 function next_slide(nextSlide){
    slideIndex = slideIndex + nextSlide ;
    clearTimeout(timer);
    showSlidesUserClick();
     timer = setTimeout(showAuto, 5000); // Change image every 5 seconds
 }

 /**
  * Change to a slide choosed by the user
  * @param changeTo this is the postion of the slide
  */
 function currentSlide(changeTo){
     slideIndex = changeTo;
     clearTimeout(timer);
     showSlidesUserClick();
     timer = setTimeout(showAuto, 5000); // Change image every 5 seconds

 }

 /**
  * When the user click on the slide the image will change
  */
 function showSlidesUserClick() {
    var i;
    var slides = $(".slide");
     var dots = $(".dot");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }


     for (i = 0; i < dots.length; i++) {
         dots[i].style.backgroundColor = "gray";
     }


     if ( slideIndex> slides.length) {
        slideIndex = 1
    }

    if(slideIndex <= 0){
        slideIndex = slides.length;
    }

    dots[slideIndex-1].style.backgroundColor = "black";
    slides[slideIndex-1].style.display = "block";
}

 /**
  * Automatic change of the images
  */
 function showAuto() {
     var i;
     var slides = $(".slide");
     var dots = $(".dot");

     for (i = 0; i < slides.length; i++) {
         slides[i].style.display = "none";
     }

     for (i = 0; i < dots.length; i++) {
         dots[i].style.backgroundColor = "gray";
     }


     slideIndex++;
     if ( slideIndex> slides.length) {
         slideIndex = 1
     }

     dots[slideIndex-1].style.backgroundColor = "black";
     slides[slideIndex-1].style.display = "block";
     timer = setTimeout(showAuto, 5000); // Change image every 5 seconds
 }

