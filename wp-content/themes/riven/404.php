<?php
get_header(); ?>

<main>

	<section class="error-404 container">

		<figure class="error-404__image">
			<img width="464" height="172" src="<?= get_template_directory_uri() . '/dist/img/404.svg' ?>" alt="<?= str_translate('Page not found') ?>" loading="eager" decoding="async">
		</figure>

		<h2 class="error-404__title h2-t">
			<span><?= str_translate('oops') ?>...</span>
			<span><?= str_translate('Something went wrong!') ?></span>
		</h2>

		<p class="error-404__subtitle">
			<?= str_translate('the page you are looking for was moved, deleted, or perhaps never existed') ?>
		</p>

		<a class="error-404__btn btn btn2-t btn-green" href="<?= site_url('/') ?>"><?= str_translate('back to homepage') ?></a>

	</section>

</main>

<?php
get_footer();
