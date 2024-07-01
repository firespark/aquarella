<?php

function custom_theme_setup(){
    add_theme_support( 'title-tag' );
    load_theme_textdomain( 'aquarella', get_template_directory() . '/languages' );

    add_theme_support('menus');

    if(!current_user_can('administrator')){
        show_admin_bar(false);
    }

    // Page Main Settings
    if(function_exists('acf_add_options_page')){
        acf_add_options_page([
            'page_title' => __('Main settings', 'aquarella'),
            'menu_title' => __('Main settings', 'aquarella'),
            'update_button'   => __('Save', 'aquarella'),
            'menu_slug' => 'main_settings',
            'capability' => 'edit_posts',
            'redirect' => false
        ]);

    }
}

// Allow to upload iso files
function upload_allow_types( $mimes ) {
    $mimes['ico']  = 'image/vnd.microsoft.icon';
    return $mimes;
}

// Get numbers only from string
function get_numbers_from_str($str) {
    return preg_replace("/[^0-9]/", '', $str);
}

// $_POST safe processing
function get_safe_post($post){
    return htmlspecialchars(trim($post));
}


// Pagination
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

    if (empty($pagerange)) {
        $pagerange = 2;
    }

    /**
    * This first part of our function is a fallback
    * for custom pagination inside a regular loop that
    * uses the global $paged and global $wp_query variables.
    * 
    * It's good because we can now override default pagination
    * in our theme, and use this function in default quries
    * and custom queries.
    */

    if (empty($paged)) {
        $paged = 1;
    }
    if ($numpages === '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if(!$numpages) {
            $numpages = 1;
        }
    }
    if(is_front_page()){
        $base = '%_%';
        //$format = '?page=%#%';
    }
    else{
        $base = $_SERVER['REDIRECT_URL'] . '%_%';
        //$format = 'page/%#%';
    }
    $format = '?show=%#%';

    /** 
    * We construct the pagination arguments to enter into our paginate_links
    * function. 
    */
    $pagination_args = [
        'base'            => $base,
        'format'          => $format,
        'total'           => $numpages,
        'current'         => $paged,
        'show_all'        => false,
        'end_size'        => 1,
        'mid_size'        => $pagerange,
        'prev_next'       => True,
        'prev_text'       => '&laquo;',
        'next_text'       => '&raquo;',
        'type'            => 'plain',
        'add_args'        => false,
        'add_fragment'    => ''
    ];

    $paginate_links = paginate_links($pagination_args);

    if ($paginate_links) {
        echo "<nav class='custom-pagination'>";
        echo $paginate_links;
        echo "</nav>";
    }

}


// Text cut
function custom_mb_strimwidth($string, $start = 0, $width = 30, $trimmarker = '...') {
    $len = mb_strlen(trim($string));
    $newstring = ( ($len > $width) && ($len !== 0) ) ? rtrim(mb_strimwidth($string, $start, $width - mb_strlen($trimmarker))) . $trimmarker : $string;
    return $newstring;
}


