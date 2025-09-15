<?php
class CustomPostType{
    private $types = array();

    public function __construct($typelist = array()) {
        //set up post list

        if(!empty($typelist)){
            $this->types = $typelist;
            $this->createTypes();
        }

        $this->createTaxonomies();
        //setup options page

        return 'Done'; 
    }

    //call to create custom types
    private function createTypes(){
        $thelist = $this->types;
        //go through list of types and create it
        if(is_array($thelist)){

            for($i = 0; $i < count($thelist); $i++){
                $mytype = $thelist[$i];
                $public = (isset($mytype['public'])) ? $mytype['public'] : true;
                $options = (isset($mytype['options'])) ? $mytype['options'] : null;

                //assume singular and plural always exist
                $this->buildTypeObject($mytype['singular'], $mytype['plural'], $public, $options);
            }

        }
    }

    //set up taxonomies for custom types
    private function createTaxonomies(){
        $this->buildTaxonomy('Event Category', 'Event Categories' , array('events'),array('hierarchical'=>true));
        $this->buildTaxonomy('Event Type', 'Event Types' , array('events'),array('hierarchical'=>true));

        $this->buildTaxonomy('Concession Category', 'Concession Categories' , array('concessions'),array('hierarchical'=>true));
        $this->buildTaxonomy('Venue Type', 'Venue Types' , array('venues'),array('hierarchical'=>true));
        $this->buildTaxonomy('Venue Capacity', 'Venue Capcities' , array('venues'),array('hierarchical'=>true));
        $this->buildTaxonomy('Venue Size', 'Venue Sizes' , array('venues'),array('hierarchical'=>true));
        $this->buildTaxonomy('Team Category', 'Team Categories' , array('teammembers'),array('hierarchical'=>true)); 
    }

    private function buildTypeObject($singular, $plural, $public = true, $options = array() ){

        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( $plural, 'Post Type General Name', 'kccustombase' ),
            'singular_name'       => _x( $singular, 'Post Type Singular Name', 'kccustombase' ),
            'menu_name'           => __( $plural, 'kccustombase' ),
            'parent_item_colon'   => __( 'Parent '.$singular, 'kccustombase' ),
            'all_items'           => __( 'All '.$plural, 'kccustombase' ),
            'view_item'           => __( 'View '.$singular, 'kccustombase' ),
            'add_new_item'        => __( 'Add New '.$singular, 'kccustombase' ),
            'add_new'             => __( 'Add New', 'kccustombase' ),
            'edit_item'           => __( 'Edit '.$singular, 'kccustombase' ),
            'update_item'         => __( 'Update '.$singular, 'kccustombase' ),
            'search_items'        => __( 'Search '.$singular, 'kccustombase' ),
            'not_found'           => __( 'Not Found', 'kccustombase' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'kccustombase' ),
        );

        //check options

        if(empty($options)){
            $options = array(
                'exclude_search' => false,
                'queryable' => false,
                'supports' => array('title','editor','excerpt','thumbnail'),
                'taxonomies' => array(),
                'description' => $singular.' content',
            );
        }

        //post options
        $args = array(
            'label'               => __( strtolower($plural), 'kccustombase' ),
            'description'         => isset($options['description']) ? __( $options['description'], 'kccustombase' ): $singular.' content',
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => isset($options['supports']) ? $options['supports']: array('title','editor','excerpt','thumbnail'), //array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields')
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => isset($options['taxonomies']) ? $options['taxonomies']: array(),
            'menu_icon'           => isset($options['menu_icon']) ? $options['menu_icon'] : '',
            'hierarchical'        => false,
            'public'              => $public,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            //'menu_position'       => 5, //not sure if this is needed yet
            'can_export'          => $public,
            'has_archive'         => isset($options['has_archive']) ? $options['has_archive'] : $public,
            'exclude_from_search' => isset($options['exclude_search']) ? $options['exclude_search']: $public,
            'publicly_queryable'  => isset($options['queryable']) ? $options['queryable']: $public,
            'capability_type'     => 'page',
        );

        // Registering your Custom Post Type
        register_post_type( strtolower($plural), $args );

    }

    private function buildTaxonomy($singular,$plural, $attached_types = array()){
       // Add new taxonomy, make it hierarchical (like categories)
        $lower_singular = strtolower($singular);
        $machine = str_replace(' ','_',$lower_singular);
        $labels = array(
            'name'              => _x( $plural, 'taxonomy general name', 'kccustombase' ),
            'singular_name'     => _x( $singular, 'taxonomy singular name', 'kccustombase' ),
            'search_items'      => __( 'Search '.$plural, 'kccustombase' ),
            'all_items'         => __( 'All '.$plural, 'kccustombase' ),
            'parent_item'       => __( 'Parent '.$singular, 'kccustombase' ),
            'parent_item_colon' => __( 'Parent '.$singular.':', 'kccustombase' ),
            'edit_item'         => __( 'Edit '.$singular, 'kccustombase' ),
            'update_item'       => __( 'Update '.$singular, 'kccustombase' ),
            'add_new_item'      => __( 'Add New '.$singular, 'kccustombase' ),
            'new_item_name'     => __( 'New '.$singular.' Name', 'kccustombase' ),
            'menu_name'         => __( $singular, 'kccustombase' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => $machine ),
            'capabilities'      => array(
                'assign_terms' => 'manage_options',
                'edit_terms'   => true,
                'manage_terms' => 'manage_options',
            ),
        );

        register_taxonomy( $machine, $attached_types , $args );

    }
}

//call to set up content
$my_custom_posts = array(

    array(
        'singular'  => 'Venue',
        'plural'    => 'Venues',
        'public'    => true,
        'options'   => array(
            'menu_icon' => 'dashicons-store',
            'has_archive' => false,
            ), //array of settings
        ),
    array(
        'singular'  => 'Event',
        'plural'    => 'Events',
        'public'    => true,
        'options'   => array(
            'menu_icon' => 'dashicons-calendar',
            'has_archive' => false,
            
            ), //array of settings
        ),
    array(
        'singular'  => 'Team Member',
        'plural'    => 'Team Members',
        'public'    => false,
        'options'   => array(
            'menu_icon' => 'dashicons-groups',
            'has_archive' => false,
            ), //array of settings
        ),
    array(
        'singular'  => 'Concession',
        'plural'    => 'Concessions',
        'public'    => false,
        'options'   => array(
            'menu_icon' => 'dashicons-food',
            'has_archive' => false,
            ), //array of settings
        )
);

//call to set up new fields
$newfields = new CustomPostType($my_custom_posts);
