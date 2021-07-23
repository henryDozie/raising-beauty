jQuery(document).ready(function($){
    $('p > video').unwrap();

if(jQuery('#home-video').length > 0){
  document.getElementById("home-video").controls = false;
}

$('#responsive-menu-container').prepend('<div class="menu-overlay"></div>');


$('#responsive-menu-button').click(function(){
    $('#responsive-menu-button').css('display', 'none');
    $('#responsive-menu-button').fadeIn();
  if($('.is-active').length <= 0){
    $('#responsive-menu-container').removeClass('show');
    var time = 100;
    $('#responsive-menu-container #responsive-menu li.responsive-menu-item').each(function(){
    var menuItem = jQuery(this);
      setTimeout(function(){
        $('#responsive-menu-container #responsive-menu li.responsive-menu-item').removeClass('animate');
      });
        time +=25;
    })
  }
  else{
    $('#responsive-menu-container').addClass('show');
  var time = 100;
  $('#responsive-menu-container #responsive-menu li.responsive-menu-item').each(function(){
      var menuItem = jQuery(this);
      setTimeout( function(){ 
      menuItem.addClass('animate');
     }, time)
    time += 25;
  })
 }
})

$('.archive-description').detach().prependTo('.content-sidebar-wrap');

$('.blog .archive-pagination, .blog-page .archive-pagination').detach().appendTo('.content-sidebar-wrap');

$('.blog-page main article').wrapAll('<div class="article-wrapper"></div>');



})


 var vheight = jQuery(window).height();
  var scrollTop  = jQuery(window).scrollTop();
  elementOffset = jQuery('.site-container').offset().top;
  distance  = (elementOffset - scrollTop);
  if(distance < 0){
    jQuery('.site-header').addClass('sticky');
    jQuery('body').addClass('sticky-page');
  }
  else{
    jQuery('.site-header').removeClass('sticky');
    jQuery('body').removeClass('sticky-page');
  }
jQuery(window).scroll(function (event) {
  var scrollTop  = jQuery(window).scrollTop();
  elementOffset = jQuery('.site-container').offset().top;
  distance  = (elementOffset - scrollTop);
  if(distance < 0){
    jQuery('.site-header').addClass('sticky');
    jQuery('body').addClass('sticky-page');
  }

  else{
    jQuery('.site-header').removeClass('sticky');
    jQuery('body').removeClass('sticky-page');
  }

})



var mySwiperColorCard = new Swiper ('.swiper-container-card', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    centeredSlides: true,
    slidesPerView: 1, 
    spaceBetween: 60,
    autoHeight: true,
    autoplay: {
      delay: 3500,
    },
     // If we need pagination
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
})

var mySwiperTestimonials = new Swiper ('.swiper-container-testimonials', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    spaceBetween: 50,
    autoplay: {
      delay: 8000,
    },
    breakpoints: {
            768: {
              slidesPerView: 2,
              spaceBetween: -3,
            },
            1366: {
              slidesPerView: 3,
              spaceBetween: -5,
            },
          },
     // If we need pagination
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
})


var mySwiperLogos = new Swiper ('.swiper-container-logos', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  spaceBetween: 50,
  autoplay: {
    delay: 1500,
  },
  breakpoints: {
          768: {
            slidesPerView: 2,
          },
          1366: {
            slidesPerView: 4,
          },
        }
})

jQuery('#learn-more-anchor').click(function(event){
event.preventDefault() 
jQuery('html, body').animate({
    scrollTop: jQuery("#learn-more").offset().top
}, 1000);
})

var latestPostlink = jQuery('.posts-feed .post:first-child a').attr('href');
jQuery('#latest-post').attr('href', latestPostlink);

jQuery('.responsive-menu-item-link').click(function(){
  jQuery(this).find('.responsive-menu-subarrow').trigger('click');
})

