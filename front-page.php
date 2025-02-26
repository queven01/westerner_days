<?php
/**
 * The home page file
 *
 * @package Westerner_Park
 */

get_header();
?>  
	<main id="primary" class="site-main">

        <?php
            get_template_part("components/home/button_row");

            get_template_part("template-parts/count-down");

            get_template_part("components/home/intro");

            get_template_part("components/home/event_carousel");

            get_template_part("components/home/event_planning");

            get_template_part("components/home/fun_facts");

            get_template_part("components/home/logo_carousel");

            get_template_part("components/home/call_to_action");
        ?> 
    </main>
<?php
get_footer();