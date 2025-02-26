<?php
/**
 * The main template file
 *
 */

$category_filter = isset($_GET['category_filter']) ? sanitize_text_field($_GET['category_filter']) : '';
$cat_info = "";

if (!empty($category_filter)) {
    $args = array(
		'cat' => $category_filter,
    );
	$wp_query = new WP_Query( $args ); 

	$cat_info = get_category($category_filter);
}

if($cat_info){
	$main_title = $cat_info->name; 
}
$main_title = "test";

get_header();

?>

	<main id="primary" class="site-main">
		
		<div class="container"> 
			<?php
			if ( have_posts() ) : ?>
				<div class="search-filter news">
					<h2 class="title">Browse by Category</h2>
					<form method="get" action="" name='filtering' class="filter-form">
						<?php
						$taxonomy = 'post';
						$categories = get_categories($taxonomy); ?>
						<select name="category_filter" class="category_filter target" onchange="this.form.submit()" id="">
							<option value="0">All Categories</option>
							<?php 
								foreach ($categories as $category) {
									$selected = ($category_filter == $category->cat_ID) ? 'selected' : '';
									echo '<option value="' . $category->cat_ID . '" ' . $selected . '>' . $category->name . '</option>';
								}
							?>
						</select>
					</form>
				</div>
				
				<?php /* Start the Loop */
				while ( have_posts() ) :
					the_post();
						
					get_template_part( 'template-parts/news-card', get_post_type('posts') );

				endwhile;
				
				$total_pages = $wp_query->max_num_pages;

				if ($total_pages > 1) :
			
					$current_page = max(1, get_query_var('paged'));
					echo '<div class="pagination-navigation">';
					echo paginate_links(array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => 'page/%#%',
						'current' => $current_page,
						'total' => $total_pages,
						'prev_text'    => __('Previous Page'),
						'next_text'    => __('Next Page'),
					));
					echo '</div>';
				endif;

			else:

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>

	</main><!-- #main -->

<?php
get_footer();
