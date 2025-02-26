<?php 
 $side_buttons = get_field('side_buttons', 'option');
 $button_1 = $side_buttons['button_1'];
 $button_2 = $side_buttons['button_2'];
?>
 <?php if($button_1 || $button_2):?>
    <div class="floating-button-container">
        <?php if($button_1):?>
            <a class="btn one purple" target="<?php echo $button_1['target'];?>" href="<?php echo $button_1['url'];?>"><?php echo $button_1['title'];?></a>
        <?php endif; ?>
        <?php if($button_2):?>
            <a class="btn two pink" target="<?php echo $button_2['target'];?>" href="<?php echo $button_2['url'];?>"><?php echo $button_2['title'];?></a>
        <?php endif; ?>
    </div>
<?php endif; ?>