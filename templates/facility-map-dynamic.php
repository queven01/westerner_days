<?php
/**
 * Template Name: Facility Map Dynamic
 */

$map_file = get_field('map_file');

$address_section = get_field('address_section');
$address_title = $address_section['title'];
$address = $address_section['address'];
$link = $address_section['link'];
$image = $address_section['image'];

get_header(); ?>

    <main id="main" class="container">
        <section class="facility-map-section">
            <div id="map_file"><?php echo $map_file; ?></div>
            <div class="map-container">
                <div id="sidebar" class="">
                    <div id="feature-info"></div>
                </div>
                <div id="map"></div>
            </div>
        </section>
        <?php if ($address_title): ?>
            <section class="address_section">
                <div class="row">
                    <div class="content-side col-12 col-md-6">
                        <h2><?php echo $address_title; ?></h2>
                        <h3><?php echo $address; ?></h3>
                        <?php if ($link): ?><a target="<?php echo $link['target']?>" class="btn blue" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a><?php endif; ?>
                    </div>
                    <div class="image-side col-12 col-md-6">
                        <img src="<?php echo $image['url'] ?>" alt="">
                    </div>
                </div>
            </section>
        <?php endif; ?>
	</main><!-- #main -->

<?php
get_footer();