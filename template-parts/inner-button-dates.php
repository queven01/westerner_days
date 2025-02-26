<section class="inner-menu button-row">
    <div class="posts-inner-menu">
        <div class="bigger-container">
            <?php 
            if ($args) {
                $current_month_keys = $args['data'];
                $current_month_key = $args['data2'];
                $paged = $args['paged'];
            }
            
            // Generate all months links
            $all_month_links = '';
            $unique_month_keys = array_unique($current_month_keys);

            foreach ($unique_month_keys as $index => $month_key) {
                $month_link = get_pagenum_link(array_search($month_key, $unique_month_keys) + 1);
                $month_name = date('M', strtotime($month_key));
                $is_current = ($month_key == $current_month_key) ? ' current-month' : ''; // Add a class for the current month
                $all_month_links .= "<li><a href='$month_link' class='month-link$is_current'>$month_name</a></li>";
            }

            echo '<ul id="inner-page-navigation-dates">';

            // Previous month arrow
            $previous_month_key = isset($current_month_keys[$paged - 2]) ? $current_month_keys[$paged - 2] : null;
            if ($previous_month_key) {
                $previous_month_name = date('M', strtotime($previous_month_key));
                $previous_month_link = get_pagenum_link($paged - 1);
                echo "<li><a href='$previous_month_link'>&lt;</a></li>";
            }

            // Display all months links
            echo $all_month_links;

            // Next month arrow
            $next_month_key = isset($current_month_keys[$paged]) ? $current_month_keys[$paged] : null;
            if ($next_month_key) {
                $next_month_name = date('M', strtotime($next_month_key));
                $next_month_link = get_pagenum_link($paged + 1);
                echo "<li><a href='$next_month_link'>&gt;</a></li>";
            }

            echo '</ul>';
            ?>
        </div>
    </div>
</section>