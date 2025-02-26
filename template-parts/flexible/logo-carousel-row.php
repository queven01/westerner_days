<?php 
$carousel_title = get_sub_field('title');
$gray_scale = get_sub_field('gray_scale');
$carousel = get_sub_field('carousel');
?>
<section class="carousel-row logo-carousel">
    <div class="container">
        <?php if ($carousel_title): ?>
        <div class="container">
            <h2 class="title"><?php echo $carousel_title; ?></h2>
        </div>
        <?php endif; ?>
        <?php if($carousel): ?>
            <div class="image-carousel">
                <div class="swiper-button-next button-next"><img class="arrow flip" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
                <div class="swiper-button-prev button-prev"><img class="arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
                <div class="swiper logoCarousel ">
                    <div class="swiper-wrapper">
                        <?php foreach($carousel as $item):
                            $image = $item['image'];
                            $link_to = $item['link_to'];?>
                            <div class="swiper-slide">
                                <?php if ($link_to){echo '<a target="_blank" href="'.$link_to.'">';}?>
                                    <img <?php if($gray_scale){echo 'class="grayscale"';}?> src="<?php echo $image['url']; ?>" alt="">
                                    <?php if ($link_to){echo '</a>';}?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>