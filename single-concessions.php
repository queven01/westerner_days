<?php
/**
 * The Single Event template file
 */

$id = get_the_ID();

// $details = get_field('venue_details');
// $information = get_field('venue_information');

// $name = $details['name'];
// $description = $details['description'];
// // $banquest_capacity = $details['banquest_capacity'];
// // $theatre_capacity = $details['theatre_capacity'];
// // $size = $details['size'];
// $spaces_within = $details['spaces_within'];
// $call_to_action = $details['call_to_action'];

// $venue_capacities = $details['venue_capacities'];

// $cta_title = $call_to_action['title'];
// $cta_link = $call_to_action['link'];

// $venue_gallery = $details['venue_gallery'];

// $ideal_for = $information['ideal_for'];
// $ameneities = $information['ameneities'];
// $event_specific_amenities_title = $information['event_specific_amenities_title'];
// $event_specific_ameneities = $information['event_specific_ameneities'];
// $similar_venues = $information['similar_venues'];

get_header();
?>

    <main id="main" class="container">
        <div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
        <article id="single-venue-post" class="standard-page content-area">
            <!-- Post Details -->
            <!-- <div class="row">
                <div class="col-md-6">
                    <h2><?php echo $name; ?></h2>
                    <p><?php echo $description; ?></p>
                    <?php if($venue_capacities):?>
                        <div class="details">
                            <?php foreach($venue_capacities as $capacity):?>
                                <div class="detail">
                                    <h3><?php echo $capacity['title']?></h3>
                                    <p><?php echo $capacity['capacity']?></p>
                                </div>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>
                    <?php if($spaces_within): ?>
                        <div class="spaces-container">
                            <h3>Spaces Within</h3>
                            <div class="spaces">
                            <?php foreach($spaces_within as $spaces):?>
                                <div class="space">
                                    <a target="<?php echo $spaces['space']['target']?>" href="<?php echo $spaces['space']['url']?>"><?php echo $spaces['space']['title']?></a>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($cta_title): ?>
                        <div class="quote">
                            <h3 class="title"><?php echo $cta_title;?></h3>
                            <a href="<?php echo $cta_link['url'];?>" class="btn blue"><?php echo $cta_link['title'];?></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <?php if($venue_gallery): ?>
                    <div class="image-carousel">
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper largeCarousel">
                            <div class="swiper-wrapper">
                                <?php foreach($venue_gallery as $image):?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo $image['url']; ?>" alt="">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-button-next button-next"><img class="arrow flip" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
                            <div class="swiper-button-prev button-prev"><img class="arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
                        </div>
                        <div thumbsSlider="" class="swiper thumbCarouselSmall">
                            <div class="swiper-wrapper">
                                <?php foreach($venue_gallery as $image):?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo $image['url']; ?>" alt="">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div> -->

            <!-- Venue For -->
            <!-- <div class="venue_features">
                <div class="row">
                    <?php if($ideal_for): ?>
                    <!-- Ideal For -->
                        <div class="col-md ideal_for_container"> 
                            <h3 class="title">Ideal For</h3>
                            <ul>
                                <?php foreach($ideal_for as $idea):?>
                                    <li><?php echo $idea['idea']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if($ameneities): ?>
                    <!-- Amenities -->
                        <div class="col-md amenitiies_container"> 
                            <h3 class="title">Amenities</h3>
                            <ul>
                                <?php foreach($ameneities as $ameneity):?>
                                    <li><?php echo $ameneity['amenity']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if($event_specific_ameneities): ?>
                    <!-- Amenities Extra -->
                        <div class="col-md amenitiies_container extra"> 
                            <h3 class="title"><?php echo $event_specific_amenities_title ?></h3>
                            <ul>
                                <?php foreach($event_specific_ameneities as $ameneity):?>
                                    <li><?php echo $ameneity['amenity']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div> -->

            <?php if($similar_venues): ?>
                <!-- Similar Venues -->
                <div class="similar_venues_container"> 
                    <h2 class="title">Similar Venues</h2>
                    <div class="row">
                        <?php 
                            get_template_part('./template-parts/venue-card', null, array(
                                'data' => $similar_venues )
                            );
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            
        </article><!-- .content-area -->
	</main><!-- #main -->

<?php
get_footer();
