<?php
/**
 * Theme functions and definitions
 *
 * @package WP_Tour_Package
 */

/**
 * Load assets.
 *
 */
function wp_tour_package_enqueue_styles() {
    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];

	wp_enqueue_style( 'travel-agency-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'wp-tour-package-style', get_stylesheet_directory_uri() . '/style.css', array( 'travel-agency-style' ), $version );
}
add_action( 'wp_enqueue_scripts', 'wp_tour_package_enqueue_styles' );

/**
 * Custom header
 */
function wp_tour_package_custom_header(){

	$header_args = array(
		'default-image' => get_stylesheet_directory_uri() . '/images/banner-img.jpg',
		'width'         => 1920,
		'height'        => 680,
		'header-text'   => false 
	);

	return $header_args;
}
add_filter( 'travel_agency_custom_header_args', 'wp_tour_package_custom_header' );

/**
 * After setup theme hook
 */
function wp_tour_package_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'wp-tour-package', get_stylesheet_directory() . '/languages' );

    /**
     * Register default header image
     */
	register_default_headers( array(
        'child' => array(
            'url'           => '%2$s/images/banner-img.jpg',
            'thumbnail_url' => '%2$s/images/banner-img.jpg',
            'description'   => __( 'Default Header Image', 'wp-tour-package' ),
        ),
    ) );
}
add_action( 'after_setup_theme', 'wp_tour_package_theme_setup' );

/**
 * Header Start
 */
function travel_agency_header(){ ?>
    <header class="site-header header-four" itemscope itemtype="http://schema.org/WPHeader">
		<div class="header-holder">
			<div class="header-t">
				<div class="container">
					<div class="left">
						<?php
	                        wp_tour_package_header_time();
	                        wp_tour_package_header_email();
	                    ?>
					</div><!-- .left -->
					<div class="right">
						<?php wp_tour_package_social_links(); ?>
					</div><!-- .right -->
				</div>
			</div><!-- .header-t -->
			<div class="header-b">
				<div class="container">
					<?php 
	                    wp_tour_package_site_branding();
	                    wp_tour_package_header_phone();
	                ?>  
				</div>
			</div><!-- .header-b -->
		</div><!-- .header-holder -->
		
	    <div class="sticky-holder"></div>
	    
		<div class="nav-holder">
			<div class="container">
				<?php wp_tour_package_primary_nav(); ?>
				<div class="tools">
					<?php 
	                    wp_tour_package_get_header_search();
	                ?>
				</div><!-- .tools -->
			</div>
		</div><!-- .nav-holder -->
	</header><!-- .site-header/.header-four -->
    <?php
}

/**
 * Remove action from parent
*/
function wp_tour_package_remove_action(){
    remove_action( 'customize_register', 'travel_agency_customizer_theme_info' );
    remove_action( 'customize_register', 'travel_agency_customizer_demo_content' );    
}
add_action( 'init', 'wp_tour_package_remove_action' );

