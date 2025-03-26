<?php
/*
    Template Name: Events Listing V2
*/

$category_filter = isset($_GET['category_filter']) ? sanitize_text_field($_GET['category_filter']) : '';

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
    // 'meta_query'     => array(
    //     array(
    //         'key'     => 'event_details_event_start',
    //         'compare' => 'EXISTS',
    //     ),
    //     array(
    //         'key'     => 'event_details_event_time', // Store start time separately (HH:MM:SS)
    //         'compare' => 'EXISTS',
    //     ),
    // ),
    // 'orderby' => array(
    //     'event_details_event_time' => 'ASC', // First, sort by time (earliest first)
    //     'event_details_event_start' => 'ASC', // Then, sort by date
    // ),


);

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

$category_chooser = get_field('category_chooser');
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

    <main id="main" class="events-listing-page v2">
        <section class="container-xl">
            <div class="search-filter events">
                <form method="get" action="" name='filtering' class="filter-form col-12 col-sm-6 col-md-3">
                    <?php
                    $taxonomy = 'event_category';
                    $categories = get_terms($taxonomy); ?>
                    <select class="filter-by-select category_filter target" data-filter-group='category'>
                        <option value="" selected>ALL</option>
                        <?php
                            foreach ($categories as $category) {
                                $selected = ($category_filter == $category->slug) ? 'selected' : '';
                                echo '<option value=".' . $category->slug . '" ' . $selected . '>' . $category->name . '</option>';
                            }
                        ?>
                    </select>
                </form>
            </div>
            <div class="tab-content">
                <?php foreach ($navigation_categories as $index => $category) : ?>
                    <div class="tab-pane <?php echo $index === 0 ? 'active' : ''; ?>" id="tab-<?php echo esc_attr($category->term_id); ?>">
                        <h2 class="title"><?php echo $category->name;?></h2>
                        <div class="grid row">
                            <?php
                            // Query Event Posts for this Navigation Category
                            $args['tax_query'] = array(
                                'relation' => 'AND',
                                    array(
                                        'taxonomy' => 'navigation_category',
                                        'field'    => 'term_id',
                                        'terms'    => $category->term_id,
                                    ),
                                    array(
                                        'taxonomy' => 'event_type',
                                        'field'    => 'term_id',
                                        'terms'    => $category_chooser,
                                    ),
                                );
                            $events_query = new WP_Query($args);
                            $sorted_events = array();

                            if ($events_query->have_posts()) {
                                while ($events_query->have_posts()) {
                                    $events_query->the_post();
                                    $event_start = get_field('event_details_event_start');
                            
                                    if ($event_start) {
                                        $timestamp = strtotime($event_start);
                                        $event_date = date('Y-m-d', $timestamp);
                                        $event_time = date('H:i:s', $timestamp); // Extract only the time
                            
                                        // Store as an object instead of an array
                                        $event_obj = (object) [
                                            'ID'    => get_the_ID(),
                                            'title' => get_the_title(),
                                            'date'  => $event_date,
                                            'time'  => $event_time,
                                        ];

                                        $sorted_events[] = $event_obj;
                                    }
                                }
                                wp_reset_postdata();
                            }
                            
                            // Sort events first by time, then by date
                            usort($sorted_events, function ($a, $b) {
                                return strcmp($a->time, $b->time) ?: strcmp($a->date, $b->date);
                            });   
                            
                            // Convert the sorted array to an object
                            $sorted_events = (object) $sorted_events;
                            
                            // $event_posts = $events_query->posts; // Get posts as an array

                            if (!empty($sorted_events)) :
                                foreach ($sorted_events as $post) :
                                    setup_postdata($post); // Set up post data for template functions
                                    get_template_part('./template-parts/content', 'event-card', array('data' => $post ) );
                                endforeach;
                                wp_reset_postdata(); // Reset after the loop
                            else :
                                echo '<p>No events found in this category.</p>';
                            endif;
                            
                            // $events_query = new WP_Query($args);

                            // $event_posts = $events_query->posts; // Get posts as an array

                            // if (!empty($event_posts)) :
                            //     foreach ($event_posts as $post) :
                            //         setup_postdata($post); // Set up post data for template functions
                            //         get_template_part('./template-parts/content', 'event-card', array('data' => $post ) );
                            //     endforeach;
                            //     wp_reset_postdata(); // Reset after the loop
                            // else :
                            //     echo '<p>No events found in this category.</p>';
                            // endif;
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="no-results" style="display: none;"><h4>Sorry, no results to show based on your search.</h4></div>
            </div>
        </section>
    </main><!-- .site-main -->
<?php
get_footer(); 