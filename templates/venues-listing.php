<?php
/*
    Template Name: Venues Listing
*/

$type = get_terms( array(
    'taxonomy' => 'venue_type',
    'hide_empty' => false
) );
$capacity = get_terms( array(
    'taxonomy' => 'venue_capacity',
    'hide_empty' => false
) );
$size = get_terms( array(
    'taxonomy' => 'venue_size',
    'hide_empty' => false
) );

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_components = parse_url($url);

if (count($url_components) > 3){
    parse_str($url_components['query'], $params);
}

$typeValue = '';
$capacityValue = '';
$sizeValue = '';

if(!empty($params)){
    $typeValue = $params['type'];
    $capacityValue = $params['capacity'];
    $sizeValue = $params['size'];
}

$req_uri = $_SERVER['REQUEST_URI'];
$path = substr($req_uri,0,strrpos($req_uri,'/'));

get_header(); ?>
    <main id="main" class="standard-page">
        <section class="venues-listing-page container-xl">          
            <div class="search-filter venue">
                <h2 class="title">Our Venues</h2>
                <form action="" method="get" name='filtering' class="filter-form">
                    <select class="target" onchange="this.form.submit()" name="type" id="">
                        <option value="">Venue Type</option>
                        <?php 
                            foreach($type as $post){
                                if ($post->term_id == $typeValue){
                                    echo '<option selected value="'.$post->term_id.'">'.$post->name.'</option>';
                                } else {
                                    echo '<option value="'.$post->term_id.'">'.$post->name.'</option>';
                                }
                            }
                        ?>
                    </select>
                    <select class="target" onchange="this.form.submit()" name="capacity" id="">
                        <option value="">Capacity</option>
                        <?php 
                            foreach($capacity as $post){
                                if ($post->term_id == $capacityValue){
                                    echo '<option selected value="'.$post->term_id.'">'.$post->name.'</option>';
                                } else {
                                    echo '<option value="'.$post->term_id.'">'.$post->name.'</option>';
                                }
                            }
                        ?>
                    </select>
                    <select class="target" onchange="this.form.submit()" name="size" id="">
                        <option value="">Size</option>
                        <?php 
                            foreach($size as $post){
                                if ($post->term_id == $sizeValue){
                                    echo '<option selected value="'.$post->term_id.'">'.$post->name.'</option>';
                                } else {
                                    echo '<option value="'.$post->term_id.'">'.$post->name.'</option>';
                                }
                            }
                        ?>
                    </select>
                    <a class="btn blue" href="<?php echo $path ?>'">Clear</a>
                </form>       
            </div>
            <div class="row">
                <?php 
                
                //Filter Style
                if($capacityValue) {
                    $arg1 = array( 
                        'taxonomy' => 'venue_capacity', 
                        'terms' => $capacityValue 
                    );
                } else {
                    $arg1 = '';
                }
                if($typeValue) {
                    $arg2 = array(
                        'taxonomy' => 'venue_type', 
                        'terms' => $typeValue 
                    );
                } else {
                    $arg2 = '';
                }
                if($sizeValue) {
                    $arg3 = array(
                        'taxonomy' => 'venue_size', 
                        'terms' => $sizeValue 
                    );
                } else {
                    $arg3 = '';
                }             

                $args = array(
                    'post_type' => 'venues',
                    'posts_per_page' => -1,
                    'paged' =>  get_query_var( 'paged' ),
                    'tax_query'    => array(
                        'relation' => 'AND',
                        $arg1,
                        $arg2,
                        $arg3
                    ),
                );
                            
                $query = new WP_Query( $args );
                $posts = $query->posts;
                                
                if($posts): 
                    get_template_part( './template-parts/venue-card');
                    
                    wp_reset_postdata(); 

                    $total_pages = $query->max_num_pages;

                    if ($total_pages > 1){
                
                        $current_page = max(1, get_query_var('paged'));
                        echo '<div class="pagination-navigation">';
                        echo paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => 'page/%#%',
                            'current' => $current_page,
                            'total' => $total_pages,
                            'prev_text'    => __('<svg class="arrow flip" viewBox="0 0 9.464 16.552"><use xlink:href="#arrow-no-bg"></use></svg>'),
                            'next_text'    => __('<svg class="arrow" viewBox="0 0 9.464 16.552"><use xlink:href="#arrow-no-bg"></use></svg>'),
                        ));
                        echo '</div>';
                } ?>
                <?php else: 
                    
                    echo "<div class=\"no-results\"><p>Sorry, no results to show based on your search.</p>";
                    echo '<a class="btn transparent light" href="'.$path.'">Clear</a>';
                    echo "</div>";
                    
                endif; ?>
            </div>
        </section>
    </main><!-- .site-main -->
<?php
get_footer(); 