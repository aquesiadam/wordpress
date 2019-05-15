<?php
/**
 * Banner Section
 * 
 * @package WP_Tour_Package
 */

$title        = get_theme_mod( 'banner_title', __( 'Find Your Best Holiday', 'wp-tour-package' ) );
$sub_title    = get_theme_mod( 'banner_subtitle', __( 'Find great adventure holidays and activities around the planet.', 'wp-tour-package' ) );
$button_label = get_theme_mod( 'banner_btn_label', __( 'Get Started', 'wp-tour-package' ) );
$button_url   = get_theme_mod( 'banner_btn_url', __( 'Get Started', 'wp-tour-package' ) );
$banner_image = get_header_image();

if( $banner_image ){ ?>  
<div class="banner">
	<?php 
        the_custom_header_markup(); 
        
        if( ( $button_label && $button_url ) || $title || $sub_title ){ ?>	
            <div class="form-holder">
        		<?php 
                    if( $title || $sub_title ){
                        echo '<div class="text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">';
                        if( $title ) echo '<h1>' . esc_html( $title ) . '</h1>';
                        if( $sub_title ) echo '<div class="banner-content">' . wp_kses_post( wpautop( $sub_title ) ) . '</div>';
                        
                        if( ( $button_label && $button_url )  ){
                            echo '<a class="btn-banner" href='. esc_url( $button_url ) .'>'. esc_html( $button_label ) .'</a>';
                        }        
                        echo '</div>';
                    }
                ?>
        	</div>            
        <?php 
        }
    ?>
</div> <!-- banner ends -->
<?php
}            