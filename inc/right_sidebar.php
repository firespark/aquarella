<?php
global $optionsArr;
if($optionsArr['right_sidebar_news']){
$last_news = get_posts( [
    'numberposts' => 8,
    'category'    => 1,

] );
?>
                    <?php if(!empty($last_news)):?>
                    <div class="col-lg-3 col-lg-3-20 order-lg-2 sidebar">
                        <div class="sidebar-widget brands">
                            <?php if($optionsArr['right_sidebar_news_title']):?>
                            <div class="title"><?php echo $optionsArr['right_sidebar_news_title'];?></div>
                            <?php endif;?>
                            <div class="sidebar-inner">    
                                <ul>
                                    <?php foreach($last_news as $last_new):?>
                                    <?php 
                                    $newsArr = get_fields($last_new->ID);
                                    $newsUrl = get_the_permalink($last_new->ID);
                                    ?>
                                    <li>
                                        <a href="<?php echo $newsUrl;?>"><?php echo $last_new->post_title;?></a>
                                        <?php if(isset($newsArr['post_image']['url'])):?>
                                        <a href="<?php echo $newsUrl;?>"><img class="width100" src="<?php echo $newsArr['post_image']['url'];?>" alt="<?php echo $newsArr['post_image']['alt'];?>" /></a>
                                        <?php endif;?>
                                        <p><?php echo $newsArr['post_description'];?></p>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
<?php }?>