<?php
/*
    Template Name: Events Listing V2
*/

// Category Filters
$category_filter = isset($_GET['category_filter']) ? sanitize_text_field($_GET['category_filter']) : '';

//Navigation Section Logic
$category_chooser = get_field('category_chooser');
$navigation_start = get_field('navigation_start');
$navigation_end = get_field('navigation_end');

if ($navigation_start) {
    $navigation_start = date('Y-m-d', strtotime($navigation_start));
}
if ($navigation_end) {
    $navigation_end = date('Y-m-d', strtotime($navigation_end));
}

$dates_list = [];

$current_date = strtotime($navigation_start);
$end_date = strtotime($navigation_end);

while ($current_date <= $end_date) {
    $formatted_date = date('Y-m-d', $current_date);
    $dates_list[$formatted_date] = []; // Initialize empty array for events
    $current_date = strtotime('+1 day', $current_date); // Move to next day
}

// Query Events
$args = array(
    'post_type'      => 'events',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => 'event_details_event_start',
            'compare' => 'EXISTS',
        ),
    ),
    'tax_query' => array(
        'relation' => 'AND',
            array(
                'taxonomy' => 'event_type',
                'field'    => 'term_id',
                'terms'    => $category_chooser,
            ),
    ),
);

$events_query = new WP_Query($args);

// Group Events by Date
if ($events_query->have_posts()) {
    while ($events_query->have_posts()) {
        $events_query->the_post();
        $event_id = get_the_ID();
        $event_title = get_the_title();

        // Primary Event Start Time
        $event_start = get_field('event_details_event_start'); // Main DateTime field

        if ($event_start) {
            $event_date = date('Y-m-d', strtotime($event_start)); // Extract only the date

            // Check if event falls in the range and group it
            if (array_key_exists($event_date, $dates_list)) {
                $dates_list[$event_date][] = (object) [
                    'ID'    => get_the_ID(),
                    'title' => get_the_title(),
                    'time'  => date('g:i a', strtotime($event_start)), // Extract time
                    'is_extra_time' => false,
                ];
            }
        }
        // Additional Event Times (Repeater Field or Flexible Content)
        $more_times = get_field('event_details')['more_times']; // Assuming this is an ACF repeater
        if ($more_times) {
            foreach ($more_times as $extra_time) {
                $extra_datetime = isset($extra_time['date_time']) ? $extra_time['date_time'] : null;
                if ($extra_datetime) {
                    $extra_date = date('Y-m-d', strtotime($extra_datetime)); // Extract date
                    // If extra event date is within range, add it to that date's events
                    if (array_key_exists($extra_date, $dates_list)) {
                        $dates_list[$extra_date][] = (object) [
                            'ID'    => $event_id,
                            'title' => $event_title,
                            'time'  => date('g:i a', strtotime($extra_datetime)), // Extract time
                            'is_extra_time' => true, // Extra time flag
                        ];
                    }
                }
            }
        }
    }

    // Sort events by time within each date
    foreach ($dates_list as $date => &$events) {
        usort($events, function ($a, $b) {
            return strtotime($a->time) - strtotime($b->time);
        });
    }
    unset($events); // Break reference to avoid side effects
    
    wp_reset_postdata();
}


//ACF Banner Logic
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
                <ul id="inner-page-navigation-dates" class="tab-nav">
                    <?php $first_tab = true; ?>
                    <?php foreach (array_keys($dates_list) as $index => $date) : ?>
                        <li class="<?php echo $first_tab ? 'active' : ''; ?>">
                            <a href="#" data-tab="tab-<?php echo esc_attr($index); ?>">
                                <?php echo date('l, F j', strtotime($date)); ?>
                            </a>
                        </li>
                        <?php $first_tab = false;?>
                    <?php endforeach; ?>
                </ul>
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
                <?php $first_tab = true; ?>
                <?php $i = 0; foreach ($dates_list as $date => $events) : ?>
                    <div class="tab-pane <?php echo $first_tab ? 'active' : ''; ?>" id="tab-<?php echo esc_attr($i); ?>">
                        <h2 class="title"><?php echo date('l, F j', strtotime($date)); ?></h2>
                        <div class="grid row">
                            <?php if($events):?>
                                <?php foreach ($events as $event) : ?>
                                    <?php
                                        get_template_part('./template-parts/content', 'event-card', ['data' => $event]); 
                                    ?> 
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div>No events on this day.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $first_tab = false; $i++;?>
                <?php endforeach; ?>
            </div>
        </section>
    </main><!-- .site-main -->
<?php
get_footer(); 