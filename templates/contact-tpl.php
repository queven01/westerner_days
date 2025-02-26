<?php
/**
 * Template Name: Contact Template
 */

$contact_information = get_field('contact_information');
if($contact_information){
    $title = $contact_information['title'];
    $description = $contact_information['description'];
    $email = $contact_information['email'];
    $phone = $contact_information['phone'];
    $address_title = $contact_information['address_title'];
    $address = $contact_information['address'];
    $hours_title = $contact_information['hours_title'];
    $hours = $contact_information['hours'];
    $button = $contact_information['button'];
    $button_2 = $contact_information['button_2'];
    $form = $contact_information['form'];
}

$specific_inquiries = get_field('specific_inquiries');
if($specific_inquiries){
    $inquiry_title = $specific_inquiries['title'];
    $inquiries = $specific_inquiries['inquiries'];
}

$location_section = get_field('location_section');
if($contact_information){
    $location_title = $location_section['title'];
    $location_address = $location_section['address'];
    $location_button = $location_section['button'];
    $location_map = $location_section['google_map'];
}


get_header(); ?>

    <main id="main" class="container contact-page">
        <section class="contact-information my-5">
            <div class="row">
                <div class="content-side col-12 col-md-6">
                    <h2 class="title"><?php echo $title; ?></h2>
                    <p><?php echo $description; ?></p>

                    <h3><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></h3>
                    <p><?php echo $phone; ?></p>

                    <h3><?php echo $address_title; ?></h3>
                    <p><?php echo $address; ?></p>

                    <h3><?php echo $hours_title; ?></h3>
                    <ul class="times">
                        <?php foreach($hours as $hour):?>
                            <li>
                                <?php echo $hour['day']?>
                                <?php echo $hour['time']?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if($button): ?><a class="btn blue me-3" target="<?php echo $button['target']; ?>" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a><?php endif; ?>
                    <?php if($button_2): ?><a class="btn blue" target="<?php echo $button_2['target']; ?>" href="<?php echo $button_2['url']; ?>"><?php echo $button_2['title']; ?></a><?php endif; ?>
                </div>
                <div class="form-side col-12 col-md-6">
                    <?php echo $form; ?>
                </div>
            </div>
        </section>
        <?php if($inquiry_title):?>
        <section class="specific_inquiries my-5">
            <h2 class="title"><?php echo $inquiry_title; ?></h2>
            <div class="inquiries row">
                <?php foreach($inquiries as $inquiry):?>
                    <div class="inquiry col-12 col-md-6 col-lg-4">
                        <h4><?php echo $inquiry['title']?></h4>
                        <p><a href="mailto:<?php echo $inquiry['email']?>"><?php echo $inquiry['email']?></a></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
        <section class="location_section my-5">
            <div class="row">
                <div class="content-side col-md-6">
                    <h2 class="title"><?php echo $location_title; ?></h2>
                    <h4><?php echo $location_address; ?></h4>
                    
                    <?php if($location_button): ?>
                        <a class="btn mt-3" target="<?php echo $location_button['target']; ?>" href="<?php echo $location_button['url']; ?>"><?php echo $location_button['title']; ?></a>
                    <?php endif; ?>
                </div>
                <div class="map-side col-md-6">
                    <iframe src="<?php echo $location_map; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
	</main><!-- #main -->

<?php
get_footer();
