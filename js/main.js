(function ($){
   "use strict";
   
    $(document).ready(function(){

      $(".home-slider").owlCarousel({
        items: 1,
        nav: false,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        mouseDrag: true,
        touchDrag: true,
        autoplay: true,
      });

      $(".quotation-slider").owlCarousel({
        items: 1,
        nav: false,
        mouseDrag: true,
        touchDrag: true,
        autoplay: true,
      });

      $(".installations-slider").owlCarousel({
        items: 1,
        nav: false,
        mouseDrag: true,
        touchDrag: true,
        autoplay: true,
      });

      $(".services-slider").owlCarousel({
        items: 1,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        mouseDrag: true,
        touchDrag: true,
        autoplay: true,
      });

      $(".home-slider").on("translate.owl.carousel", function(){
        $(".singel-slide h2").removeClass("animated fadeInDown").css("opacity", ".2");
        $(".singel-slide p").removeClass("animated fadeInUp").css("opacity", ".2");
        $(".singel-slide .slider-btn").removeClass("animated fadeInUp").css("opacity", ".2");
      });

      $(".home-slider").on("translated.owl.carousel", function(){
        $(".singel-slide h2").addClass("animated fadeInDown").css("opacity", "1");
        $(".singel-slide p").addClass("animated fadeInUp").css("opacity", "1");
        $(".singel-slide .slider-btn").addClass("animated fadeInUp").css("opacity", "1");
      });

      $('.team-carousel').owlCarousel({
        loop: true,
        nav: false,
        center: false,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 3
          },
          1000: {
            items: 4
          }
        }
      })


      $("ul#navigation").slicknav({
            prependTo : ".responsive-menu-warp"
        });











/*
eventStart holds final date
GMT-0800 = Pacific Standard Time
GMT-0700 = Mountain Standard Time (Arizona)
GMT-0600 = Central Standard Time
GMT-0500 = Eastern Standard Time
plus 1 for Daylight Savings
*/
var eventStart = new Date(Date.parse('01/01/2018 12:00 am'));
/* 
timeToEvent = function name
eventStart = countdown date 
timeRemaining = countdown date minus current date OR deadline minus today
seconds, minutes, hours, days = timeRemaining converted to time
*/
function timeToEvent(eventStart) {
  var timeRemaining = Date.parse(eventStart) - Date.parse(new Date());
  var days = Math.floor(timeRemaining/(1000*60*60*24));
  var hours = Math.floor((timeRemaining/(1000*60*60))%24);
  var minutes = Math.floor((timeRemaining/ 1000/60)%60);
  var seconds = Math.floor((timeRemaining/1000)%60);
  return {
    'totalTime': timeRemaining,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}
/* 
beginCountdown = function name
id = id in CSS
eventStart = countdown date 
counter = div with id that will hold countdown clock
daysElement, hoursElement, minutesElement, secondsElement = html elements that will hold parts of the countdown based on querySelector
*/
function beginCountdown(id, eventStart) {
  var counter = document.getElementById(id);
  var daysElement = counter.querySelector('.days');
  var hoursElement = counter.querySelector('.hours');
  var minutesElement = counter.querySelector('.minutes');
  var secondsElement = counter.querySelector('.seconds');

  function updateCountdown() {
    var timeRemaining = timeToEvent(eventStart);
    //slice = limits number of digits to two so you don't get 023 hours...
    daysElement.innerHTML = timeRemaining.days;
    hoursElement.innerHTML = ('0' + timeRemaining.hours).slice(-2);
    minutesElement.innerHTML = ('0' + timeRemaining.minutes).slice(-2);
    secondsElement.innerHTML = ('0' + timeRemaining.seconds).slice(-2);
    //stops countdown at less than or zero
    if (timeRemaining.totalTime <= 0) {
      //clearInterval(timeinterval);
      document.getElementById("countdownElement").innerHTML = "#SteubieLoneStar";
      document.getElementById("countdownElement").style.fontSize = "2em";
      document.getElementById("countdownElement").style.padding = "2rem 0rem";
    }
  }
  updateCountdown();
  var timeinterval = setInterval(updateCountdown, 1000); //1000 = 1sec
}
beginCountdown('countdownElement', eventStart);

















    });
    
    jQuery(window).load(function (){
      var url = window.location.href;            
      var page = url.split("/")[3];
      if(page.indexOf("doctor") > -1){page = "doctor";}
      switch(page){
        case "choose" : case "installations" : case "doctors" : case "doctor" :
        jQuery("#menu_aboutus").addClass("active");
        break;
        case "service" :
        jQuery("#menu_service").addClass("active");
        break;
        default :
        jQuery("#menu_home").addClass("active");
        break;
      }
    });

}(jQuery));
