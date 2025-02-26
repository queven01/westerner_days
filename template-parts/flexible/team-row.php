<?php 
    $title = get_sub_field('title');
    $team_members = get_sub_field('team_members');
?>

<section class="team-section-row container-xl">
    <h2 class="title"><?php echo $title;?></h2>
    <div class="team-container">
        <div class="team row" id="">
            <?php $i = 0; foreach($team_members as $team_member): 
                $id = $team_member->ID;
                $team_member_details = get_field('team_member_details', $team_member->ID); ?>
                <div class="team-item col-12 col-md-3">
                    <figure>
                        <img src="<?php echo $team_member_details['portrait']['url']?>" alt="<?php echo $team_member_details['portrait']['alt']?>">
                    </figure>
                    <h3 class="team-name"><?php print_r($team_member_details['name']);?></h3>
                    <h5 class="team-position"><?php print_r($team_member_details['position']);?></h5>
                </div>
            <?php $i++; endforeach;?>
        </div>
    </div>
</section>