function wp_tour_package_customizer_theme_info( $wp_customize ){
    $wp_customize->add_section( 'theme_info', array(
		'title'       => __( 'Information Links' , 'wp-tour-package' ),
		'priority'    => 6,
	) );
    
    /** Important Links */
	$wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<div class="customizer-custom">';
    $theme_info .= '<h3 class="sticky_title">' . __( 'Need help?', 'wp-tour-package' ) . '</h3>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View demo', 'wp-tour-package' ) . ': </label><a href="' . esc_url( 'https://demo.raratheme.com/tour-package/' ) . '" target="_blank">' . __( 'here', 'wp-tour-package' ) . '</a></span>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Recommended plugins', 'wp-tour-package' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/documentation/tour-package/#Installing_Recommended_Plugins' ) . '" target="_blank">' . __( 'here', 'wp-tour-package' ) . '</a></span>';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View documentation', 'wp-tour-package' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/documentation/tour-package/' ) . '" target="_blank">' . __( 'here', 'wp-tour-package' ) . '</a></span>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support ticket', 'wp-tour-package' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/support-ticket/' ) . '" target="_blank">' . __( 'here', 'wp-tour-package' ) . '</a></span>';
	$theme_info .= '<span class="sticky_info_row"><label class="more-detail row-element">' . __( 'More Details', 'wp-tour-package' ) . ': </label><a href="' . esc_url( 'http://raratheme.com/wordpress-themes/' ) . '" target="_blank">' . __( 'here', 'wp-tour-package' ) . '</a></span>';
	$theme_info .= '</div>';

	$wp_customize->add_control( new Travel_Agency_Info_Text( $wp_customize,
        'theme_info_theme', 
            array(
            	'label' => __( 'About Tour Package' , 'wp-tour-package' ),
                'section'     => 'theme_info',
                'description' => $theme_info
            )
        )
    );
    
    /** Demo Content Import */
    $wp_customize->add_section( 
        'theme_demo_content',
        array(
            'title'    => __( 'Demo Content Import', 'wp-tour-package' ),
            'priority' => 7,
		)
    );
        
    $wp_customize->add_setting(
		'demo_content_instruction',
		array(
			'sanitize_callback' => 'wp_kses_post'
		)
	);

	$demo_content_description = sprintf( __( 'WP Tour Package comes with demo content import feature. You can import the demo content with just one click. For step-by-step video tutorial, %1$sClick here%2$s', 'wp-tour-package' ), '<a class="documentation" href="' . esc_url( 'https://raratheme.com/blog/import-demo-content-rara-themes/' ) . '" target="_blank">', '</a>' );

	$wp_customize->add_control(
		new Travel_Agency_Info_Text( 
			$wp_customize,
			'demo_content_instruction',
			array(
				'label'       => __( 'About Demo Import' , 'wp-tour-package' ),
				'section'     => 'theme_demo_content',
				'description' => $demo_content_description
			)
		)
	);
    
	$theme_demo_content_desc = '<div class="customizer-custom">';

	if( ! class_exists( 'RDDI_init' ) ){
		$theme_demo_content_desc .= '<span><label class="row-element">' . __( 'Plugin required', 'wp-tour-package' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/plugins/rara-one-click-demo-import/' ) . '" target="_blank">' . __( 'Rara One Click Demo Import', 'wp-tour-package' ) . '</a></span><br />';
	}

	$theme_demo_content_desc .= '<span><label class="row-element">' . __( 'Download Demo Content', 'wp-tour-package' ) . ': </label><a href="' . esc_url( 'https://raratheme.com/documentation/tour-package/' ) . '" target="_blank" rel="no-follow">' . __( 'Click here', 'wp-tour-package' ) . '</a></span><br />';

	$theme_demo_content_desc .= '</div>';
	$wp_customize->add_setting( 
        'theme_demo_content_info',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
		)
    );

	// Demo content 
	$wp_customize->add_control( 
        new Travel_Agency_Info_Text( 
            $wp_customize,
            'theme_demo_content_info',
            array(
                'section'     => 'theme_demo_content',
                'description' => $theme_demo_content_desc
    		)
        )
    );
    
    /** Changing priority for static front page */
    $wp_customize->get_section( 'static_front_page' )->priority = 99;
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'wp_tour_package_customizer_theme_info' );
/**
 * Disable customizer fields from parent
 */
add_action( 'customize_register', 'wp_tour_package_customize_register', 50 );

