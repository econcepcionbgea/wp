<div id="frontend_customizer" style="left: -276px;">
    <div class="customizer_wrapper">

        <h3><?php _e('Navigation', 'cinderella'); ?></h3>
        <div class="customizer_element">
            <div class="stm_switcher" id="navigation_type">
                <div class="switcher_label disable"><?php _e('Static', 'cinderella'); ?></div>
                <div class="switcher_nav"></div>
                <div class="switcher_label enable"><?php _e('Sticky', 'cinderella'); ?></div>
            </div>
        </div>

	    <h3><?php _e('Layout', 'cinderella'); ?></h3>
	    <div class="customizer_element">
		    <div class="stm_switcher" id="site_layout">
			    <div class="switcher_label disable"><?php _e('Wide', 'cinderella'); ?></div>
			    <div class="switcher_nav"></div>
			    <div class="switcher_label enable"><?php _e('Boxed', 'cinderella'); ?></div>
		    </div>
	    </div>

	    <div class="customizer_bg_image" style="display: none;">
		    <h3><?php _e('Background Image', 'cinderella'); ?></h3>
		    <div class="customizer_element">
			    <div class="customizer_colors" id="bg_images">
				    <span class="image_type active" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_1.jpg" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_1.png'); "></span>
				    <span class="image_type" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_2.jpg" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_2.png'); "></span>
				    <span class="image_type" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_3.jpg" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_3.png'); "></span>
				    <span class="image_type" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_4.jpg" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_4.png'); "></span>
			    </div>
		    </div>
	    </div>

        <h3><?php _e('Color Skin', 'cinderella'); ?></h3>
        <div class="customizer_element">
            <div class="customizer_colors" id="skin_color">
                <span id="skin_default"></span>
                <span id="skin_beach"></span>
                <span id="skin_provence"></span>
                <span id="skin_yogurt"></span>
            </div>
        </div>
    </div>
    <div id="frontend_customizer_button"><i class="fa fa-cog"></i></div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        "use strict";

        $(window).load(function () {
            $("#frontend_customizer").animate({left: -233}, 300);
        });

        $("#frontend_customizer_button").live('click', function () {
	        if( $("#frontend_customizer").hasClass( 'open' ) ){
		        $("#frontend_customizer").animate({left: -233}, 300);
				$("#frontend_customizer").removeClass('open');
	        }else{
		        $("#frontend_customizer").animate({left: 0}, 300);
	            $("#frontend_customizer").addClass('open');
	        }            
        });
        
        $('#wrapper').click(function (kik) {
	        if (!$(kik.target).is('#frontend_customizer, #frontend_customizer *') && $('#frontend_customizer').is(':visible')) {
	            $("#frontend_customizer").animate({left: -233}, 300);
				$("#frontend_customizer").removeClass('open');
	        }
	    });

        var default_logo = $("#header .logo img").attr("src");

        if($("body").hasClass("sticky_header")){
            $("#navigation_type").addClass("active");
        }

        $("#navigation_type").live("click", function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $("body").removeClass('sticky_header');
            } else {
                $(this).addClass('active');
                $("body").addClass('sticky_header');
            }
        });

	    $("#site_layout").live("click", function () {
		    if ($(this).hasClass('active')) {
			    $(this).removeClass('active');
			    $("body").removeClass('boxed_layout');
			    $(".customizer_bg_image").hide();
		    } else {
			    $(this).addClass('active');
			    $("body").addClass('boxed_layout');
			    $(".customizer_bg_image").show();
			    $('body').removeClass('boxed_bg_image_default boxed_bg_image_pattern');
			    if( $("#bg_images span.active").hasClass('image_type') ){
				    $('body').addClass('boxed_bg_image_default');
			    }else{
				    $('body').addClass('boxed_bg_image_pattern');
			    }
			    $('body').css({'background-image' : 'url(' + $("#bg_images span.active").attr('data-image') + ')'});
		    }
	    });

        if($("body").hasClass("sticky_header")){
            $("#navigation_type").addClass("active");
        }

	    if($("body").hasClass("boxed_layout")){
		    $("#site_layout").addClass("active");
		    $(".customizer_bg_image").slideDown(150);
	    }


        if($("body").hasClass("skin_beach")){
            $("#skin_color #skin_beach").addClass("active");
	        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_beach.png');
        }else if($("body").hasClass("skin_provence")){
	        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_provence.png');
            $("#skin_color #skin_provence").addClass("active");
        }else if($("body").hasClass("skin_yogurt")){
	        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_yogurt.png');
            $("#skin_color #skin_yogurt").addClass("active");
        }else{
            $("#skin_color #skin_default").addClass("active");
        }

        $("#skin_color span").live('click', function () {
            $("#skin_color .active").removeClass("active");
            $(this).addClass("active");
	        if($(this).attr('id') == 'skin_beach'){
		        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_beach.png');
	        }else if($(this).attr('id') == 'skin_provence'){
		        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_provence.png');
	        }else if($(this).attr('id') == 'skin_yogurt'){
		        $("#header .logo img").attr("src", '<?php echo get_template_directory_uri(); ?>/assets/images/tmp/logo_yogurt.png');
	        }else{
		        $("#header .logo img").attr("src", default_logo );
	        }
            $("body").removeClass("skin_default skin_beach skin_provence skin_yogurt");
            $("body").addClass($(this).attr("id"));
        });

	    $("#bg_images span").live('click', function () {
		    $("#bg_images .active").removeClass("active");
		    $(this).addClass("active");
		    $('body').removeClass('boxed_bg_image_default boxed_bg_image_pattern');
		    if( $(this).hasClass('image_type') ){
			    $('body').addClass('boxed_bg_image_default');
		    }else{
			    $('body').addClass('boxed_bg_image_pattern');
		    }
		    $('body').css({'background-image' : 'url(' + $(this).attr('data-image') + ')'});
	    });

    });

</script>