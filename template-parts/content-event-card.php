<?php 
// Template for all the cards used around the site.
if ($args) {
    $posts = $args['data'];
}

$fields = get_fields($post->ID);
$details = $fields['event_details'];
$name = $details['name'] ?? '';
$locations = $details['locations'] ?? '';
$featuredImage = get_the_post_thumbnail_url( $id, 'large' ) ?? '';;

$event_start = $details['event_start'] ?? '';
$event_end = $details['event_end'] ?? '';
$start = DateTime::createFromFormat( 'Y-m-d H:i:s', $event_start );
$end = DateTime::createFromFormat( 'Y-m-d H:i:s', $event_end );

$day = $start->format( 'D' );
$hour_s = $start->format( 'g:i a' );
$hour_e = $end->format( 'g:i a' );

$event_categories = get_the_terms($id, 'event_category');
?> 
<article id="post-<?php echo $id; ?>" class="card event-card col-12 col-lg-4 <?php if($event_categories){ foreach($event_categories as $event_cat) { echo $event_cat->slug . ' ';}} ?>">
    <a href="<?php echo esc_url( get_permalink($id) );?>" class="card-link event-container">
        <div class="content">
            <div class="date">
                <div class="days">
                    <?php 
                        echo $hour_s
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