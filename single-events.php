<?php
/**
 * The Single Event template file
 */

$id = get_the_ID();

$details = get_field('event_details');
$information = get_field('event_information');

$name = $details['name'];
$description = $details['description'];

$event_start = $details['event_start'];
$event_end = $details['event_end'];
$more_times = $details['more_times'];

$start = DateTime::createFromFormat( 'Y-m-d H:i:s', $event_start );
$end = DateTime::createFromFormat( 'Y-m-d H:i:s', $event_end );
$locations = $details['locations'];
$custom_time = $details['custom_time'];
$custom_time_row = $details['custom_time_row'];

$more_event_details = $details['more_event_details'];

$month = $start->format( 'M' );
$day_s = $start->format( 'd' );
$day_e = $end->format( 'd' );
$year = $end->format( 'Y' );
$time_s = $start->format( 'g:i a' );
$time_e = $end->format( 'g:i a' );

$sponsors = $information['sponsors'];
$similar_events = $information['similar_events'];

$image = $details['image'];
$image_true_ratio = $details['image_true_ratios'];
$link_1 = $details['link_1'];
$link_2 = $details['link_2'];

get_header();
?>

    <main id="main" class="container">
        <div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
        <article id="single-event-post" class="standard-page content-area">
            <!-- Event Details -->
            <div class="row">
                <div class="col-md-6">
                    <h2><?php echo $name; ?></h2>
                    <h3><?php   
                        echo $month;
                        if($day_s == $day_e):
                            echo ' '. $day_s;
                        else:
                            echo ' '. $day_s . '-' . $day_e;
                        endif;
                        echo  ', ' . $year;?>
                    </h3>
                    <p><?php echo $description; ?></p>
                    <div class="details">
                        <?php if($time_s): ?>
                        <div class="detail mb-4">
                            <h3>Time</h3>
                            <?php if($custom_time): foreach($custom_time_row as $time): ?>
                                <p class="my-1"><?php echo $time['time'] ?></p>
                            <?php endforeach; else: ?>
                                <p><?php echo $time_s . ' - ' . $time_e?></p>
                                <?php if($more_times):?>
                                    <h4>More Start Times</h4>
                                    <?php foreach($more_times as $key=>$time){
                                        $time = $time['date_time'];
                                        echo '<span>'.$time.'</span> ';
                                        if($key !== count($more_times)-1){
                                            echo ' | ';
                                        }
                                    }?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php if($locations): ?>
                            <h3>Location</h3>
                            <div class="detail">
                                <p>
                                <?php foreach($locations as $l): 
                                    $location = $l['location']?>
                                    <a class="me-2" target="<?php echo $location['target']?>" href="<?php echo $location['url']?>"><?php echo $location['title']?></a>
                                <?php endforeach; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if($more_event_details['title']): ?>
                    <div class="accordion-container">
                        <div class="accordion" id="accordionEvent">
                            <div class="accordion-item">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h3 class="title"><?php echo $more_event_details['title']?></h3>
                                </button>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionEvent">
                                    <div class="accordion-body">
                                        <?php echo $more_event_details['details']?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <div class="image-side-details">
                        <?php if($image):?><img class="<?php if($image_true_ratio){echo 'true-ratio';} ?>" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"><?php endif; ?>
                        <div class="button-container mt-3">
                            <?php if($link_1):?><a class="btn blue me-3" target="<?php echo $link_1['target']; ?>" href="<?php echo $link_1['url']; ?>"><?php echo $link_1['title']; ?></a><?php endif; ?>
                            <?php if($link_2):?><a class="btn blue" target="<?php echo $link_2['target']; ?>" href="<?php echo $link_2['url']; ?>"><?php echo $link_2['title']; ?></a><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Extra Info -->
            <?php if($sponsors): ?>
                <div class="sponsor-container">
                    <h3 class="title mt-5 mb-4">Sponors</h3>
                    <div class="sponsor-logos">
                        <?php foreach($sponsors as $sponsor):?>
                            <a target="_blank" href="<?php echo $sponsor['sponsor_url']?>"><img src="<?php echo $sponsor['sponsor_logo']['url']?>" alt=""></a>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if($similar_events): ?>
                <div class="similar-events">
                    <h3 class="title mt-5 mb-4">Similar Events</h3>
                    <div class=" row">
                        
                        <?php 
                            get_template_part('./template-parts/event-card', null, array(
                                'data' => $similar_events,
                                'slide' => 0,
                                'static' => 1)
                            );
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </article><!-- .content-area -->
	</main><!-- #main -->

<?php
get_footer();
