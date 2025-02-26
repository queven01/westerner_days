<?php 
$carousel_title = get_sub_field('carousel_title');
$carousel_images = get_sub_field('carousel_images');
$image_display = get_sub_field('image_display');
$carousel_height = get_sub_field('carousel_height');

$imageCover = "";
$style = "";

if($image_display){
    $imageCover = 'imageCover';
    $style = 'style="height:' . $carousel_height . 'px;"';
}  

?>
<section class="carousel-row">
    <?php if ($carousel_title): ?>
    <div class="container">
        <h2 class="title"><?php echo $carousel_title; ?></h2>
    </div>
    <?php endif; ?>
    <?php if($carousel_images):?>
        <div class="image-carousel">
            <div class="swiper imageCarousel <?php echo $imageCover?>" <?php echo $style; ?>>
                <div class="swiper-wrapper">
                    <?php foreach($carousel_images as $image):?>
                        <div class="swiper-slide">
                            <img src="<?php echo $image['url']; ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next button-next"><img class="arrow flip" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
                <div class="swiper-button-prev button-prev"><img class="arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
            </div>
        </div>
    <?php endif; ?>
</section>