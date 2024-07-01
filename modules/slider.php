                        <?php if($fieldsArr['slider']):?>

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php for ($i=0; $i < count($fieldsArr['slider']); $i++):?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>"<?php if($i === 0) echo ' class="active"';?>></li>
                                <?php endfor;?>
                                
                            </ol>
                            <div class="carousel-inner">
                                <?php foreach($fieldsArr['slider'] as $slide_key => $slide):?>
                                <div class="carousel-item<?php if($slide_key === 0) echo ' active';?>">
                                    <img class="d-block w-100" src="<?php echo $slide['image']['url'];?>" alt="<?php echo $slide['image']['alt'];?>">
                                    <?php if($slide['title'] || $slide['description'] || ($slide['url'] && $slide['button_text'])):?>
                                    <div class="carousel-caption d-none d-md-block">
                                        <div class="carousel-caption-inner">
                                            <div class="h3"><?php echo $slide['title'];?></div>
                                            <p><?php echo $slide['description'];?></p>
                                            <?php if($slide['url'] && $slide['button_text']):?>
                                            <a class="btn" href="<?php echo $slide['url'];?>"><?php echo $slide['button_text'];?></a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <?php endforeach;?>
                            </div>
                            <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only"><</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">></span>
                            </a>-->
                        </div>

                        <?php endif;?>