jQuery('.menu-item a').click(function(){
  if(jQuery('.menu-active').length <= 0){
    jQuery(this).addClass('menu-active');
    jQuery(this).find('.responsive-menu-subarrow').addClass('menu-active');
  }
  else{
    jQuery(this).removeClass('menu-active');
    jQuery(this).find('.responsive-menu-subarrow').removeClass('menu-active');
  }
})

jQuery('.service-text-right').prepend('<div class="left-bar"></div>');


if(jQuery('#side-personal-1').length > 0){
  setTimeout(function(){
    var sideImageHeight = jQuery('#side-personal-1 .service-text-right').height();
    jQuery('.logo-side-image').css('height', sideImageHeight - 10);
  }, 200)
  jQuery(window).resize(function(){
    var sideImageHeight = jQuery(' #side-personal-1 .service-text-right').height();
    jQuery('.logo-side-image').css('height', sideImageHeight - 10);  
  })
  setTimeout(function(){
    var sideColorHeight = jQuery('#side-personal-2 .service-text-right').height();
    jQuery('.side-color').css('height', sideColorHeight - 10);
    jQuery('.side-color-box').css('height', (sideColorHeight - 10) / 5);
  }, 200)
  jQuery(window).resize(function(){
    var sideColorHeight = jQuery('#side-personal-2 .service-text-right').height();
    jQuery('.side-color-box').css('height', (sideColorHeight - 10) / 5); 
  })
}
if(jQuery('#side-workplace-1').length > 0){
  setTimeout(function(){
    var sideImageHeight = jQuery('#side-workplace-1 .service-text-right').height();
    jQuery('.logo-side-image').css('height', sideImageHeight - 10);
  }, 200)

  jQuery(window).resize(function(){
    var sideImageHeight = jQuery(' #side-workplace-1 .service-text-right').height();
    jQuery('.logo-side-image').css('height', sideImageHeight - 10);  
  })

  setTimeout(function(){
    var sideColorHeight = jQuery('#side-workplace-2 .service-text-right').height();
    jQuery('.side-color').css('height', sideColorHeight - 10);
    jQuery('.side-color-box').css('height', (sideColorHeight - 10) / 5);
  }, 200)

  jQuery(window).resize(function(){
    var sideColorHeight = jQuery('#side-workplace-2 .service-text-right').height();
    jQuery('.side-color-box').css('height', (sideColorHeight - 10) / 5); 
  })
}



if(jQuery('.animate').length > 0){

  //Animate
  var vheight = jQuery(window).height();
  jQuery('.animate').each(function(){
    var scrollTop  = jQuery(window).scrollTop();
    elementOffset = jQuery(this).offset().top;
    distance  = (elementOffset - scrollTop);
    if(distance < vheight - (vheight/5)){
      jQuery(this).not('.parts-row').addClass('do-animate');
    }
  })
  jQuery(window).scroll(function (event) {
      jQuery('.animate').each(function(){
        var scrollTop  = jQuery(window).scrollTop();
        elementOffset = jQuery(this).offset().top;
        distance  = (elementOffset - scrollTop);
        if(distance < vheight - (vheight/5)){
          jQuery(this).not('.parts-row').addClass('do-animate');
        }
      })
  })


}

jQuery(document).ready(function(){
  swapImage();
})

jQuery( window ).resize(function() {
  swapImage();
});

function swapImage(){
  if(window.matchMedia('(min-width: 1101px)').matches){
    jQuery('.big-image-row img').attr('src', '/content/uploads/2021/04/Alyson-7a.jpg');
  }
  else{
    jQuery('.big-image-row img').attr('src', '/content/uploads/2021/04/Alyson-7a-mobile.jpg');
  }
}

jQuery(document).ready(function($){
$.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase()); 

if($.browser.chrome){
  $(window).on('beforeunload', function(){
     $('#home-video').css({'opacity': '0', 'transition': 'all 1s ease-out'});
  });
}
})
