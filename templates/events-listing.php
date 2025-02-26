<?php
/*
    Template Name: Events Listing
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

$query = new WP_Query( $args ); 

function generate_all_month_keys() {
    $all_month_keys = array();
    $current_month = date('Y-m');

    for ($i = 0; $i < 12; $i++) {
        $all_month_keys[] = $current_month;
        $current_month = date('Y-m', strtotime($current_month . ' + 1 month'));
    }

    return $all_month_keys;
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
<?php if($query->have_posts()): 

        $posts_by_month = array();

        while ($query->have_posts()) {
            $query->the_post();

            // Get the start date for the current post
            $event_date_start = get_post_meta(get_the_ID(), $start_date_key, true);

            // Organize posts by month using an associative array
            $month_key = date('Y-m', strtotime($event_date_start));
            $posts_by_month[$month_key][] = get_the_ID();
        }

        // Generate an array of all months
        $current_month_keys = generate_all_month_keys();

        // Output the posts for the current page based on month
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $current_month_key = isset($current_month_keys[$paged - 1]) ? $current_month_keys[$paged - 1] : null;
        $current_page_posts = isset($posts_by_month[$current_month_key]) ? $posts_by_month[$current_month_key] : array();

        // Check if it's the first page, and if so, set it to the current month
        if ($paged == 1) {
            $current_month_key = date('Y-m');
            $current_page_posts = isset($posts_by_month[$current_month_key]) ? $posts_by_month[$current_month_key] : array();
        }

endif; ?>
<?php 
    get_header(); 
    get_template_part('./template-parts/inner-button-dates', null, array(
        'data'  => $current_month_keys,
        'data2' => $current_month_key,
        'paged' => $paged ) 
    ); ?>

    <?php if($title || $description): ?>
        <section class="intro-header">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $description; ?></p>
        </section>
    <?php endif; ?>

    <main id="main" class="events-listing-page">
        <section class="container-xl">
            <div class="search-filter events">
                <h2 class="title"><?php echo $this_month = date('F', strtotime($current_month_key))?></h2>
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
            <div class="row">
                <?php if($query->have_posts()):  //Event Cards to be Displayed
                        if($current_page_posts):
                            get_template_part('./template-parts/event-card', null, array(
                                'data' => $current_page_posts,
                                'slide' => 0,
                                'static' => 0 ) 
                            );
                        else: ?>
                            <div class="col-12">
                                <div class="no-events">
                                    <h2>There are currently no events scheduled in <?php echo $this_month = date('F', strtotime($current_month_key));?>.</h2><br>
                                </div>
                            </div>
                    <?php endif; //Event Cards to be Displayed - END ?>
                <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <div class="no-events">
                        <h2>No Events</h2>
                    </div>
                <?php endif; ?>
            </div>
            <?php 
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
            ?>
        </section>
    </main><!-- .site-main -->
<?php
get_footer(); 