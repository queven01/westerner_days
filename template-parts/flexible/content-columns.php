<?php
/**
 * Flexiable template part for displaying content in column
 */

 $top_title = get_sub_field('top_title');
 $sub_title = get_sub_field('sub_title');
 $editor = get_sub_field('editor');
 $editor2 = get_sub_field('editor_2');

 $single_column = get_sub_field('single_column');
 $add_background = get_sub_field('add_background'); 
 $title_style = get_sub_field('title_style');
 $off_set_right_column = get_sub_field('off_set_right_column'); 

 $button = get_sub_field('button');
?>

<section class="content-column <?php if($add_background){echo 'add_bg'; }?>">
    <div class="container">
        <div class="title-container">
            <?php if($top_title):?>
                <h2 class="top-title"><?php echo $top_title; ?></h2>
            <?php endif; ?>
            <?php if($sub_title):?>
                <h3 class="sub-title"><?php echo $sub_title; ?></h3>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="content-side <?php if($single_column){echo 'col-md-12'; } else { echo 'col-md-6'; }?>">
                <?php if($single_column){echo '<div class="single-column">';}?>
                    <?php echo $editor; ?>
                    <?php if($button):?>
                        <a class="btn" href="<?php echo $button['url']?>"><?php echo $button['title']?></a>
                    <?php endif; ?>
                <?php if($single_column){echo '</div>';}?>
            </div>  
            <?php if(!$single_column):?>
                <div class="content-side col-md-6 <?php if($off_set_right_column){echo 'two'; }?>">
                    <?php echo $editor2; ?>
                </div>  
            <?php endif; ?>
        </div>
    </div>
</section>
