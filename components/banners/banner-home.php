<?php 
    $home_hero = get_field('home_hero');
    $button = $home_hero['button'] ?? '';
    $title = $home_hero['title'] ?? '';
    $banner_image = $home_hero['banner_image'] ?? '';
    $video = $home_hero['video'] ?? '';

    if ($title){
        $title = $home_hero['title'];
    } else {
        $title = get_the_title();
    }

    //Banner Image
    if($banner_image){
        $banner_image = $home_hero['banner_image']['url'];
    } else {
        $banner_image = get_the_post_thumbnail_url();
    }

    if($video){
        $video = $home_hero['video']['url'];
    }
?>
<section style="background-image: url('<?php echo $banner_image ?>')" class="banner home">
    <div class="content container">
        <div class="col-md-6">
            <?php if($title): ?><h1 class="title"><?php echo $title; ?></h1><?php endif; ?>
            <?php if($button): ?><a href="<?php echo $button['url']; ?>" class="btn blue"><?php echo $button['title']; ?></a><?php endif; ?>
        </div>
    </div>
    <?php ?>
    <?php if($video):?>
        <video width="320" height="240" playsinline autoplay loop muted>
            <source src="<?php echo $video; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    <?php endif; ?>
    <img class="hero-blocks" src="<?php echo get_stylesheet_directory_uri(); ?>/images/Fireworks-Graphic.svg" alt="">
</section> 