function wp_tour_package_customize_register( $wp_customize ){
    // Top header
	$wp_customize->remove_setting( 'ed_search');
    $wp_customize->remove_control( 'ed_search');

    $wp_customize->remove_setting( 'phone');
	$wp_customize->remove_control( 'phone');

    $wp_customize->remove_setting( 'phone_label');
    $wp_customize->remove_control( 'phone_label');

    $wp_customize->remove_setting( 'ed_social_links');
    $wp_customize->remove_control( 'ed_social_links');

    $wp_customize->remove_setting( 'social_links');
    $wp_customize->remove_control( 'social_links');

     // Banner search 
    $wp_customize->remove_setting( 'ed_banner_search');
    $wp_customize->remove_control( 'ed_banner_search');

    /**
     * Top header
     */ 

    /** Phone Number  */
    $wp_customize->add_setting(
        'phone',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'phone',
        array(
            'label'       => __( 'Phone Number', 'wp-tour-package' ),
            'description' => __( 'Add phone no. in header.', 'wp-tour-package' ),
            'section'     => 'header_misc_setting',
            'type'        => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'phone', array(
        'selector'        => '.site-header .header-b .phone',
        'render_callback' => 'travel_agency_get_header_phone',
    ) );
    
    /** Phone Label  */
    $wp_customize->add_setting(
        'phone_label',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'phone_label',
        array(
            'label'       => __( 'Phone Label', 'wp-tour-package' ),
            'description' => __( 'Add phone label in header.', 'wp-tour-package' ),
            'section'     => 'header_misc_setting',
            'type'        => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'phone_label', array(
        'selector' => '.site-header .header-b .phone-label',
        'render_callback' => 'travel_agency_get_phone_label',
    ) );


    /** Work Hour */
    $wp_customize->add_setting(
        'time',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'time',
        array(
            'label'       => __( 'Work Hour', 'wp-tour-package' ),
            'description' => __( 'Add working hour in header.', 'wp-tour-package' ),
            'section'     => 'header_misc_setting',
            'type'        => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'time', array(
        'selector'        => '.site-header .opening-time .time',
        'render_callback' => 'wp_tour_package_get_time',
    ) );

    /** Email */
    $wp_customize->add_setting(
        'email',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'email',
        array(
            'label'       => __( 'Email', 'wp-tour-package' ),
            'description' => __( 'Add email in header.', 'wp-tour-package' ),
            'section'     => 'header_misc_setting',
            'type'        => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'email', array(
        'selector'        => '.site-header .email-link .email',
        'render_callback' => 'travel_agency_pro_get_email',
    ) );

	/** Banner link one label */
    $wp_customize->add_setting(
        'banner_btn_label',
        array(
            'default'           => __( 'Get Started', 'wp-tour-package' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_btn_label',
        array(
            'section'         => 'header_image',
            'label'           => __( 'Button Label', 'wp-tour-package' ),
        )
    );

    // Selective refresh for banner link one label
    $wp_customize->selective_refresh->add_partial( 'banner_btn_label', array(
        'selector'            => '.banner .form-holder a.btn-banner',
        'render_callback'     => 'wp_tour_package_btn_label_selective_refresh',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
    ) );

     /** Banner link one url */
    $wp_customize->add_setting(
        'banner_btn_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'banner_btn_url',
        array(
			'section' => 'header_image',
			'label'   => __( 'Button Url', 'wp-tour-package' ),
			'type'    => 'url',
        )
    );

    /** Enable/Disable Social Links */
    $wp_customize->add_setting(
        'ed_social_links',
        array(
            'default'           => false,
            'sanitize_callback' => 'travel_agency_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_social_links',
        array(
            'section'     => 'social_setting',
            'label'       => __( 'Social Links', 'wp-tour-package' ),
            'description' => __( 'Enable to show social links in header.', 'wp-tour-package' ),
            'type'        => 'checkbox'
        )       
    );

    /** Social Links */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => array(),
                'sanitize_callback' => array( 'Travel_Agency_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Travel_Agency_Control_Repeater(
            $wp_customize,
            'social_links',
            array(
                'section' => 'social_setting',              
                'label'   => __( 'Social Links', 'wp-tour-package' ),
                'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'wp-tour-package' ),
                        'description' => __( 'Example: fa-bell', 'wp-tour-package' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'wp-tour-package' ),
                        'description' => __( 'Example: http://facebook.com', 'wp-tour-package' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'wp-tour-package' ),
                    'field' => 'link'
                )                        
            )
        )
    );
}

/**
 * Prints phone number in header
*/
function travel_agency_get_header_phone(){
    return get_theme_mod( 'phone', '' );
}

/**
 * Prints phone label
*/
function travel_agency_get_phone_label(){
    return get_theme_mod( 'phone_label', '' );
}

/**
 * Selective refresh for header email 
 */
function travel_agency_pro_get_email(){
    return get_theme_mod( 'email', '' );
}

/**
 * Selective refresh for banner button 
 */
function wp_tour_package_btn_label_selective_refresh(){
	return get_theme_mod( 'banner_btn_label', __( 'Get Started', 'wp-tour-package') );
}


/**
 * Header Time
*/
function wp_tour_package_header_time(){
    $time = get_theme_mod( 'time', '' );
    if( $time ) echo '<div class="opening-time"><i class="fa fa-clock-o"></i><span class="time">' . esc_html( $time ) . '</span></div>';
}

/**
 * Header Email
*/
function wp_tour_package_header_email(){
    $email = get_theme_mod( 'email', '' );
    if( $email ) echo '<a href="' . esc_url( 'mailto:' . sanitize_email( $email ) ) . '" class="email-link"><i class="fa fa-envelope-open-o"></i><span class="email">' . esc_html( $email ) . '</span></a>';
}

/**
 * Prints Time
*/
function wp_tour_package_get_time(){
    return get_theme_mod( 'time', '' );
}


/**
 * Prints social links in header
*/
function wp_tour_package_social_links(){
    $social_links = get_theme_mod( 'social_links', array() );
    $ed_social    = get_theme_mod( 'ed_social_links', false ); 
    
    if( $ed_social && $social_links ){
        echo '<ul class="social-networks">';
    	foreach( $social_links as $link ){
            if( $link['link'] && $link['font'] ) echo '<li><a href="' . esc_url( $link['link'] ) . '" target="_blank" rel="nofollow"><i class="' . esc_attr( $link['font'] ) . '"></i></a></li>';    	   
    	}
	   echo '</ul>';    
    }
}

/**
 * Site Branding
*/
function wp_tour_package_site_branding(){
    ?>
    <div class="site-branding" itemscope itemtype="http://schema.org/Organization">
		<?php 
	        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                the_custom_logo();
            } 
        ?>
        <div class="text-logo">
            <?php if ( is_front_page() ) : ?>
                <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
                <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
            <?php endif; 
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
        </div>
	</div><!-- .site-branding -->
    <?php
}


/**
 * Header Phone
*/
function wp_tour_package_header_phone(){
    $phone       = get_theme_mod( 'phone', '' );
    $phone_label = get_theme_mod( 'phone_label', '' );
    
    echo '<div class="right">';
    if( $phone_label ) echo '<span class="phone-label">' . esc_html( $phone_label ) . '</span>';
    if( $phone ) echo '<a href="' . esc_url( 'tel:' . preg_replace( '/\D/', '', $phone ) ) . '" class="tel-link"><span class="phone">' . esc_html( $phone ) . '</span></a>';
    echo '</div>';
}

/**
 * Primary Navigation
*/
function wp_tour_package_primary_nav(){ ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-link"><i class="fa fa-home"></i></a>
    <div id="primary-toggle-button"><?php esc_html_e( 'MENU', 'wp-tour-package' );?><i class="fa fa-bars"></i></div>
    <nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
                'fallback_cb'    => 'wp_tour_package_primary_menu_fallback',
			) );
		?>
	</nav><!-- #site-navigation -->
    <?php
}

/**
 * Fallback for primary menu
*/
function wp_tour_package_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'wp-tour-package' ) . '</a></li>';
        echo '</ul>';
    }
}

