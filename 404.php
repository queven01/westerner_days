<?php
/**
 * The template for displaying 404 pages (not found)
 */

$image = get_stylesheet_directory_uri() . "/images/Westerner-Park-Default.jpg";

get_header( '', array( 'name' => '404 Page not found', 'image' => $image ) ); ?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<div class="container my-5">
				<h2>We can't seem to find the page you're looking for.</h2>
				<p>
					Please check the URL and try again.
				</p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
