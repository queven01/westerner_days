<?php 
$logo_carousel = get_field('logo_carousel');

$carousel_title = $logo_carousel['title'];
$gray_scale = $logo_carousel['gray_scale'];
$carousel = $logo_carousel['carousel'];
?>
<?php if($carousel): ?>
<section class="carousel-row home logo-carousel">
    <div class="container">
        <?php if ($carousel_title): ?>
        <div class="container">
            <h2 class="title"><?php echo $carousel_title; ?></h2>
        </div>
        <?php endif; ?>
        <div class="image-carousel">
            <div class="swiper-button-next button-next"><img class="arrow flip" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
            <div class="swiper-button-prev button-prev"><img class="arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow.svg" alt="arrow"></div>
            <div class="swiper logoCarousel ">
                <div class="swiper-wrapper">
                    <?php foreach($carousel as $item):
                        $image = $item['image'];
                        $link_to = $item['link_to']; ?>
                        <div class="swiper-slide">
                            <?php if ($link_to){echo '<a target="_blank" href="'.$link_to.'">';}?>
                                <img <?php if($gray_scale){echo 'class="grayscale"';}?> src="<?php echo $image['url']; ?>" alt="">
                            <?php if ($link_to){echo '</a>';}?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>