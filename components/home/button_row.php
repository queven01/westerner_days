<?php 
    $call_to_action = get_field('call_to_action');

    $button_1 = $call_to_action['button_1'];
    $button_2 = $call_to_action['button_2'];
    $button_3 = $call_to_action['button_3'];
?>

<!-- Button Row -->
<?php if($button_1 || $button_2 || $button_3):?>
    <section class="button-row home">
        <div class="row">
            <?php if($button_1):?><a target="<?php echo $button_1['target']?>" class="btn col-md-4 bg orange" href="<?php echo $button_1['url']?>"> <?php echo $button_1['title']?></a><?php endif; ?>
            <?php if($button_2):?><a target="<?php echo $button_2['target']?>" class="btn col-md-4 bg light-green" href="<?php echo $button_2['url']?>"> <?php echo $button_2['title']?></a><?php endif; ?>
            <?php if($button_3):?><a target="<?php echo $button_3['target']?>" class="btn col-md-4 bg dark-green" href="<?php echo $button_3['url']?>"> <?php echo $button_3['title']?></a><?php endif; ?>
        </div>
    </section>
<?php endif; ?>