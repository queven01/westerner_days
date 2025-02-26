<?php
/**
 * Template Name: Team Template
 */

$team_category = get_field('team_category');

$args = [
    'post_type' => 'teammembers',
    'posts_per_page' => -1, // Fetch all posts
    'tax_query' => array(
        array(
        'taxonomy' => 'team_category',
        'field' => 'term_id',
        'terms' => $team_category
         )
      )
];

$team_members = get_posts( $args );


get_header();
?>

    <main id="main" class="container">
        <section class="team-section-row standard-page content-area"> 
            <div class="team-container">
                <div class="team row" id="teamPage">
                    <?php $i = 0; foreach($team_members as $team_member): 
                        $id = $team_member->ID;
                        $team_member_details = get_field('team_member_details', $team_member->ID); 
                        $hasImage = isset($team_member_details['portrait']['url']);
                        ?>
                        <div class="team-item col-12 col-md-3">
                            <figure class="<?php if(!$hasImage){echo 'no-image';}?>">
                                <?php if($hasImage): ?>
                                    <img src="<?php echo $team_member_details['portrait']['url']?>" alt="<?php echo $team_member_details['portrait']['alt']?>">
                                <?php endif; ?>
                            </figure>
                            <h3 class="team-name"><?php print_r($team_member_details['name']);?></h3>
                            <h5 class="team-position"><?php print_r($team_member_details['position']);?></h5>
                        </div>
                    <?php $i++; endforeach;?>
                </div>
            </div>
        </section><!-- .content-area -->
	</main><!-- #main -->

<?php
get_footer();
