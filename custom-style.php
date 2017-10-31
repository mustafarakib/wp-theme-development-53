<?php
if ( ! function_exists( 'stock_mr_google_fonts_url' ) ) :
    /**
     * Register Google fonts.
     *
     * @return string Google fonts URL for the theme.
     */
    function stock_mr_google_fonts_url() {
        $fonts_url = '';
        $fonts     = array();

        $body_font_variant = cs_get_option('body_font_variant');
        $body_font_variant_processed = implode(',', $body_font_variant);
        $body_subsets   = ':'.$body_font_variant_processed.'';

        $heading_font_variant = cs_get_option('heading_font_variant');
        $heading_font_variant_processed = implode(',', $heading_font_variant);
        $heading_subsets   = ':'.$heading_font_variant_processed.'';

        $body_font = cs_get_option('body_font') ['family'];
        $body_font .= $body_subsets;

        $heading_font = cs_get_option('heading_font') ['family'];
        $heading_font .= $heading_subsets;

        /* translators: If there are characters in your language that are not supported by this font,
        translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== esc_html_x( 'on', 'Karla font: on or off', 'stock-mr' ) ) {
            $fonts[] = $body_font;
        }

        /* translators: If there are characters in your language that are not supported by this font,
        translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'stock-mr' ) ) {
            $fonts[] = $heading_font;
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
            ), 'https://fonts.googleapis.com/css' );
        }
        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 */
function stock_mr_prefix_scripts() {
    // add custom fonts, used in the main stylesheet
    wp_enqueue_style( 'stock-mr-google-fonts', stock_mr_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'stock_mr_prefix_scripts' );


// add inline stylesheet
function stock_mr_custom_css() {
    wp_enqueue_style( 'stock-mr-custom-style',
        get_template_directory_uri().'/assets/css/custom-style.css');

    $body_font = cs_get_option('body_font')['family'];
    $body_font_variant = cs_get_option('body_font')['variant'];

    $heading_font = cs_get_option('heading_font')['family'];
    $heading_font_variant = cs_get_option('heading_font')['variant'];

    $enable_boxed_layout = cs_get_option('enable_boxed_layout');
    $body_bg_color = cs_get_option('body_bg_color');

    $body_bg_img = cs_get_option('body_bg_img');
    $body_bg_img_array = wp_get_attachment_image_src($body_bg_img, 'large', false);

    $body_bg_repeat = cs_get_option('body_bg_repeat');
    $body_bg_attachment = cs_get_option('body_bg_attachment');

    $footer_bg_color = cs_get_option('footer_bg_color');
    $footer_text_color = cs_get_option('footer_text_color');
    $footer_heading_color = cs_get_option('footer_heading_color');

    $theme_color= cs_get_option('theme_color');
    $theme_secondary_color= cs_get_option('theme_secondary_color');

    $custom_css = '
       body {
           font-family:'.esc_html( $body_font ).'; 
           font-weight:'.esc_attr( $body_font_variant ).'
       }
       h1,h2,h3,h4,h5,h6 { 
           font-family: '.esc_html( $heading_font ).'; 
           font-weight:'.esc_attr( $heading_font_variant ).'
       }';

    if($enable_boxed_layout == true){

        if(!empty($body_bg_color)){
            $custom_css .= '
                body{background-color : '.esc_attr( $body_bg_color ).'}
             ';
        }
        if(!empty($body_bg_img)){
            $custom_css .= '
                body{background-image : url('.esc_url($body_bg_img_array[0]).') }
             ';
        }
        if(!empty($body_bg_repeat)){
            $custom_css .= '
                body{background-repeat : '.esc_attr( $body_bg_repeat ).'}
             ';
        }
        if(!empty($body_bg_attachment)){
            $custom_css .= '
                body{background-attachment : '.esc_attr( $body_bg_attachment ).'}
             ';
        }
    }

    if(!empty( $footer_bg_color ) ){
        $custom_css .= '.site-footer {
                background-color:'.esc_attr( $footer_bg_color ).'}
        ';
    }
    if(!empty( $footer_text_color ) ){
        $custom_css .= '.site-footer, .site-footer a {
                color:'.esc_attr( $footer_text_color ).'}
        ';
    }
    if(!empty( $footer_heading_color ) ){
        $custom_css .= '.site-footer h4.widget-title {
                color:'.esc_attr( $footer_heading_color ).'}
        ';
    }

    if(!empty( $theme_color) ) {
        $custom_css .='
            input[type="submit"],
            button[type="submit"],
            .preloader-wrapper,
            .stock-cart-count,
            .stock-breadcrumb-area,
            .stock-breadcrumb-area:before,
            .stock-readmore-btn,
            .entry-content .page-links a,
            .reply a,
            .stock-slides .owl-nav div:hover i,
            .stock-service-box:hover .stock-service-icon:after,
            .vc_row.overlay-2:after,
            .vc_wp_custommenu li a:before,
            ul.stock-project-shorting li:before,
            .project-widgets li a:before,
            .current-menu-item:before,
            .stock-cta-box.stock-cta-box-theme-2,
            .work-box-bg i.fa,
            .mainmenu li ul li:hover a {
                background-color: '.esc_attr( $theme_color ).'
            }
            
            a, .stock-cart,
            a.stock-contact-box:hover i.fa,
            .mainmenu li a:hover,
            .entry-header h2 a:hover,
            .service-more-link,
            .list-box li,
            .testimonial-text a,
            .finance-list-box li:before,
            .single-work-box p:hover,
            .work-box-bg i.fa:hover,
            .stock-project-shorting-2 li:hover,
            .stock-project-shorting-2 li.active {
                color: '.esc_attr( $theme_color ).'
            }
        ';
    }
    if(!empty( $theme_secondary_color ) ){
        $custom_css .= '
            .bordered-btn:after {
                background_color:'.esc_attr( $theme_secondary_color ).'
            }
        ';
    }

    wp_add_inline_style('stock-mr-custom-style',$custom_css);
}
add_action( 'wp_enqueue_scripts', 'stock_mr_custom_css' );
