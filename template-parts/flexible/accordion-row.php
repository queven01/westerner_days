<?php
$accordions = get_sub_field('accordion');
?>
<section class="accordion_row">
<div class="accordion-container container">
    <div class="accordion" id="accordionPage">
        <?php $i = 0; foreach($accordions as $accordion):
            $nested_accordion = $accordion['nested_accordion'];
            $column_in_accordion = $accordion['column_in_accordion'];
            $second_accordions = $accordion['second_accordion'];
            $columns = $accordion['columns'];
            $column_in_accordion = $accordion['column_in_accordion'];
            
            ?>
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                    <h3 class="title"><?php echo $accordion['item_title']?></h3>
                </button>
                <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $i; ?>" data-bs-parent="#accordionPage">
                    <div class="accordion-body">
                        <?php if($accordion['item_description']):?>
                        <!-- Regular Description -->
                        <p><?php echo $accordion['item_description']?></p>
                        <?php endif;?>
                        <?php if($nested_accordion):?>
                            <!-- Accordion Nested -- START -->
                            <div class="accordion" id="nestedAccordion">
                            <?php $y = 0; foreach($second_accordions as $second_accordion):
                                    $title_2 = $second_accordion['title'];
                                    $description_2 = $second_accordion['description'];
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?php echo $y; ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#nestedcollapse<?php echo $y; ?>" aria-expanded="true" aria-controls="nestedcollapse<?php echo $y; ?>">
                                            <h4 class="title"><?php echo $title_2; ?></h4>
                                        </button>
                                        </h2>
                                        <div id="nestedcollapse<?php echo $y; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $y; ?>" data-bs-parent="#nestedAccordion">
                                        <div class="accordion-body">
                                            <p><?php echo $description_2;?></p> 
                                        </div>
                                    </div>
                                    </div>
                                <?php $y++; endforeach;?>
                            </div>
                            <!-- Accordion Nested -- END -->
                        <?php endif;?>

                        <?php if($column_in_accordion): ?>
                            <!-- Columns -- START -->
                            <?php foreach($columns as $column):
                                $content = $column['content'];
                                $image = $column['image'];
                                $link = $column['link'];
                                ?>
                                    <div class="nested-column">
                                        <div class="row">
                                            <div class="col-12 col-md-5 col-lg-3">
                                                <?php if($image): ?>
                                                    <img class="br-100" src="<?php echo $image['url']?>" alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12 col-md-7 col-lg-9">
                                                <?php echo $content;?>
                                                <?php if($link):?>
                                                    <a class="btn blue" target="<?php echo $link['target'];?>" href="<?php echo $link['url'];?>"><?php echo $link['title'];?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach;?>
                            <!-- Columns -- END -->
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php $i++; endforeach;?>
    </div>
</section>
