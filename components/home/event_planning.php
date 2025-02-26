<?php 
    $event_planning = get_field('event_planning');
    $title = $event_planning['title'];
    $description = $event_planning['description'];
    $cards = $event_planning['cards'];
?>
<?php if($cards):?>
    <!-- Event Planning Section -->
    <section class="event-planning container-xl">
        <div class="content-container">
            <h2 class="title"><?php echo $title;?></h2>
            <div class="col-md-5"><?php echo $description;?></div>
        </div>
        <div class="row mt-4">
            <?php 
            $odd = true;
            foreach($cards as $card):?>
                <div class="column col-12 col-sm-6 col-lg-3">
                    <a href="<?php if($card['link']){ echo $card['link']['url']; } else { echo "#"; }?>" class="card">
                        <?php if($card['image']):?>
                            <figure class="<?php if (!$odd){echo "change-order";}?>">
                                <img src="<?php echo $card['image']['url']?>" alt="<?php echo $card['image']['alt']?>">
                            </figure>
                        <?php endif; ?>
                        <div class="content">
                            <h3 class="title"><?php echo $card['title']?></h3>
                            <p><?php echo $card['description']?></p>
                            <?php if($card['link']):?><span class="btn link"><?php echo $card['link']['title']?></span><?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php 
            $odd = !$odd;
            endforeach;?>
        </div>
    </section>
<?php endif;?>