// Breadcrumbs
function custom_breadcrumbs($args = []) {

    /* === Options === */
    $text['home'] = __('Home', 'aquarella');
    $text['category'] = '%s';
    $text['search'] = __('Search results with query', 'aquarella') . ' "%s"';
    $text['tag'] = __('Posts with tag', 'aquarella') . ' "%s"';
    $text['author'] = __('Authors posts', 'aquarella') . ' %s';
    $text['404'] = __('Error', 'aquarella') . ' 404';
    $text['page'] = __('Page', 'aquarella') . ' %s';
    $text['cpage'] = __('Comments page', 'aquarella') . ' %s';

    $wrap_before = '<ul class="breadcrumb">';
    $wrap_after = '</ul>';
    $sep = '';
    $before = '<li class="breadcrumb-item active">';
    $after = '</li>';

    $show_on_home = 0;
    $show_home_link = 1;
    $show_current = 1;
    $show_last_sep = 1;
    
    /* === End options === */

    global $post;
    $home_url = home_url('/');
    $link = '<li class="breadcrumb-item"><a href="%1$s">%2$s</a></li>';
    $parent_id = ( $post ) ? $post->post_parent : '';
    $home_link = sprintf( $link, $home_url, $text['home'], 1 );

    if ( is_home() || is_front_page() ) {

        if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;


        if ( $show_home_link ) {
            $position += 1;
            echo $home_link;
        }

        if(!empty($args)){
            foreach ($args as $arg) {
                echo $sep . sprintf( $link, $arg['url'], $arg['title'], $position );
                echo $sep;

            }
            if ( $show_current ){
                if ( is_page() && ! $parent_id ) {
                    echo $before . get_the_title() . $after;
                } 
                elseif ( is_page() && $parent_id ) {
                    echo $before . get_the_title() . $after;
                } 
                elseif( is_category() ){

                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                }
                elseif( is_search() ){

                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                }
        
                elseif ( is_single() && ! is_attachment() ) {
                    if ( get_post_type() !== 'post' ) {
                        echo $before . get_the_title() . $after;

                    } 
                    else {
                        echo $before . get_the_title() . $after;
              
                    }
                }
                elseif ( is_year() ) {

                    echo $before . get_the_time('Y') . $after;
                }
                elseif ( is_month() ) {
                    echo $before . get_the_time('F') . $after;
                }
                elseif ( is_day() ) {
                    echo $before . get_the_time('d') . $after;
                }
                elseif ( is_post_type_archive() ) {
                    echo $before . $post_type->label . $after;
                } 
                elseif ( is_attachment() ) {
                    echo $before . get_the_title() . $after;
                } 
        
                elseif ( is_tag() ) {
                    echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                } 
                elseif ( is_author() ) {
                    echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                } 
                elseif ( is_404() ) {
                    echo $before . $text['404'] . $after;
                }
            }
        }
        elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() !== 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo $sep;
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo $sep;
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo $sep;
                }
            }

        }
        elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        }
        elseif ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_search() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $show_home_link ) echo $sep;
                echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_month() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_day() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
            $parents = get_ancestors( $catID, 'category' );
            $parents = array_reverse( $parents );
            $parents[] = $catID;
            foreach ( $parents as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            $position += 1;
            echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . $text['404'] . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            echo get_post_format_string( get_post_format() );
        }

        echo $wrap_after;

    }
}


function mb_str_replace($needle, $replace_text, $haystack) {
    return implode($replace_text, mb_split($needle, $haystack));
}

// Menu object processing
function get_custom_menu($menu_id){
    $top_menu_obj = wp_get_nav_menu_items($menu_id);

    $menu = [];

    if(!empty($top_menu_obj)){
        foreach ($top_menu_obj as $top_menu) {
            $menu[$top_menu->menu_item_parent][] = [
                'ID' => $top_menu->ID,
                'title' => $top_menu->title,
                'url' => $top_menu->url,
                'object_id' => $top_menu->object_id,
            ];
        }
    }

    return $menu;
}

// Pagination in admin panel

function pagination_admin_panel($page, $paged, $get_par, $total_pages){
    $pagination = '<span>' . __('Pages', 'aquarella') . ': </span>';
    if ($paged !== 1){$pagination .= '<a href="/wp-admin/admin.php?page=' . $page . $get_par . '" title="' . __('First page', 'aquarella') . '">&lt;&lt;&lt;</a>';}
    for ($i = 1; $i <= $total_pages; $i++){
        if($i === $paged || (!$paged && $i === 1)) $pagination .= '<span>' . $i . '</span>';
        else {
            $pagination .= '<a href="';
            if($i === 1) $pagination .= '/wp-admin/admin.php?page=' . $page . $get_par; 
            else $pagination .= '/wp-admin/admin.php?page=' . $page . '&paged=' .$i . $get_par;
            $pagination .= '">' . $i . '</a>';
        }
    }

    if($paged !== $total_pages){
        $pagination .= '<a href="/wp-admin/admin.php?page=' . $page . '&paged=' . $total_pages . $get_par . '" title="' . __('Last page', 'aquarella') . '">&gt;&gt;&gt;</a>';
    }
    return $pagination;
}