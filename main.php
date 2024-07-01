<?php
/*
    Template Name: Main

*/

get_header();
the_post();
$fieldsArr = get_fields();

?>

        <!-- Main Part Start -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="<?php echo get_sidebars_class($fieldsArr['post_sidebars']);?> bg-white">

                        <?php
                        get_post_modules($fieldsArr, 'top');
                        ?>

                        <div class="text-content mt-4">
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
        <!-- Main Part End -->

<?php

get_footer();

?>