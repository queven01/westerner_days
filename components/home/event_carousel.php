<?php 
    $featured_events = get_field('featured_events');
    $title = $featured_events['title'];
    $link = $featured_events['link'];
    $events = $featured_events['events'];

    $show_latest_events = $featured_events['show_latest_events'];

    $end_date_key = 'event_details_event_end';

    $current_date = date('Y-m-d H:i:s'); // Current date and time
    
    $args = array(
        'post_type'      => 'events',
        'meta_key'       => $end_date_key,
        'meta_type'      => 'DATETIME',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'posts_per_page' => 5, // Fetch 5 Posts
        'meta_query'     => array(
            'key'     => $end_date_key,
            'type'    => 'DATETIME',
            'compare' => '>=', // Event end date should be greater than or equal to current date
            'value'   => $current_date,
        ),
    );
    
    $query = new WP_Query( $args ); 

    if($show_latest_events){
       $events = $query->posts; 
    }
?>

<?php if($events):?>
    <!-- Whats On Section -->
    <section class="events-featured container-xl">
        <div class="content-container">
            <?php if($title):?><h2 class="title"><?php echo $title; ?></h2><?php endif; ?>
            <div class="carousel-nav-container">
                <?php if($link):?><a class="btn blue" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a><?php endif; ?>
                <div class="slider-navigation">
                    <div class="swiper-button-next button-next"><img class="arrow flip" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
                    <div class="swiper-button-prev button-prev"><img class="arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
                </div>                
            </div>
        </div>
        <div class="events-container right pt-4">
            <!-- Swiper -->
            <div class="swiper events-slider">
                <div class="swiper-wrapper">
                    <?php 
                        get_template_part('./template-parts/event-card', null, array(
                            'data' => $events,
                            'slide' => 1 ,
                            'static' => 0)
                        );
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>