<?php
/**
 * Template Name: Facility Map Template
 */

$locations = get_field('locations');
$venue = get_field('venue');

$address_section = get_field('address_section');
$address_title = $address_section['title'];
$address = $address_section['address'];
$link = $address_section['link'];
$image = $address_section['image'];
get_header(); ?>

    <main id="main" class="container">
        <section class="standard-page content-area">
            <?php if($title):?>
                <h2><?php echo $title; ?></h2>
            <?php endif;?>
            <section class="facility-map-section">
                    <div class="search-filter facility">
                        <div class="filter-form">
                            <select id="location_select" name="" >
                                <?php $i = 1; foreach($locations as $location): 
                                    $location_name = $location['location_name']; ?>
                                    <option class="nav-link" value="tab_<?php echo $i; ?>"><?php echo $location_name; ?></option>
                                <?php $i++; endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="tab-content">
                        <?php $i = 1; foreach($locations as $location): 
                            $map_image = $location['map_image'];
                            $venue = $location['venue']; 
                            $boxPosition = $location['box_position'];

                            $id = $venue[0]->ID;
                            $title = $venue[0]->post_title;
                            $fields = get_fields($id);
                            $venue_details = $fields['venue_details'];

                            $venue_capacities = $venue_details['venue_capacities'];
                            
                            ?>
                            <div class="tab-pane" id="tab_<?php echo $i; ?>">
                                <div class="tab-information <?php echo $boxPosition ?>">
                                    <div class="content">
                                        <h3 class="title"><?php echo $title; ?></h3>
                                        <?php if ($venue_capacities): ?>
                                            <?php $cap_num = 0; foreach($venue_capacities as $capacity): if($cap_num < 2):?>
                                                <h4 class="sub-title"><?php echo $capacity['title']?></h4>
                                                <span><?php echo $capacity['capacity']?></span>
                                            <?php endif; $cap_num++; endforeach;?>
                                        <?php endif; ?>
                                    </div>
                                    <a class="btn blue" href="<?php echo esc_url( get_permalink($id) );?>">Learn More</a>
                                </div>
                                <div class="tab-image">
                                    <img src="<?php echo $map_image['url']?>" alt="">
                                </div>
                            </div>                       
                        <?php $i++; endforeach; ?>
                    </div>
            </section>

            <?php if ($address_title): ?>
                <section class="address_section">
                    <div class="row">
                        <div class="content-side col-12 col-md-6">
                            <h2><?php echo $address_title; ?></h2>
                            <h3><?php echo $address; ?></h3>
                            <?php if ($link): ?><a target="<?php echo $link['target']?>" class="btn blue" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a><?php endif; ?>
                        </div>
                        <div class="image-side col-12 col-md-6">
                            <img src="<?php echo $image['url'] ?>" alt="">
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </section><!-- .content-area -->
	</main><!-- #main -->

<?php
get_footer();