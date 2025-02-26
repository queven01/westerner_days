<?php 
    $blocks = get_sub_field('blocks');
?>

<section class="information-blocks-row container">
    <div class="row">
        <?php 
        if($blocks):
            foreach($blocks as $block): 
                $block_title = $block['title'];
                $information = $block['information'];
                ?>
                <div class="col-12 col-md-6 row-item">
                    <div class="block">
                        <h2><?php echo $block_title; ?></h2>
                        <?php foreach($information as $info): 
                            $info_title = $info['title'];
                            $info_description = $info['description']; ?>
                            <div class="content">
                                <?php if($info_title && !$info_description): ?>
                                    <h2><?php echo $info_title; ?></h2>
                                <?php else: ?>
                                    <h3 class="title"><?php echo $info_title; ?></h3>
                                <?php endif; ?>
                                <?php if($info_description): ?><p class="description"><?php echo $info_description; ?></p><?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach;
        endif; ?>
    </div>
</section>