<?php
/**
 * Flexiable template part for displaying links and files
 */

 $link_row_title = get_sub_field('link_row_title');
 $links = get_sub_field('links');

?>

<section class="link_row">
    <div class="container">
        <h2 class="title"><?php echo $link_row_title; ?></h2>
        <div class="link_container">
            <?php foreach($links as $link): ?>             
                <?php if($link['link']): ?>
                    <a class="btn blue" target="<?php echo $link['link']['target']?>" href="<?php echo $link['link']['url']?>"><?php echo $link['link']['title']?></a>
                <?php elseif($link['file']): ?>
                    <a class="btn blue" download href="<?php echo $link['file']['url']?>"><?php echo $link['file']['title']?></a>
                <?php endif; ?>
            <?php endforeach;?>
        </div>
    </div>
</section>
