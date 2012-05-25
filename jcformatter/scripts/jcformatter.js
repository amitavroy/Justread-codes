jQuery(document).ready(function () {
  init();
});

function init() {

  // Init for jcarousel
  jQuery('#gallery-carousel').jcarousel({
    scroll: 1,
    visible: 1,
    wrap: 'circular',
    initCallback: jcarouselinit,
    // itemLoadCallback: eachstep, // This is where the analytics is puched
  });
}

function jcarouselinit(carousel) {
  // Binding the next button
  jQuery('#gallery-navigation .next').bind('click', function () {
    carousel.next();
    eachstep();
  });

  // Binding the previous button
  jQuery('#gallery-navigation .previous').bind('click', function () {
    carousel.prev();
    eachstep();
  });

  //to autoscroll the carousel
  // carousel.startAuto(2);

  //Stop scrolling on mouseover
  jQuery('#gallery-carousel').mouseover(function () {
    // carousel.stopAuto();
  });
  
  //Start scrolling on mouseout
  jQuery('#gallery-carousel').mouseout(function () {
    // carousel.startAuto(1);
  });
}

function eachstep() {
  var pathname = window.location.pathname;
  _gaq.push(['_trackPageview', pathname]);
  
}