<?php
get_header(); ?>

<main>
	<?php
	if (have_posts()) :

		/* Start the Loop */
		while (have_posts()) :
			the_post();
			the_content();

		endwhile;

	else :

		echo 'Empty post';

	endif; ?>

</main><!-- #main -->

<?php
get_footer();
