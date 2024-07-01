                        <?php if($fieldsArr['posts_list_title']):?>
                        <div class="text-content">
                            <div class="h2"><?php echo $fieldsArr['posts_list_title'];?></div>
                            
                        </div>
                        <?php endif;?>

                        <?php if(!empty($fieldsArr['posts_list'])):?>
                        <div class="review">
                            <div class="container">
                                <div class="row align-items-center normal-slider">
                                    <?php foreach($fieldsArr['posts_list'] as $article):?>
                                    <?php $articleArr = get_fields($article->ID);?>
                                    <div class="col-md-12">
                                        <div class="review-slider-item">
                                            <?php if($articleArr['post_image']):?>
                                            <div class="review-img">
                                                <img src="<?php echo get_template_directory_uri();?>/img/aquarella-lr-232.jpg" alt="">
                                            </div>
                                            <?php endif;?>
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
                                                
                                                <p><?php echo $articleArr['post_description'];?></p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                        
                        <?php endif;?>