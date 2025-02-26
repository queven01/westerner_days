<?php 
    $pre_footer = get_field('pre_footer_call_to_action');
    $title = $pre_footer['title'];
    $description = $pre_footer['description'];
    $button = $pre_footer['button'];
    $image = $pre_footer['image'];
?>
<?php if($title):?>
    <!-- Pre Footer Section -->
    <section class="pre-footer container-xl">
        <div class="row">
            <div class="col-12 col-md-7 content-container">
                <div class="content">
                    <h3><?php echo $title; ?></h3>
                    <p><?php echo $description; ?></p>
                    <a href="<?php echo $button['url']; ?>" class="btn white"><?php echo $button['title']; ?></a>
                </div>
            </div>
            <div class="col-12 col-md-5 image-container">
                <figure><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"></figure>
            </div>
        </div>
    </section>
<?php endif;?> 