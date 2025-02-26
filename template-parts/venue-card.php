<?php 
// Template for all the cards used around the site.
if ($args) {
    $posts = $args['data'];
}

foreach($posts as $card):   
    $id = $card->ID;
    $fields = get_fields($id);
    $venue_details = $fields['venue_details'];

    $featuredImage = get_the_post_thumbnail_url( $id, 'large' );

    $venue_capacities = $venue_details['venue_capacities'];

    if($venue_details['name']){
        $name = $venue_details['name'];
    } else {
        $name = get_the_title($id);
    }
    ?> 
    <article id="post-<?php echo $id; ?>" class="card venue-card col-12 col-md-6 col-lg-4">
        <a href="<?php echo esc_url( get_permalink($id) );?>" class="card-link venue-container" style="background-image:url(<?php echo $featuredImage; ?>)">
            <div class="overlay-content">
                <h2 class="title"><?php echo $name; ?></h2>
                <?php if ($venue_capacities): $i = 0; ?>
                <ul>
                    <?php foreach($venue_capacities as $capacity): if($i < 2):?>
                        <div class="detail">
                            <li><?php echo $capacity['title']?> - <?php echo $capacity['capacity']?></li>
                        </div>
                    <?php endif; $i++; endforeach;?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="content">
                <h3 class="title"><?php echo $name; ?></h3>
                <span class="button">Learn More</span>
            </div>
        </a>
    </article>

<?php endforeach; ?>