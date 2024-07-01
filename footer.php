<?php
global $optionsArr;
$footer_menu = wp_get_nav_menu_items(29);
$footer_menu2 = wp_get_nav_menu_items(30);

?>

    <!-- Footer Start -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <?php if($optionsArr['main_footer_logo']):?>
                            <p><img class="width100" src="<?php echo $optionsArr['main_footer_logo']['url'];?>" alt="<?php echo $optionsArr['main_footer_logo']['url'];?>"></p>
                            <?php endif;?>
                            <?php echo $optionsArr['main_footer_text'];?>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <?php if(!empty($footer_menu)):?>
                            <ul>
                                <?php foreach($footer_menu as $menu_item):?>
                                <li><a href="<?php echo $menu_item->url;?>"><?php echo $menu_item->title;?></a></li>
                                <?php endforeach;?>
                            </ul>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <?php if(!empty($footer_menu2)):?>
                            <ul>
                                <?php foreach($footer_menu2 as $menu_item):?>
                                <li><a href="<?php echo $menu_item->url;?>"><?php echo $menu_item->title;?></a></li>
                                <?php endforeach;?>
                            </ul>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <ul>
                                <?php echo $optionsArr['main_footer_metrics'];?>
                            </ul>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 copyright">
                        <p><?php echo $optionsArr['main_copy'];?></p>
                    </div>

                    <div class="col-md-6 template-by">
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->       
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <?php wp_footer();?>
        
    </body>
</html>


