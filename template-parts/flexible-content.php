<?php
/**
 * Template for Flexible Layout
 */

?> 

<?php 
    // Check value exists.
    if( have_rows('flexible_content') ):
        // Loop through rows.
        while ( have_rows('flexible_content') ) : the_row();

            if( get_row_layout() == 'content_with_image' ):
                get_template_part( 'template-parts/flexible/content-w-image');
            elseif( get_row_layout() == 'content_columns' ): 
                get_template_part( 'template-parts/flexible/content-columns');
            elseif( get_row_layout() == 'link_row' ): 
                get_template_part( 'template-parts/flexible/link-row');
            elseif( get_row_layout() == 'team_row' ): 
                get_template_part( 'template-parts/flexible/team-row');
            elseif( get_row_layout() == 'events_circle_display' ): 
                get_template_part( 'template-parts/flexible/events-circle-row');
            elseif( get_row_layout() == 'facts_row' ): 
                get_template_part( 'template-parts/flexible/facts-row');
            elseif( get_row_layout() == 'sponsor_row' ): 
                get_template_part( 'template-parts/flexible/sponsor-row');
            elseif( get_row_layout() == 'information_icon_row' ): 
                get_template_part( 'template-parts/flexible/icon-row');
            elseif( get_row_layout() == 'job_row' ): 
                get_template_part( 'template-parts/flexible/job-row');
            elseif( get_row_layout() == 'carousel_row' ): 
                get_template_part( 'template-parts/flexible/carousel-row');
            elseif( get_row_layout() == 'accordion_row' ): 
                get_template_part( 'template-parts/flexible/accordion-row');
            elseif( get_row_layout() == 'logo_carousel' ): 
                get_template_part( 'template-parts/flexible/logo-carousel-row');
            elseif( get_row_layout() == 'card_row' ): 
                get_template_part( 'template-parts/flexible/card-row');
            elseif( get_row_layout() == 'information_blocks' ): 
                get_template_part( 'template-parts/flexible/information-blocks');
            endif;

        // End loop.
        endwhile;

    // No value.
    else :
        // Do something...
        echo "<h2> Add Something to your page </h2>";
    endif;
?>
