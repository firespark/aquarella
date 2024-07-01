<?php
get_header();
the_post();

if(isset($_GET['s']) && $_GET['s']){
    $search = $_GET['s'];
  $results_per_page = get_option('posts_per_page');
  $paged = ( isset($_GET['show']) ) ? $_GET['show'] : 1;

  $total_posts = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix. "posts WHERE ( (post_type = 'post' AND post_status = 'publish') OR (post_type = 'page' AND post_status = 'publish') ) AND (post_title LIKE '%" . $search . "%' OR 'post_content' LIKE '%" . $search . "%')");

  $posts_args = [
    'post_type' => ['page', 'post'], 
    'posts_per_page' => $results_per_page,
    'paged' => $paged,
    's'     => $search,
                         
  ];

    //$tours = get_posts($tours_args);
    $all_posts = get_posts($posts_args);

}

?>

<!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container">
                <?php custom_breadcrumbs();?>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Main Slider Start -->
        <div class="header mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-lg-9-80 order-lg-1 bg-white">
                        
                        <div class="text-content">
                            <h1><?php _e('Search results with query', 'aquarella');?> "<?php echo $_GET['s'];?>"</h1>
                            
                        </div>
                        

                        <?php if(!empty($all_posts)):?>
                        <div class="review">
                            <div class="container">
                                <div class="row align-items-center normal-slider">
                                    <?php foreach($all_posts as $all_post):?>
                                    <?php 
                                    $str = get_custom_marked_line($all_post->post_content, $search);
                                    $str_title = get_custom_marked_line($all_post->post_title, $search);
                                    ?>
                                    <div class="col-md-12">
                                        <div class="review-slider-item">
                                            
                                            <div class="review-text">
                                                <h2><a href="<?php echo get_the_permalink($all_post->ID);?>"><?php echo $str_title;?></a></h2>
                                                <div class="list-block-description">
                                                    <p><?php echo $str;?></p>
                                                </div>                                                
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                        <div class="pagination">
                            <?php
                                if (function_exists('custom_pagination')) {
                                    custom_pagination($total_pages,"",$paged);
                                }
                            ?>
                        </div>
                        <?php else:?>
                        <p><?php _e('Nothing found with this query', 'aquarella');?></p>
                        <?php endif;?>
                        
                    </div>
                    <?php require_once( __DIR__ . '/inc/left_sidebar.php');?>
                    
                    
                </div>
            </div>
        </div>
        <!-- Main Slider End -->



<?php

get_footer();

?>
