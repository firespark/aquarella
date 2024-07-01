<?php

get_header();
the_post();

$post = get_post(872);
$fieldsArr = get_fields();

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
                            <h1><?php echo ($fieldsArr['post_h1']) ? $fieldsArr['post_h1'] : $post->post_title;?></h1>
                            
                            

                            <?php the_content();?>
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