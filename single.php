<?php
/**
 * The template for displaying all single posts
 *
 */

$featuredImage = get_the_post_thumbnail_url();

$id = get_the_ID();
$inner_banner = get_field('inner_banner', $id);
$description = $inner_banner['description'];
$banner_image = $inner_banner['banner_image'];

//Top Title Overwrites
if($inner_banner['title']) {
	$post_title = $inner_banner['title'];
} else {
	$post_title = get_the_title();
}


get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
			<article id="single-news-post" class="standard-page content-area">
				<div class="small-container">
					<?php
					while ( have_posts() ) : ?>
						<section class="post-header">
							<h1 class="title"><?php echo $post_title; ?></h1>
							<h3><?php echo get_the_date();?></h3>
							<figure class="featured-image">
								<img src="<?php echo $featuredImage; ?>" alt="">
							</figure>
						</section>
						<?php 
							the_post();
							the_content();

							get_template_part( 'template-parts/content', get_post_type() );

					endwhile; // End of the loop.
					?>
				</div>
			</article>
		</div>
	</main><!-- #main -->

<?php
get_footer();
