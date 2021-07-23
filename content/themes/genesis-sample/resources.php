
<?php

/**
* Template Name: Resources
*/

// Add our custom loop
add_action( 'genesis_loop', 'resources_loop' );

function resources_loop() {

$resources = get_field('resources');
if($resources){
	echo '<div class="resources-list mobile-lr-padding">
			<h2>Stay connected to the latest news, talks, tips, and events from Raising Beauty.</h2>';
            while(have_rows('resources')):
              the_row();
              while(have_rows('resource_list')):
                  the_row();
			  		echo '<a target="_blank" href="'.get_sub_field('url').'">'.get_sub_field('text').'</a>';
              endwhile;
            endwhile;
	echo '</div>';
}

}

genesis();