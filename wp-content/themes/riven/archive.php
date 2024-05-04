<?php

/**
 * The template for displaying archive pages
 *
 * @package riven
 */

get_header();
?>

<main>

	<?php
	if (have_posts()) :
		/* Start the Loop */
		while (have_posts()) :
			the_post();
			the_content();

		endwhile;

		the_posts_navigation();

	else :

		echo 'Posts Not Found';

	endif; ?>

</main>

<?php
get_footer();
