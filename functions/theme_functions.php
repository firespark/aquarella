<?php
function setPostViews($postID, $count = NULL) {
    if(!$count){
        $count = get_field('post_views', $postID);
        if(!$count) $count = 0;
    }
    $count++;
    update_field('field_648856fba21d8', $count, $postID);
}



function get_custom_marked_line($text, $search){
  
  $content = strip_tags($text);
  
  $pos1= mb_strpos($content, $search) - 30;
  if(!$pos1 || $pos1 < 0) $pos1 = 0;
  $pos2 = $pos1 + mb_strlen($search) + 100;
                            
  $str = mb_substr($content, $pos1, $pos2) . '...';

  if($pos1) $str = '...' . $str;
  $str = mb_str_replace($search, "<mark>{$search}</mark>", mb_strtolower($str));

  return $str;
}

function get_post_modules($fieldsArr, $position = 'bottom') {
    if($fieldsArr['slider_show'] && $fieldsArr['slider_position'] === $position) {
        require_once( __DIR__ . '/../modules/slider.php');
    }
    if($fieldsArr['posts_list_show'] && $fieldsArr['posts_list_position'] === $position) {
        require_once( __DIR__ . '/../modules/posts_list.php');
    }
    if($fieldsArr['posts_list_category_show'] && $fieldsArr['posts_list_category_position'] === $position) {
        require_once( __DIR__ . '/../modules/posts_list_category.php');
    }
}

function get_sidebars_class($value = 1) {
    if($value === NULL) $value = 1;
    switch ($value) {
        case 0:
            return 'col-lg-12';
            break;
        
        case 1:
            return 'col-lg-9 col-lg-9-80 order-lg-1';
            break;

        case 2:
            return 'col-lg-6 col-lg-6-60 order-lg-1';
            break;
    }
}

function get_sidebars($value = 1) {
    if($value === NULL) $value = 1;

    switch ($value) {
                
        case 1:
            require_once( __DIR__ . '/../inc/left_sidebar.php');
            break;

        case 2:
            require_once( __DIR__ . '/../inc/left_sidebar.php');
            require_once( __DIR__ . '/../inc/right_sidebar.php');
            break;
    }
}