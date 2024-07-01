<?php

get_header();
the_post();

$fieldsArr = get_fields();
$tags = get_the_tags();
setPostViews($post->ID, $fieldsArr['post_views']);

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
                    <div class="<?php echo get_sidebars_class($fieldsArr['post_sidebars']);?> bg-white">
                        
                        <div class="text-content">
                            <h1><?php echo ($fieldsArr['post_h1']) ? $fieldsArr['post_h1'] : $post->post_title;?></h1>
                            <aside class="article-aside clearfix">
                                <dl class="article-info  muted">
                                    <?php if($fieldsArr['post_show_create_date']):?>
                                    <dd class="modified"> <i class="fa fa-clock"></i> <time><?php _e('Created', 'aquarella');?>: <?php echo get_the_date();?> </time> </dd>
                                    <?php endif;?>
                                    <?php if($fieldsArr['post_show_modify_date']):?>
                                    <dd class="modified"> <i class="fa fa-clock"></i> <time datetime="<?php echo $post->post_modified_gmt;?>" itemprop="dateModified"><?php _e('Updated', 'aquarella');?>: <?php echo date("d-m-Y", strtotime($post->post_modified));?> </time> </dd>
                                    <?php endif;?>
                                    <?php if($fieldsArr['post_show_views']):?>
                                    <dd class="hits"> <i class="fa fa-eye"></i> <meta itemprop="interactionCount" content="UserPageVisits:<?php echo $fieldsArr['post_views'];?>"><?php _e('Views', 'aquarella');?>: <?php echo $fieldsArr['post_views'];?> </dd>
                                    <?php endif;?>
                                </dl>
                            </aside>
                            <?php if(!empty($tags)):?>
                            <div class="tags">
                                <span class="tag-2 tag-list0" itemprop="keywords">
                                    <?php foreach($tags as $tag):?>
                                    <a href="<?php echo get_term_link($tag);?>" class="label label-info"> <?php echo $tag->name;?> </a> </span> <span class="tag-8 tag-list1" itemprop="keywords">
                                    <?php endforeach;?>
                            </div>
                            <?php endif;?>
                            <?php if($optionsArr['main_social_share'] && $fieldsArr['post_show_social']):?>
                            <div class="mb-3">
                                <?php echo $optionsArr['main_social_share'];?>
                            </div>
                            <?php endif;?>
                        </div>

                        <?php
                        get_post_modules($fieldsArr, 'top');
                        ?>

                        <div class="text-content">

                            <?php the_content();?>
                        </div>

                        <?php
                        get_post_modules($fieldsArr, 'bottom');
                        ?>
                        
                    </div>
                    <?php get_sidebars($fieldsArr['post_sidebars']);?>
                    
                    
                </div>
            </div>
        </div>
        <!-- Main Slider End -->

<?php

get_footer();

?>