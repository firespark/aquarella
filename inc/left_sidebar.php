<?php
global $optionsArr;
?>                     
                    <div class="col-lg-3 col-lg-3-20 order-lg-0 sidebar">
                        <?php if($optionsArr['left_sidebar_menu_1']):?>
                        <?php $left_menu = get_custom_menu(17);?>
                        <?php if(!empty($left_menu)):?>
                        <div class="sidebar-widget brands">
                            <?php if($optionsArr['left_sidebar_menu_1_title']):?>
                            <div class="title"><?php echo $optionsArr['left_sidebar_menu_1_title'];?></div>
                            <?php endif;?>
                            <div class="sidebar-inner">
                                <ul class="navbar-nav" id="accordion">
                                    <?php foreach($left_menu[0] as $menu_item):?>
                                    <?php if(isset($left_menu[$menu_item['ID']])):?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo $menu_item['url'];?>" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-angle-down"></i><?php echo $menu_item['title'];?></a>
                                        <ul id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <?php foreach($left_menu[$menu_item['ID']] as $menu_item2):?>
                                            <li class="sub-nav-item">
                                                <a class="nav-link" href="<?php echo $menu_item2['url'];?>"><?php echo $menu_item2['title'];?></a>
                                            </li>
                                            <?php endforeach;?>
                                            
                                        </ul>
                                    </li>
                                    <?php else:?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo $menu_item['url'];?>"><?php echo $menu_item['title'];?></a>
                                    </li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php endif;?>

                        <?php if($optionsArr['left_sidebar_menu_2']):?>
                        <?php $left_menu2 = get_custom_menu(18);?>

                        <?php if(!empty($left_menu2)):?>
                        <div class="sidebar-widget brands">
                             <?php if($optionsArr['left_sidebar_menu_2_title']):?>
                            <div class="title"><?php echo $optionsArr['left_sidebar_menu_2_title'];?></div>
                            <?php endif;?>
                            <div class="sidebar-inner">
                                <ul>
                                    <?php foreach($left_menu2[0] as $menu_item):?>
                                    <li><a href="<?php echo $menu_item['url'];?>"><?php echo $menu_item['title'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php endif;?>

                    </div>