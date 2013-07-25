<?php 

$slides = get_setting_array( 'slides' );

if( empty( $slides ) ) return;
?>
<div id="home">
    <div id="slides">
        <ul class="slides-container">
            <?php foreach( $slides as $slide ) { ?>
            <li>
                <img src="<?php echo $slide['img']; ?>" alt="" />
                <div class="detail">
                    <span class="sosa">&#x<?php echo $slide['icon']; ?>;</span>
                    <p class="title"><?php echo $slide['title']; ?> <span><?php echo $slide['sub_title']; ?></span></p>
                    <p style="text-shadow: 2px 2px 1px rgba(0,0,0,0.4);" class="lead"><?php echo $slide['teaser']; ?></p>
                </div>
            </li>
            <?php } ?>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="prev"><i class="icon-chevron-left icon-white"></i></a>
            <a href="#" class="next"><i class="icon-chevron-right icon-white"></i></a>
        </div>
    </div>
    <div class="bg-arrow"></div>
</div>