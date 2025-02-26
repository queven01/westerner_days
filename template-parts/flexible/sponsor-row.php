<?php
/**
 * Flexiable template part
 */

 $sponsor_section_title = get_sub_field('sponsor_section_title');

 $sponsors_group_1 = get_sub_field('sponsors_1');
 if($sponsors_group_1){
    $title_1 = $sponsors_group_1['title'];
    $sponsors_1 = $sponsors_group_1['sponsors'];
 }


 $sponsors_group_2 = get_sub_field('sponsors_2');
 if(!empty($sponsors_group_2)){ 
    $title_2 = $sponsors_group_2['title'];
    $sponsors_2 = $sponsors_group_2['sponsors'];
 }
 
?>

<section class="sponsor-row">
    <div class="container">
        <h2><?php echo $sponsor_section_title; ?></h2>
        <?php if(!empty($sponsors_group_1)): ?>
            <div class="sponsor-container">
                <h3 class="title mt-5 mb-4"><?php echo $title_1;?></h3>
                <div class="sponsor-logos">
                    <?php foreach($sponsors_1 as $s):?>
                        <a target="_blank" href="<?php echo $s['sponsor_url']?>"><img src="<?php echo $s['image']?>" alt=""></a>
                    <?php endforeach;?>
                </div> 
            </div>
        <?php endif; ?>
        <?php if(!empty($sponsors_group_2)): ?>
            <div class="sponsor-container">
                <h3 class="title mt-5 mb-4"><?php echo $title_2;?></h3>
                <div class="sponsor-logos">
                    <?php foreach($sponsors_2 as $s):?>
                        <a target="_blank" href="<?php echo $s['sponsor_url']?>"><img src="<?php echo $s['image']?>" alt=""></a>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section> 
