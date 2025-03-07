<?php
/*
 * Plugin name: Form and popup
 * Plugin URI: whateverdomain.com
 * Description: Form and popup
 * Author: VL
 * Version: 1.0.0
 * License: Open
 * 
 */

//Exit if accessed directly
if(!defined('ABSPATH')){
       exit;
}

function magnific_popup_enqueue_files(){

    wp_register_style( 'magnific-popup', plugin_dir_url( __FILE__ ) . 'magnific-popup/magnific-popup.css' );
    wp_register_style( 'style', plugin_dir_url( __FILE__ ) . 'style.css' );

    //wp_register_script( 'jquery' );
    wp_register_script( 'magnific-popup', plugin_dir_url( __FILE__ ) . 'magnific-popup/jquery.magnific-popup.js', array(), '', true );
    wp_register_script( 'js', plugin_dir_url( __FILE__ ) . 'js.js', array(), '', true );

}
add_action( 'wp_enqueue_scripts', 'magnific_popup_enqueue_files');


function form_and_popup_shortcode(){

	ob_start();

    wp_enqueue_style( 'magnific-popup' );
    wp_enqueue_style( 'style' );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'magnific-popup' );
    wp_enqueue_script( 'js' );
    
    ?>
		
    	<form>
    		
    		<input type="text" name="name" placeholder="Nombre *" required=""><br/>
    		<input type="email" name="email" placeholder="E-mail *" required=""><br/>
    		<input type="checkbox" name="policy" id="policy-check" required=""> I have read and accept the <a href="<?php echo home_url(); ?>">privacy policy</a> <br/>
    		<input type="submit" name="send" value="Send">

    	</form>    
            
        <a class="popup-with-zoom-anim" id="politic-popup" href="#small-dialog" style="display: none;">Open with fade-zoom animation</a>

        <div id="small-dialog" class="zoom-anim-dialog mfp-hide" style="text-align: left; color: #000;">
        
        	<?php

                $args = array(
                    'post_type' => 'any',
                    'p' => 3, // Privacy policy page ID number
                );

                $query = new WP_Query($args);

                while($query->have_posts()) : $query->the_post();
                
                    ?>                  

                        <div>
                            <?php the_title(); ?>
                        </div>
                        <div>
                            <?php the_content(); ?>
                        </div>
                                
                    <?php           
        
                endwhile; wp_reset_postdata();

            ?>

        </div>

		<?php
    
	return ob_get_clean();

}
add_shortcode("form_and_popup", "form_and_popup_shortcode");