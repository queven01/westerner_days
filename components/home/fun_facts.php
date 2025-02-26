<?php 
    $fun_facts = get_field('fun_facts');
    $title = $fun_facts['title'];
    $description = $fun_facts['description'];
    $facts = $fun_facts['facts'];
?>
<?php if($title):?>
    <!-- Stats Section -->
    <section class="stats home container-xl">
        <h2 class="title"><?php echo $title;?></h2>
        <p class="description"><?php echo $description;?></p>
        <div class="row">
            <div class="column col-sm-12 col-md-6 col-lg-5 d-flex flex-column justify-content-between gap-3">
            <?php 
            $i = 0;
            foreach($facts as $fact):
                if($i <= 2):?>
                    <div class="stat bg <?php if($i == 0){echo 'green';} if($i == 1){echo 'light-green flip';} if($i == 2){echo 'orange';}?>">
                        <figure><img src="<?php echo $fact['icon']['url'];?>" alt="<?php echo $fact['icon']['alt'];?>"></figure>
                        <div class="content">
                            <p><?php if($fact['title']) {echo $fact['title'] . "<br>";}?><span><?php echo $fact['larger_title'];?></span><br><?php echo $fact['title_2'];?></p>
                        </div>
                    </div>
                <?php endif; $i++; endforeach;?>
            </div>
            <div class="column col-sm-12 col-md">
                <?php 
                $i = 0;
                foreach($facts as $fact):
                    if($i == 3):?>
                        <div class="stat big bg blue">
                            <figure><img src="<?php echo $fact['icon']['url'];?>" alt="<?php echo $fact['icon']['alt'];?>"></figure>
                            <div class="content">
                                <p><?php if($fact['title']) {echo $fact['title'] . "<br>";}?><span><?php echo $fact['larger_title'];?></span><br><?php echo $fact['title_2'];?></p>
                            </div>
                        </div>
                <?php endif; $i++; endforeach;?>
            </div>
            <div class="column col-sm-12 col-md block-column">
                <figure class="blocks">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/blocks.png" alt="<?php echo get_bloginfo('name'); ?>">
                </figure>
            </div>
        </div>
    </section>
<?php endif; ?>