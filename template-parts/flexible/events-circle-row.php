<?php
/**
 * Flexiable template
 */

 $title = get_sub_field('title');
 $events = get_sub_field('events');

?>

<section class="events-circle-row">
    <div class="container">
        <div class="event-circle-container">
            <h2 class="title"><?php echo $title ?></h2>
            <?php if($events): ?>
            <div class="event-circle row">
                <?php $i = 0; foreach($events as $event): 
                    $id = $event->ID; 
                    $featuredImage = get_the_post_thumbnail_url( $id, 'large' );
                    $event_title = get_the_title($id)?>
                    <div class="event-item col-12 col-md-4">
                        <a href="<?php echo esc_url( get_permalink($id) );?>">
                            <figure>
                                <img src="<?php echo $featuredImage; ?>" alt="<?php echo $event_details['portrait']['alt']?>">
                            </figure>
                            <h3 class="event-name"><?php echo $event_title; ?></h3>
                        </a>
                    </div>
                <?php $i++; endforeach;?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
