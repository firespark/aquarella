<?php
global $optionsArr;

$header_menu = get_custom_menu(16);

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <?php wp_head();?>
        <!--<style type="text/css">
            html {
                margin-top: 0 !important;
            }
        </style>-->
    </head>

    <body <?php body_class() ?>>
        <?php wp_body_open(); ?>
        <!-- Top bar Start -->
        <div class="header-container">
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php if($optionsArr['main_timetable']):?>
                            <span><i class="fa fa-clock"></i><?php echo $optionsArr['main_timetable'];?></span>
                            <?php endif;?>
                            
                        </div>
                        
                        <div class="col-sm-6 text-right">
                            <?php if($optionsArr['main_address']):?>
                            <span><i class="fa fa-map-marker"></i> <?php echo $optionsArr['main_address'];?></span>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top bar End -->
        
          
        <div class="bottom-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="logo">
                            <?php if($optionsArr['main_logo']):?>
                            <a href="/">
                                <img class="width100" src="<?php echo $optionsArr['main_logo']['url'];?>" alt="<?php echo $optionsArr['main_logo']['alt'];?>">
                            </a>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="search-column">
                            <form action="/" method="GET" class="search">
                                <input type="text" name="s" id="search" placeholder="<?php _e('Search', 'aquarella');?>">
                                <button type="sybmit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 d-none d-md-block text-right">
                        <?php if($optionsArr['main_email']):?>
                        <span><a href="mailto:<?php echo $optionsArr['main_email'];?>"><i class="fa fa-envelope"></i>&nbsp;<?php echo $optionsArr['main_email'];?></a></span><br>
                        <?php endif;?>
                        <?php if(!empty($optionsArr['main_phones'])):?>
                        <?php foreach($optionsArr['main_phones'] as $phone):?>
                        <span><a href="tel:<?php echo get_numbers_from_str($phone['phones']);?>"><i class="fa fa-phone-alt"></i>&nbsp;<?php echo $phone['phones'];?></a></span><br>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Bottom Bar Start -->
        <div class="bottom-bar nav bottom-bar__nav">
            <div class="container">
                <div class="row align-items-center">
                    
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-dark">
                            
                            <div class="d-lg-none">
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="d-md-none whiteLinks">
                                <?php if($optionsArr['main_email']):?>
                                <span><a href="mailto:<?php echo $optionsArr['main_email'];?>"><i class="fa fa-envelope"></i>&nbsp;<?php echo $optionsArr['main_email'];?></a></span><br>
                                <?php endif;?>
                                <?php if(!empty($optionsArr['main_phones'])):?>
                                <?php foreach($optionsArr['main_phones'] as $phone):?>
                                <span><a href="tel:<?php echo get_numbers_from_str($phone['phones']);?>"><i class="fa fa-phone-alt"></i>&nbsp;<?php echo $phone['phones'];?></a></span><br>
                                <?php endforeach;?>
                                <?php endif;?>
                                
                            </div>
                                
                            <?php if(!empty($header_menu)):?>                            

                            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                                <div class="navbar-nav">
                                    <?php foreach($header_menu[0] as $menu_item):?>
                                    
                                    <?php if(isset($header_menu[$menu_item['ID']])):?>
                                    <div class="nav-item dropdown">
                                        <a href="<?php echo $menu_item['url'];?>" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $menu_item['title'];?></a>
                                        <div class="dropdown-menu">
                                            <?php foreach($header_menu[$menu_item['ID']] as $menu_item2):?>
                                            <a href="<?php echo $menu_item2['url'];?>" class="dropdown-item"><?php echo $menu_item2['title'];?></a>
                                            <!--<div class="submenu__container">
                                                <a href="" class="submenu-link" data-toggle="dropdown" style="display: block;">123</a>
                                                <div class="dropdown-menu submenu-dropdown__menu" data-toggle="dropdown">
                                                    <a href="" class="dropdown-item submenu-dropdown__link">1</a>
                                                    <a href="" class="dropdown-item submenu-dropdown__link">2</a>
                                                    <a href="" class="dropdown-item submenu-dropdown__link">3</a>
                                                    <a href="" class="dropdown-item submenu-dropdown__link">5</a>
                                                </div>
                                            </div>-->
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                    <?php else:?>
                                    <a href="<?php echo $menu_item['url'];?>" class="nav-item nav-link<?php if($menu_item['object_id'] === $post->ID) echo ' active';?>"><?php echo $menu_item['title'];?></a>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </div>
                                
                            </div>
                            <?php endif;?>
                        </nav>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Bottom Bar End -->       
        
              
        
               
        
        
