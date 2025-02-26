<?php 
// Template for all the cards used around the site.
if ($args) {
    $posts = $args['data'];
    $slide = $args['slide'];
    $static = $args['static'];
}

foreach($posts as $card):  
    if($slide || $static){
        $id = $card->ID;
    } else {
        //geting ID
        setup_postdata(get_post($card));
        $id = $card;
    }

    $fields = get_fields($id);
    $details = $fields['event_details'];
    $name = $details['name'];
    $locations = $details['locations'];
    $featuredImage = get_the_post_thumbnail_url( $id, 'large' );

    $event_start = $details['event_start'];
    $event_end = $details['event_end'];
    $start = DateTime::createFromFormat( 'Y-m-d H:i:s', $event_start );
    $end = DateTime::createFromFormat( 'Y-m-d H:i:s', $event_end );

    $month = $start->format( 'M' );
    $day_s = $start->format( 'd' );
    $day_e = $end->format( 'd' );
    ?> 

    <article id="post-<?php echo $id; ?>" class="card event-card <?php if($slide){echo 'swiper-slide';} else {echo 'col-12 col-lg-4';} ?>">
        <a href="<?php echo esc_url( get_permalink($id) );?>" class="card-link event-container">
            <div class="content">
                <div class="date">
                    <div class="month">
                        <?php echo $month; ?>
                    </div>
                    <div class="days">
                        <?php 
                        if($day_s == $day_e):
                            echo $day_s;
                        else:
                            echo $day_s . '-' . $day_e;
                        endif;
                        ?>
                    </div>
                </div>
                <div class="info">
                    <h3 class="title"><?php echo $name; ?></h3>
                    <?php if($locations): ?>
                        <p class="location">
                            <?php $i = 0; foreach($locations as $l):
                                if($i < 2):
                                    $location = $l['location']; 
                                    echo ($i == 1 ) ? ' / ' : '';
                                    echo '<span>'. $location['title'] . '</span>'; 
                                endif;
                                echo ($i > 2 ) ? ' /...' : '';
                                $i++;
                            endforeach; ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <img class="bg-image" src="<?php echo $featuredImage; ?>" alt="">
        </a>
    </article>

<?php endforeach; ?>