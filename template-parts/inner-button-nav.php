<?php 
    //For Cateogory Filter Index Page
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_components = parse_url($url);
?>
<section class="inner-menu button-row">
    <?php
        if(is_page_template('templates/events-listing.php')):
            //Do Nothing if Event Listing Page
        elseif (is_404()) : ?>
            <div class="posts-inner-menu">
                <div class="container">
                    <a class="btn blue" href="/">Back Home</a>
                </div>
            </div>
        <?php elseif ( is_singular('venues') ) : ?>	
            <div class="posts-inner-menu">
                <div class="container">
                    <a class="btn blue" href="/venues/">Back to Venues</a>
                </div>
            </div>
        <?php elseif ( is_singular('events') ) : ?>	
            <div class="posts-inner-menu">
                <div class="container">
                    <a class="btn blue" href="/events/">Back to Events Calendar</a>
                </div>
            </div>
        <?php elseif ( is_singular('post') ) : ?>	
            <div class="posts-inner-menu">
                <div class="container">
                    <a class="btn blue" href="/news/">Back to News</a>
                </div>
            </div>
        <?php else:
            // determine parent of current page
            if ($post->post_parent) {
                $ancestors = get_post_ancestors($post->ID);
                $parent = $ancestors[count($ancestors) - 1];
            } elseif ($wp_query->is_posts_page || count($url_components) > 3) {
                $page_for_posts = get_option( 'page_for_posts' );
                $id = $page_for_posts;
                $ancestors = get_post_ancestors($id);
                $parent = $ancestors[count($ancestors) - 1];
            } else {
                $parent = $post->ID;
            }
    
            $children = wp_list_pages(array(
                'title_li'    => '',
                'child_of'    => $parent,
                'echo'        => 0,
            ));
    
            if ($children): ?>
                <div class="container">
                    <ul id="inner-page-navigation">
                        <li><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></li>
                        <?php 
                            // current child will have class 'current_page_item'
                            echo $children; 
                        ?>
                    </ul>
                </div>
            <?php endif;  
        endif; ?>
 </section>