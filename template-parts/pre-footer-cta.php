<?php 
$call_to_action_title = get_field('call_to_action_title');
$call_to_action_description = get_field('call_to_action_description');
$call_to_action_link = get_field('call_to_action_link');
?>
<?php if($call_to_action_title): ?>
    <div id="call_to_action_content_row">
        <div class="content">
            <h2><?php echo $call_to_action_title; ?></h2>
            <p><?php echo $call_to_action_description; ?></p>
            <?php if($call_to_action_link):?><a class="btn blue" href="<?php echo $call_to_action_link['url']?>"><?php echo $call_to_action_link['title']?></a><?php endif; ?>
        </div>
    </div>
<?php endif; ?>