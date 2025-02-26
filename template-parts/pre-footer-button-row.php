<?php 
$prefooter_buttons = get_field('prefooter_buttons');
$post_buttons = "";
if($prefooter_buttons):
    $post_buttons = $prefooter_buttons['post_buttons'];
endif;
?> 

<?php if($prefooter_buttons && $post_buttons): ?>
    <section id="call_to_action_button_row" class="row g-0">
        <?php foreach($post_buttons as $button): 
            $inner_banner = get_field('inner_banner', $button->ID);
            if($inner_banner['banner_image']){
                $bgImage = $inner_banner['banner_image']['url'];
            } else {
                $bgImage = get_the_post_thumbnail_url( $button->ID );
            } ?>
            <div class="col-12 col-md-4 cta-btn">
                <a href="<?php echo get_permalink($button->ID); ?>" class="cta-content">
                    <h3 class="title"><?php echo $button->post_title; ?></h3>
                </a>
                <img class="button-bg" src="<?php echo $bgImage; ?>" alt="">
            </div>
        <?php endforeach; ?>
    </section>
<?php endif; ?>