/**
 * Display search button in header
*/
function wp_tour_package_get_header_search(){ 
    $ed_search = get_theme_mod( 'ed_search', false );
    if( $ed_search ){ ?>
        <div class="form-section">
    		<a href="javascript:void(0);" id="btn-search"><span class="fa fa-search"></span></a>
    		<div class="form-holder">
    			<?php get_search_form(); ?>
    		</div>
    	</div><!-- .form-section -->
        <?php
    }
}

/**
 * Footer Bottom
*/
function travel_agency_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="site-info">
			<?php
                travel_agency_get_footer_copyright();
                echo esc_html__( 'Tour Package | Developed By ', 'wp-tour-package' );
                echo '<a href="' . esc_url( 'https://raratheme.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Tour Package', 'wp-tour-package' ) . '</a>';
                
                printf( esc_html__( ' Powered by %s', 'wp-tour-package' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'wp-tour-package' ) ) .'" target="_blank">WordPress</a> .' );                        
                 
            ?>                              
		</div>
        <?php 
        if ( function_exists( 'the_privacy_policy_link' ) ) {
            the_privacy_policy_link();
        }
        ?>
        <nav class="footer-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
                    'fallback_cb'    => false,
				) );
			?>
		</nav><!-- .footer-navigation -->
	</div>
    <?php
}