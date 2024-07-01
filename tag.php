<?php
get_header();
the_post();

$tag = get_queried_object();

$results_per_page = get_option('posts_per_page');

$paged = ( isset($_GET['show']) ) ? $_GET['show'] : 1;

$args = [
    'tag_id' => $tag->term_id
];

$total_posts = $tag->count;
$total_pages = ceil($total_posts/$results_per_page);
$args['posts_per_page'] = $results_per_page;
$args['paged'] = $paged;
$articles = get_posts($args);

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
                            <h1>#<?php echo $tag->name;?></h1>
                            
                        </div>
                        

                        <?php if(!empty($articles)):?>
                        <div class="review">
                            <div class="container">
                                <div class="row align-items-center normal-slider">
                                    <?php foreach($articles as $article):?>
                                    <?php $articleArr = get_fields($article->ID);?>
                                    <div class="col-md-12">
                                        <div class="review-slider-item">
                                            
                                            <div class="review-text">
                                                <h2><a href="<?php echo get_the_permalink($article->ID);?>"><?php echo $article->post_title;?></a></h2>
                                                <div class="article-aside clearfix">
                                                    <dl class="article-info  muted">
                                                        <?php if($articleArr['post_show_create_date']):?>
                                                        <dd class="modified"> <i class="fa fa-clock"></i> <time><?php _e('Created', 'aquarella');?>: <?php echo get_the_date($article->ID);?> </time> </dd>
                                                        <?php endif;?>
                                                        <?php if($articleArr['post_show_modify_date']):?>
                                                        <dd class="modified"> <i class="fa fa-clock"></i> <time><?php _e('Updated', 'aquarella');?>: <?php echo date("d-m-Y", strtotime($article->post_modified));?> </time> </dd>
                                                        <?php endif;?>
                                                        <?php if($articleArr['post_show_views']):?>
                                                        <dd class="hits"> <i class="fa fa-eye"></i> <?php _e('Views', 'aquarella');?>: <?php echo $articleArr['post_views'];?> </dd>
                                                        <?php endif;?>
                                                    </dl>
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
                        <?php endif;?>

                        <div class="text-content">

                            <?php echo $category->description;?>
                        </div>
                        
                    </div>
                    <?php require_once( __DIR__ . '/inc/left_sidebar.php');?>
                    
                    
                </div>
            </div>
        </div>
        <!-- Main Slider End -->



<?php

get_footer();

?>
