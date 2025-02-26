<?php 
    $icons = get_sub_field('icons');
?>

<!-- Button Row -->
<section class="icon-row">
    <div class="row g-0">
        <?php $i = 0; foreach($icons as $icon): 
            $icon_title = $icon['icon_title'];
            $icon_image = $icon['icon_image']; ?>
            <div class="col-12 col-md-6 col-lg icon-container <?php if($i == 0){echo 'bg orange';}; if($i == 1){echo 'bg green';}; if($i == 2){echo 'bg blue';}; if($i == 3){echo 'bg light-green';};?>">
                <div class="icon-content">
                    <img src="<?php echo $icon_image['url'];?>" alt="">
                    <h3 class="title"><?php echo $icon_title; ?></h3>
                </div>
            </div>
        <?php $i++; endforeach; ?>
    </div>
</section>