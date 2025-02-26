<?php
    //For Cateogory Filter Index Page
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_components = parse_url($url);

    if($wp_query->is_posts_page || count($url_components) > 3){
        $page_for_posts = get_option( 'page_for_posts' );
        $id = $page_for_posts;
    } else {
        // $id = get_the_ID(); Wasn't working live for some reason
        $id = get_queried_object_id();
    } 

    //ACF Titles
    $inner_banner = get_field('inner_banner', $id);

    $top_title = "";
    $title = '';
    $description = "";

    $isTitle = isset($inner_banner['title']);
    $isTopTitle = isset($inner_banner['top_title']);
    $isDescription = isset($inner_banner['description']);
    $isBannerImage = isset($inner_banner['banner_image']['url']);
    
    if($isTopTitle){
        $top_title = $inner_banner['top_title'];
    }
    if($isTitle){
        $title = $inner_banner['title'];
    }
    if($isDescription){
        $description = $inner_banner['description'];
    }
    
    if($isBannerImage){
        $banner_image = $inner_banner['banner_image']['url'];
    } else {
        $banner_image = get_the_post_thumbnail_url();
    }

    //Post Title
    $post_title = get_the_title($id);

    //Top Title Overwrites
    if($top_title) {
        //Gets title from Top Title
        $main_title = $top_title;
    } elseif(isset($post->post_parent) && $post->post_parent != 0) { 
        //Gets title from Parent Name
        $main_title = get_the_title( $post->post_parent );
    } else {
        //Gets title from Wordpress
        $main_title = $post_title;
    }


    //Overwrites if header banner has any args that come from a different page. ei: 404 page
    if($args['title'] !== "" && $args['image'] !== ""){
        $main_title = $args['title'];
        $banner_image = $args['image'];
    }
?>
<section style="background-image: url('<?php echo $banner_image;?>')" class="banner inner">
    <div class="content container">
        <div class="col-md-7">
            <h1 class="title"><?php echo $main_title; ?></h1>
        </div>
    </div>
    <img class="hero-blocks" src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero-blocks-inner.svg" alt="">
</section>

<?php get_template_part("template-parts/inner-button-nav");	?>

<?php if(!is_page_template('templates/events-listing.php') && !is_page_template('templates/event-listing-custom.php') && !is_single()): ?>
    <?php if($title || $description): ?>

            <section class="intro-header">
                <h2><?php echo $title; ?></h2> 
                <p><?php echo $description; ?></p>
            </section>

    <?php endif; ?>
<?php endif; ?>