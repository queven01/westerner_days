<?php
/**
 * Template part for displaying posts
 *
 */
$id = $post->ID;

$inner_banner = get_field('inner_banner', $id);
if($inner_banner){
	$description = $inner_banner['description'];
} else {
	$description = '';
}

$featuredImage = get_the_post_thumbnail_url( $id, 'large' );

?>

<article class="news-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php echo esc_url( get_permalink($id) );?>" class="news-link">
		<div class="row">
			<div class="col-md-4">
				<figure>
					<img src="<?php echo $featuredImage; ?>" alt="">
				</figure>
			</div>
			<div class="col-md-8">
				<div class="content">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<h3><?php echo get_the_date();?></h3>
					<p><?php if($description) {echo $description;};  ?></p>
					<span href="<?php echo esc_url( get_permalink($id) );?>">Read More</span>
				</div>
			</div>
		</div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
