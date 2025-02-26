<?php 
    $card_selector = get_sub_field('card_selector');
    $display_category = get_sub_field('display_category');
    $title = get_sub_field('title');
    $description = get_sub_field('description');

    // Query Event Posts for this Navigation Category
    $card_query = new WP_Query(array(
        'post_type' => 'concessions',
        'tax_query' => array(
            array(
                'taxonomy' => 'concession_category',
                'field'    => 'term_id',
                'terms'    => $display_category,
            ),
        ),
        'posts_per_page' => -1, // Show all posts
    ));

    $card_posts = $card_query->posts; // Get posts as an array

    if($card_posts){
        $cards_to_display = $card_posts;
    } else {
        $cards_to_display = $card_selector;
    }
    ?>

<section class="card-row container">
    <?php if($title):?>
        <div class="intro-content">
            <h2><?php echo $title;?></h2>
            <p><?php echo $description;?></p>
        </div>
    <?php endif;?>
    <div class="row">
        <?php 
        if($cards_to_display):
            foreach($cards_to_display as $card): 
                $id = $card->ID;
                $image = get_the_post_thumbnail( $id, 'medium' );
                $url = get_permalink( $id );
                $excerpt = get_the_excerpt( $id );
                ?>
                <div class="col-12 col-md-6 col-lg-3 row-item">
                    <a href="<?php echo $url; ?>" class="card">
                        <?php echo $image; ?>
                        <div class="content">
                            <h3 class="title"><?php echo $card->post_title; ?></h3>
                            <p><?php echo $excerpt; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach;
        endif; ?>
    </div>
</section>