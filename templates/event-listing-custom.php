<?php
/*
    Template Name: Events Listing Custom
*/
// Define your custom field key
$start_date_key = 'event_details_event_start';

// Set up the WP_Query arguments to fetch all posts
$args = array(
    'post_type'      => 'events',
    'meta_key'       => $start_date_key,
    'meta_type'      => 'DATETIME',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    'posts_per_page' => -1, // Fetch all posts
    'meta_query'     => array(
        'key'     => $start_date_key,
        'type'    => 'DATE',
        'compare' => 'EXISTS',
    ),
);

$category_filter = isset($_GET['category_filter']) ? sanitize_text_field($_GET['category_filter']) : '';

if (!empty($category_filter)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'event_category',
            'field' => 'slug',
            'terms' => $category_filter,
        ),
    );
}

//ACF Banner
$inner_banner = get_field('inner_banner');

$title = "";
$description = "";

$isTitle = isset($inner_banner['title']);
$isDescription = isset($inner_banner['description']);

if($isTitle){
    $title = $inner_banner['title'];
}
if($isDescription){
    $description = $inner_banner['description'];
}

?>
<?php get_header(); ?>

    <section class="inner-menu button-row inner-page-navigation-days">
        <div class="posts-inner-menu">
            <div class="bigger-container">
                <?php 
                echo '<ul id="inner-page-navigation-dates" class="tab-nav">';

                    // Fetch all terms from the 'navigation_category' taxonomy
                    $navigation_categories = get_terms(array(
                        'taxonomy' => 'navigation_category',
                        'hide_empty' => false, // Set to true if you only want categories with posts
                    ));

                    if (!empty($navigation_categories) && !is_wp_error($navigation_categories)) {
                        foreach ($navigation_categories as $index => $category) : ?>
                            <li class="<?php echo $index === 0 ? 'active' : ''; ?>">
                                <a href="#" data-tab="tab-<?php echo esc_attr($category->term_id); ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            </li>
                        <?php endforeach;
                    } else {
                        echo 'No Navigation Categories found.';
                    }

                echo '</ul>';
                ?>
            </div>
        </div>
    </section>

    <?php if($title || $description): ?>
        <section class="intro-header">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $description; ?></p>
        </section>
    <?php endif; ?>

    <main id="main" class="events-listing-page">
        <section class="container-xl">
            <div class="search-filter events">
                <h2 class="title">Add Name of Week Here</h2>
                <form method="get" action="" name='filtering' class="filter-form col-12 col-sm-6 col-md-3">
                    <?php
                    $taxonomy = 'event_category';
                    $categories = get_terms($taxonomy); ?>
                    <select name="category_filter" class="category_filter target" onchange="this.form.submit()" id="">
                        <option value="">All Categories</option>
                        <?php 
                            foreach ($categories as $category) {
                                $selected = ($category_filter == $category->slug) ? 'selected' : '';
                                echo '<option value="' . $category->slug . '" ' . $selected . '>' . $category->name . '</option>';
                            }
                        ?>
                    </select>
                </form>
            </div>
            <div class="tab-content">
                <?php foreach ($navigation_categories as $index => $category) : ?>
                    <div class="tab-pane row <?php echo $index === 0 ? 'active' : ''; ?>" id="tab-<?php echo esc_attr($category->term_id); ?>">
                        <?php
                        // Query Event Posts for this Navigation Category
                        $events_query = new WP_Query(array(
                            'post_type' => 'events',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'navigation_category',
                                    'field'    => 'term_id',
                                    'terms'    => $category->term_id,
                                ),
                            ),
                            'posts_per_page' => -1, // Show all posts
                        ));

                        $event_posts = $events_query->posts; // Get posts as an array

                        if (!empty($event_posts)) :
                            foreach ($event_posts as $post) :
                                setup_postdata($post); // Set up post data for template functions
                                get_template_part('./template-parts/content', 'event-card', array('data' => $post ) );
                            endforeach;
                            wp_reset_postdata(); // Reset after the loop
                        else :
                            echo '<p>No events found in this category.</p>';
                        endif;
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- <?php 
                echo '<ul id="event-pagination-nav">';
                    // Previous month arrow
                    echo '<li>';
                        $previous_month_key = isset($current_month_keys[$paged - 2]) ? $current_month_keys[$paged - 2] : null;
                        if ($previous_month_key) {
                            $previous_month_name = date('F', strtotime($previous_month_key));
                            $previous_month_link = get_pagenum_link($paged - 1);
                            echo "<a class=\"btn link reverse\" href='$previous_month_link'>$previous_month_name</a>";
                        }
                    echo '</li>';
                    // Next month arrow
                    echo '<li>';
                        $next_month_key = isset($current_month_keys[$paged]) ? $current_month_keys[$paged] : null;
                        if ($next_month_key) {
                            $next_month_name = date('F', strtotime($next_month_key));
                            $next_month_link = get_pagenum_link($paged + 1);
                            echo "<a class=\"btn link\" href='$next_month_link'>$next_month_name</a>";
                        }
                    echo '</li>';
                echo '</ul>';
            ?> -->
        </section>
    </main><!-- .site-main -->
<?php
get_footer(); 