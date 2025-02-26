<!-- Countdown Timer -->
<?php 
    $content = get_field('content');
?>
<section id="countdown-timer-section" class="">
    <?php if ($event_date = get_field('count_down_date')) : ?>
        <div class="countdown-timer" data-date="<?php echo esc_attr($event_date); ?>">
            <span class="months">00</span> Months
            <span class="weeks">00</span> Weeks
            <span class="days">00</span> Days
            <span class="hours">00</span> Hours
            <!-- <span class="minutes">00</span> Minutes
            <span class="seconds">00</span> Seconds -->
        </div>
    <?php endif; ?>
    <?php if($content): echo '<div class="content">'.$content.'</div>'; endif;?>
</section>

