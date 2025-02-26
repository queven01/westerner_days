<?php 
    $intro_section = get_field('intro_section');
    $title = $intro_section['title'];
    $description = $intro_section['description'];
?>
<?php if($title || $description): ?>
    <section class="intro_section">
        <div class="container">
            <div class="content">
                <?php if($title){ echo '<h2 class="title">'. $title . '</h2>';}; ?>
                <?php if($description){ echo '<p>'. $description . '</p>';}; ?>
            </div>
        </div>
    </section>
<?php endif; ?>