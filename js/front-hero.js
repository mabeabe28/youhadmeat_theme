var slideIndex = 0;
var slides = $(".js-slider");
var slideTitles = $(".js-slide-title");
var slideExcerptDiv = $('.js-slide-excerpt');


showSlides(slideIndex)

function plusSlides(n) {
  slideIndex += n;
  showSlides(slideIndex,'forward');
}
function minusSlides(n) {
  slideIndex += n;
  showSlides(slideIndex,'backward');
}

function showSlides(n,direction) {
    if (typeof direction === 'undefined') direction = 'forward';
    //console.log(direction);

      var i;
      if (n >= slides.length){
        slideIndex = 0;
      }

      if (n < 0){
        slideIndex = slides.length-1;
      }

  if(direction == 'backward'){
    var previous = slideIndex+1;

     if (previous > slides.length-1){
        previous = 0;
      }

      if (previous < 0){
        previous = slides.length-1;
      }
    //console.log('current',slideIndex);
    //console.log('previous',previous);

  }else{
   var previous = slideIndex-1;

    if (previous > slides.length){
        previous = 0;
      }

      if (previous < 0){
        previous = slides.length-1;
      }

  }


      //console.log('current',slideIndex);
      //console.log('previous',previous);
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        slideTitles[i].style.display = "none";
        slideExcerptDiv[i].style.display = "none";


        $(slides[i]).removeClass('slide-in');
        $(slides[i]).removeClass('slide-back');
        $(slides[i]).removeClass('scale');
        $(slides[i]).removeClass('scale-back');


        $(slideTitles[slideIndex]).removeClass('textslide');
        $(slideTitles[slideIndex]).removeClass('textslide-out');
        $(slideTitles[slideIndex]).removeClass('textslide-side');
        $(slideTitles[slideIndex]).removeClass('textslide-side-out');

        $(slideExcerptDiv[slideIndex]).removeClass('textslide-side-opposite');
        $(slideExcerptDiv[slideIndex]).removeClass('textslide-side-out-opposite');


      }

  /*bring previous post behind*/
  slides[previous].style["z-index"] = "-1";
  slideExcerptDiv[previous].style["z-index"] = "-1";

  if(direction == 'backward'){
   $(slides[previous]).addClass('scale-back');
  }else{
    $(slides[previous]).addClass('scale');
  }
  $(slideTitles[previous]).addClass('textslide-side-out');
  $(slideExcerptDiv[previous]).addClass('textslide-side-out-opposite');


  slides[previous].style.display = "block";
  slideTitles[previous].style.display = "block";
  slideExcerptDiv[previous].style.display = "block";


  /*bring current post forward*/
  slides[slideIndex].style["z-index"] = "1";
  slideExcerptDiv[slideIndex].style["z-index"] = "100";

  if(direction == 'backward'){
   $(slides[slideIndex]).addClass('slide-back');
  }else{
   $(slides[slideIndex]).addClass('slide-in');
  }
  $(slideTitles[slideIndex]).addClass('textslide-side');
  $(slideExcerptDiv[slideIndex]).addClass('textslide-side-opposite');


  slides[slideIndex].style.display = "block";
  slideTitles[slideIndex].style.display = "block";
  slideExcerptDiv[slideIndex].style.display = "block";


}

autoSlide();
function autoSlide() {
  //console.log(direction);

    var i;
    if (slideIndex >= slides.length){
      slideIndex = 0;
    }

    if (slideIndex < 0){
      slideIndex = slides.length-1;
    }


 var previous = slideIndex-1;

  if (previous > slides.length){
      previous = 0;
    }

    if (previous < 0){
      previous = slides.length-1;
    }


    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
      slideTitles[i].style.display = "none";
      slideExcerptDiv[i].style.display = "none";

      $(slides[i]).removeClass('slide-in');
      $(slides[i]).removeClass('slide-back');
      $(slides[i]).removeClass('scale');
      $(slides[i]).removeClass('scale-back');

      $(slideTitles[slideIndex]).removeClass('textslide-side');
      $(slideTitles[slideIndex]).removeClass('textslide-side-out');

      $(slideExcerptDiv[slideIndex]).removeClass('textslide-side-opposite');
      $(slideExcerptDiv[slideIndex]).removeClass('textslide-side-out-opposite');

    }

/*bring previous post behind*/
slides[previous].style["z-index"] = "-1";
slideExcerptDiv[previous].style["z-index"] = "-1";


$(slides[previous]).addClass('scale');
$(slideTitles[previous]).addClass('textslide-side-out');
$(slideExcerptDiv[previous]).addClass('textslide-side-out-opposite');


slides[previous].style.display = "block";
slideTitles[previous].style.display = "block";
slideExcerptDiv[previous].style.display = "block";


/*bring current post forward*/
 slides[slideIndex].style["z-index"] = "1";
 slideExcerptDiv[slideIndex].style["z-index"] = "1";

 $(slides[slideIndex]).addClass('slide-in');
 $(slideTitles[slideIndex]).addClass('textslide-side');
 $(slideExcerptDiv[slideIndex]).addClass('textslide-side-opposite');

slides[slideIndex].style.display = "block";
slideTitles[slideIndex].style.display = "block";
slideExcerptDiv[slideIndex].style.display = "block";


      slideIndex++;
      setTimeout(autoSlide,7000);
}
