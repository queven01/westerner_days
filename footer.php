<?php
/**
 * The template for displaying the footer
 */
 $custom_scripts = get_field('custom_scripts', 'option');
 $in_body = $custom_scripts['in_body'];

 $social_media = get_field('social_media', 'option');
 $facebook = $social_media['facebook'];
 $instagram = $social_media['instagram'];
 $twitter = $social_media['twitter'];
 $linkedin = $social_media['linkedin'];

 $navigation_title = get_field('navigation_title', 'option');

 $contact_info = get_field('contact_info', 'option');
 if($contact_info){
	$contact_title = $contact_info['title'];
	$email = $contact_info['email'];
	$phone = $contact_info['phone'];
	$address = $contact_info['address'];
	$directions = $contact_info['directions'];
 } else {
	$email = "";
	$phone = "";
	$address = "";
 }

 $extra = get_field('extra', 'option');
 if($contact_info){
	$form_title = $extra['form_title'];
	$form = $extra['form'];
	$button = $extra['button'];
 }


?>
	<?php 
		get_template_part('./template-parts/pre-footer-cta', null, array()); 
		get_template_part( 'template-parts/pre-footer-button-row', 'component' );
	?>

	<footer id="colophon" class="site-footer">
	<div class="container-xl">
			<div class="row">
				<div class="col-12 col-md-4">
					<div class="quick-link-container">
						<h4 class="title"><?php echo $navigation_title; ?></h4>
						<?php 
							wp_nav_menu( array(
								'theme_location'    => 'footer',
								'depth'             => 1,
								'container'         => 'div',
							) );
						?>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="contact-info">
						<h4 class="title"><?php echo $contact_title; ?></h4>
						<ul>
							<?php if($email): ?>
								<li>Email: <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></li>
							<?php endif; ?>
							<?php if($phone): ?>
								<li>Phone: <a href="tel:<?php echo $phone;?>"><?php echo $phone;?></a></li>
							<?php endif; ?>
							<?php if($address): ?>
								<li><?php echo $address;?></li>
							<?php endif; ?>
						</ul>
						<?php if($directions): ?>
							<a target="<?php echo $directions['target']?>" href="<?php echo $directions['url']?>" class="btn link"><?php echo $directions['title']?></a>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="footer-form-container">
						<h4 class="title"><?php echo $form_title; ?></h4>
						<?php echo do_shortcode($form); ?>
						<?php if($button): ?>
							<a target="<?php echo $directions['target']?>" href="<?php echo $button['url'];?>" class="btn blue"><?php echo $button['title'];?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="footer-bottom-bar">
				<div class="row justify-content-between align-items-center">
					<div class="col-12 col-md-2">
						<div class="site-branding">
							<?php
							if ( has_custom_logo() ) : 
								the_custom_logo();
							else : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>					
							<?php endif;?>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="social-media">
							<?php if($facebook): ?>
								<a target="_blank" href="<?php echo $facebook;?>"><?php echo file_get_contents( get_template_directory_uri() . '/images/facebook.svg' ); ?></a>
							<?php endif; ?>
							<?php if($instagram): ?>
								<a target="_blank" href="<?php echo $instagram;?>"><?php echo file_get_contents( get_template_directory_uri() . '/images/instagram.svg' ); ?></a>
							<?php endif; ?>
							<?php if($twitter): ?>
								<a target="_blank" href="<?php echo $twitter;?>"><?php echo file_get_contents( get_template_directory_uri() . '/images/twitter.svg' ); ?></a>
							<?php endif; ?>
							<?php if($linkedin): ?>
								<a target="_blank" href="<?php echo $linkedin;?>"><?php echo file_get_contents( get_template_directory_uri() . '/images/linkedin.svg' ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<?php echo $in_body;?>
</body>
</html>
