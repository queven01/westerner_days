<?php
/**
 * Flexiable template part for displaying content with images
 */

    $editor = get_sub_field('editor_content');

    $image = get_sub_field('image_column');
    $image2 = get_sub_field('image_column_2');
    $image3 = get_sub_field('image_column_3');
    $image4 = get_sub_field('image_column_4');

    $carousel = get_sub_field('carousel');
    $carousel_images = get_sub_field('carousel_images');

    $button = get_sub_field('button');

    $number_of_images = get_sub_field('number_of_images');
    $flip_content = get_sub_field('flip_content');
?> 

<section class="content-w-image <?php if($flip_content){ echo 'flip_content'; } ?>">
    <div class="container">
        <div class="row">
            <div class="content-side col-md-5 <?php echo $number_of_images; ?> <?php if($flip_content){ echo 'order-2'; } ?>">
                <?php echo $editor; ?>
                <?php if($button):?>
                    <a class="btn" href="<?php echo $button['url']?>"><?php echo $button['title']?></a>
                <?php endif; ?>
            </div>  
            <div class="image-side col-md-6 <?php echo $number_of_images; if($flip_content){ echo ' order-1'; }; if($carousel) { echo ' carousel'; }?>">
                <?php if($carousel):?>
                    <div class="image-carousel">
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper largeCarousel">
                            <div class="swiper-wrapper">
                                <?php foreach($carousel_images as $image):?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo $image['url']; ?>" alt="">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-button-prev button-prev"><img class="arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
                            <div class="swiper-button-next button-next"><img class="arrow flip" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>                     
                        </div>
                        <div thumbsSlider="" class="swiper thumbCarouselSmall">
                            <div class="swiper-wrapper">
                                <?php foreach($carousel_images as $image):?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo $image['url']; ?>" alt="">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if($image):?><img class="image one" src="<?php echo $image; ?>" alt=""><?php endif; ?>
                    <?php if($image2):?><img class="image two" src="<?php echo $image2; ?>" alt=""><?php endif; ?>
                    <?php if($image3):?><img class="image three" src="<?php echo $image3; ?>" alt=""><?php endif; ?>
                    <?php if($image4):?><img class="image four" src="<?php echo $image4; ?>" alt=""><?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
