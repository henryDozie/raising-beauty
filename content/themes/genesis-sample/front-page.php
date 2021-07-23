<?php

/**
 * Genesis Sample
 *
 * This file adds the front page to the Genesis Sample Theme.

 */


// Add front-page body class.
add_filter('body_class', 'genesis_body_class');


// Define front-page body class.
function genesis_body_class($classes)
{

  $classes[] = 'front-page';

  return $classes;
}

function render_front()
{


  $hero = get_field('hero');


  if ($hero) {
    echo '<div class="' . $hero['class_name'] . '">
                <div class="wrap mobile-lr-padding">
                  <div class="hero-left">
                  <div class="hero-headings-wrapper">
                    <h1 class="hero-heading lato align-element mb-25">' . $hero['heading'] . '
                    </h1>
                  </div>
                  <p class="big-p align-element mb-50 fw-500">' . $hero['blurb'] . '</p>
                  <div class="link-wrapper mb-20">
                    <a class="button primary-button mb-20" href="/contact">Contact Me</a>
                    <a id="learn-more-anchor" class="link-style" href="#learn-more">Learn More</a>
                  </div>
                  </div>
                  <div class="hero-right">
                   ' .
      $hero['video'] . '
                  </div>
                </div>
              </div>';
  }

  $cta_cards = get_field('cta_cards');

  if ($cta_cards) {
    echo '<div id="learn-more" class="' . $cta_cards['class_name'] . '">
                 <div class="wrap mobile-lr-padding">
                    <div class="supheading-wrapper">
                      <p class="supheading text-center biggest-p mb-6">' . $cta_cards['supheading'] . '</p>
                      <h2 class="big-h2 text-center pink-text">' . $cta_cards['heading'] . '</h2>
                      <p class="text-center mb-75">' . $cta_cards['text'] . '</p>
                    </div>
                  <div class="cta-card-wrapper">';
    $c = 0;
    while (have_rows('cta_cards')) :
      the_row();
      while (have_rows('cards')) :
        the_row();
        echo '<div class="cta-card mb-40">
                                    <div class="card-inner">
                                      <div class="card-inner-wrapper card-front">';
                                      if($c == 2 || $c == 3){
                                        echo '<a target="_blank" href="' . get_sub_field('link') . '"></a>';                                     
                                      } else{
                                        echo '<a href="' . get_sub_field('link') . '"></a>';
                                      }
                                        echo '<img class="mb-20" src="' . get_sub_field('image') . '" />
                                        <h3 class="text-center mb-16 pink">' . get_sub_field('heading') . '</h3>
                                        <p class="mb-25">' . get_sub_field('text') . '</p>';
                                        if($c == 2 || $c == 3){
                                          echo '<a target="_blank" class="button primary-button" href="' . get_sub_field('link') . '">Learn More</a>';                                     
                                        } else {
                                          echo '<a class="button primary-button" href="' . get_sub_field('link') . '">Learn More</a>';
                                        }
                                      echo '</div>
                                      <div style="background-image:url(' . get_sub_field('back_image') . '" class="card-inner-wrapper card-back">';
                                      if($c == 2 || $c == 3){
                                        echo '<a target="_blank" class="button primary-button" href="' . get_sub_field('link') . '">Learn More</a>';                                   
                                      } else{
                                        echo '<a class="button primary-button" href="' . get_sub_field('link') . '">Learn More</a>';
                                      }
                                      echo '</div>
                                    </div>
                                  </div>';
                                  $c++;
      endwhile;
    endwhile;
    echo '</div>
                  <div class="subtext-wrapper">
                    <p class="subtext text-center mb-16">' . $cta_cards['long_text'] . '</p>
                    <p class="subbold text-center mb-0">' . $cta_cards['subbold'] . '</p>
                  </div>                  
                 </div>
                </div>';
  }


  $social = get_field('social');


  if ($social) {
    echo '<div class="' . $social['class_name'] . '">
                <div class="wrap mobile-lr-padding">
                  <div class="swiper-container-logos">
                    <div class="swiper-wrapper">';
                      $c = 0;
                      while (have_rows('social')) :
                        the_row();
                        while (have_rows('social_media')) :
                          the_row();
                          echo '<div class="swiper-slide"><a target="_blank" href="'.get_sub_field('link').'"><img id="slide'.$c.'" src="' . get_sub_field('image') . '" /></a></div>';
                          $c++;
                        endwhile;
                      endwhile;
              echo   '</div>
                  </div>
              </div>
              </div>';
  }

  $about = get_field('about');


  if ($about) {
    echo '<div class="' . $about['class_name'] . '">
                <div class="wrap mobile-lr-padding">
                  <div class="left align-element">
                    <img class="mb-25" src="' . $about['image'] . '" />
                  </div>
                  <div class="right">
                    <p class="mb-10 align-element supheading pink">' . $about['supheading'] . '</p>
                    <h2 class="mb-25 align-element">' . $about['heading'] . '</h2>
                    <p class="mb-50 align-element">' . $about['text'] . '</p>                    
                    <a class="button primary-button" href="' . $about['button_link'] . '">' . $about['button_text'] . '</a>
                  </div>
                </div>
              </div>';
  }


  $cta_image = get_field('cta_image');


  if ($cta_image) {
    echo '<div style="background-image:url('.$cta_image['image'].')" class="' . $cta_image['class_name'] . '">
                <div class="wrap mobile-lr-padding">
                  <h2>' . $cta_image['heading'] . '</h2>
                  <a class="button primary-button contact-button" href="' . $cta_image['button_link'] . '">' . $cta_image['button_text'] . '</a>
                </div>
              </div>';
  }


  $testimonials = get_field('testimonials');


  if ($testimonials) {
    echo '<div class="' . $testimonials['class_name'] . '">
                <div class="wrap mobile-lr-padding">
                  <h2 class="mb-16 pink">' . $testimonials['heading'] . '</h2>
                  <p class="mb-50">' . $testimonials['text'] . '</p>
                  <div class="home-testimonials">';  
                   echo do_shortcode('[testimonials]'); 
    echo          '</div>
                </div>
              </div>';
  }

  $true_cta = get_field('true_cta');


  if ($true_cta) {
    echo '<div class="' . $true_cta['class_name'] . '">
                <div class="wrap mobile-lr-padding">
                  <div class="left mb-0">
                    <p class="supheading mb-10 pink">' . $true_cta['supheading'] . '</p>'
                  .$true_cta['heading'] .'
                  </div>
                  <div class="right">'.
                    $true_cta['text'].'
                  </div>
                </div>
              </div>';
  }

  $big_image = get_field('big_image');


  if ($big_image) {
    echo '<div class="' . $big_image['class_name'] . '">
                <div class="wrap mobile-lr-padding">
                  <img src="' . $big_image['image'] . '" />
                </div>
              </div>';
  }

  $cta = get_field('cta');


  if ($cta) {
    echo '<div class="' . $cta['class_name'] . '">
                <div class="wrap mobile-lr-padding">
                  <h2>' . $cta['heading'] . '</h2>
                  <a class="button primary-button contact-button" href="' . $cta['button_link'] . '">' . $cta['button_text'] . '</a>
                </div>
              </div>';
  }
}
add_action('genesis_loop', 'render_front');

// Run the Genesis loop.
genesis();
