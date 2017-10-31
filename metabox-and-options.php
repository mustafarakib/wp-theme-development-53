<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

function stock_theme_metabox($options){
    $options      = array(); // remove old options

    /*-------------------------------------------------------------
    ##  Page metabox options
    --------------------------------------------------------------*/
    $options[]    = array(
        'id'        => 'stock_page_options',
        'title'     => 'Page Options',
        'post_type' => 'page',
        'context'   => 'normal',
        'priority'  => 'high',

        'sections'    => array(
            array(
                'name'  => 'stock_page_options_meta',
                'fields' => array(
                    array(
                        'id' => 'enable_title',
                        'type' => 'switcher',
                        'title' => esc_html__('Enable page title?', 'stock-mr'),
                        'default' => true,
                        'desc' => esc_html__('If you want to enable title, select ON.', 'stock-mr')
                    ),
                    array(
                        'id'=>'custom_title',
                        'type'=>'text',
                        'title'=> esc_html__('Enable custom title?', 'stock-mr'),
                        'dependency'=> array( 'enable_title', '==', 'true'),
                        'desc'=> esc_html__('Type your custom title', 'stock-mr'),
                    ),
                ),
            ),
        ),
    );

    /*-------------------------------------------------------------
    ##  Slide options
    --------------------------------------------------------------*/
    $options[]    = array(
        'id'        => 'stock_slide_options',
        'title'     => esc_html__('Slide Options', 'stock-mr'),
        'post_type' => 'slide',
        'context'   => 'normal',
        'priority'  => 'high',
        'sections'  => array(

            // begin: a section
            array(
                'name'  => 'stock_slide_options_meta',

                // begin: fields
                'fields' => array(

                    array(
                        'id'              => 'buttons',
                        'type'            => 'group',
                        'title'           => esc_html__('Slide Buttons', 'stock-mr'),
                        'button_title'    => esc_html__('Add New', 'stock-mr'),
                        'accordion_title' => esc_html__('Add New Button', 'stock-mr'),

                        'fields'          => array(
                            array(
                                'id'    => 'type',
                                'type'  => 'select',
                                'title' => esc_html__('Button Type', 'stock-mr'),
                                'desc' => esc_html__('Select Button Type', 'stock-mr'),
                                'options'  => array(
                                    'bordered'  => esc_html__('Bordered button', 'stock-mr'),
                                    'filled'   => esc_html__('Filled button', 'stock-mr'),
                                ),
                            ),
                            array(
                                'id'    => 'text',
                                'type'  => 'text',
                                'title' => esc_html__('Button Text', 'stock-mr'),
                                'desc' => esc_html__('Type Button Text', 'stock-mr'),
                                'default' => esc_html__('Get free consultation', 'stock-mr'),
                            ),
                            array(
                                'id'    => 'link_type',
                                'type'  => 'select',
                                'title' => esc_html__('Link Type', 'stock-mr'),
                                'desc' => esc_html__('Select Link Type', 'stock-mr'),
                                'options'  => array(
                                    '1'  => esc_html__('WordPress Page', 'stock-mr'),
                                    '2'   => esc_html__('External Link', 'stock-mr'),
                                ),
                                array(
                                    'id'    => 'link_to_page',
                                    'type'  => 'select',
                                    'title' => esc_html__('Select Page', 'stock-mr'),
                                    'desc' => esc_html__('Select Linked Page', 'stock-mr'),
                                    'options' => 'page',
                                    'dependency'   => array( 'link_type', '==', '1' ),
                                ),
                                array(
                                    'id'    => 'link_to_external',
                                    'type'  => 'text',
                                    'title' => esc_html__('Type URL', 'stock-mr'),
                                    'desc' => esc_html__('Type Link URL', 'stock-mr'),
                                    'dependency'   => array( 'link_type', '==', '2' ),
                                ),
                            ),
                        ),
                    ),

                    array(
                        'id'    => 'enable_overlay',
                        'type'  => 'switcher',
                        'default'  => true,
                        'title' => esc_html__('Enable overlay?', 'stock-mr'),
                    ),
                    array(
                        'id'    => 'overlay_percentage',
                        'type'  => 'text',
                        'title' => esc_html__('Overlay Percentage', 'stock-mr'),
                        'desc' => esc_html__('Type overlay percentage in floating number, max value is 1', 'stock-mr'),
                        'default'  => esc_attr('.7'),
                        'dependency' => array('enable_overlay', '==', 'true'),
                    ),
                    array(
                        'id'    => 'overlay_color',
                        'type'  => 'color_picker',
                        'title' => esc_html__('Overlay Color', 'stock-mr'),
                        'default'  => esc_attr('#181a1f', 'stock-mr'),
                        'dependency' => array('enable_overlay', '==', 'true'),
                    ),

                ), // end: fields
            ), // end: a section
        ), // end: sections
    ); // end: $options
    return $options;
}
add_filter('cs_metabox_options', 'stock_theme_metabox');


function stock_theme_option_settings( $settings ){
    $settings = array(); // remove old settings

    $settings = array(
        'menu_title' => esc_html__('Theme Options','stock-mr'),
        'menu_type' => 'theme', // menu, submenu, options, theme, etc.
        'menu_slug' => 'stock-theme-options',
        'ajax_save' => true,
        'show_reset_all' => true,
        'framework_title' => esc_html__('Stock - by MR','stock-mr'),
    );
    return $settings;
}
add_filter('cs_framework_settings', 'stock_theme_option_settings');


function stock_theme_options( $options ){
    $options = array(); // remove default theme options

    $options[]    = array(
        'name'      => 'stock_mr_header_settings',
        'title'     => esc_html__('Header Settings', 'stock-mr'),
        'icon'      => 'fa fa-heart',
        'fields'    => array(
            array(
                'id'              => 'header_iconic_boxes',
                'type'            => 'group',
                'title'           => esc_html__('Iconic Boxes', 'stock-mr'),
                'desc'            => esc_html__('If you want to show iconic box on header, add those here.', 'stock-mr'),
                'button_title'    => esc_html__('Add New', 'stock-mr'),
                'accordion_title' => esc_html__('Add New Field', 'stock-mr'),
                'fields'          => array(
                    array(
                        'id'    => 'title',
                        'type'  => 'text',
                        'title' => esc_html__('Title', 'stock-mr'),
                        'desc' => esc_html__('Type Your Header Title', 'stock-mr'),
                    ),
                    array(
                        'id'    => 'icon',
                        'type'  => 'icon',
                        'title' => esc_html__('Icon', 'stock-mr'),
                        'desc' => esc_html__('Select Your Header Icon', 'stock-mr'),
                    ),
                    array(
                        'id'    => 'big_title',
                        'type'  => 'text',
                        'title' => esc_html__('Big Title', 'stock-mr'),
                        'desc' => esc_html__('Type Another Header Title', 'stock-mr'),
                    ),
                    array(
                        'id'    => 'link',
                        'type'  => 'text',
                        'title' => esc_html__('Link', 'stock-mr'),
                        'desc' => esc_html__('Type your header link. Leave blank, if you do not want a link.', 'stock-mr')
                    ),
                ),
            ),
        )
    );

    $options[]    = array(
        'name'      => 'stock_mr_logo_settings',
        'title'     => esc_html__('Logo Settings', 'stock-mr'),
        'icon'      => 'fa fa-file-o',
        'fields'    => array(
            array(
                'id'    => 'enable_image_logo',
                'type'  => 'switcher',
                'default'  => false,
                'title' => esc_html__('Enable Image Logo', 'stock-mr'),
            ),
                array(
                    'id'    => 'image_logo',
                    'type'  => 'image',
                    'title' => esc_html__('Upload Image Logo', 'stock-mr'),
                    'dependency' => array('enable_image_logo', '==', 'true'),
                ),
                array(
                    'id'    => 'image_logo_max_height',
                    'type'  => 'text',
                    'default'  => '60',
                    'title'      =>  esc_html__('Logo maximum height','stock-mr'),
                    'desc'       =>  esc_html__('Input maximum height of logo in px','stock-mr'),
                    'dependency' => array('enable_image_logo', '==', 'true'),
                ),
            array(
                'id'    => 'text_logo',
                'type'  => 'text',
                'title' => esc_html__('Text Logo', 'stock-mr'),
                'desc' => esc_html__('Type Your Logo Text', 'stock-mr'),
                'default' => esc_html__('Stock', 'stock-mr'),
                'dependency' => array('enable_image_logo', '==', 'false'),
            ),
        )
    );

    $options[]    = array(
        'name'      => 'stock_mr_styling_settings',
        'title'     => esc_html__('Styling Settings', 'stock-mr'),
        'icon'      => 'fa fa-pencil-square-o',
        'fields'    => array(
            array(
                'id'        => 'theme_color',
                'type'      => 'color_picker',
                'title' => esc_html__('Theme Color', 'stock-mr'),
                'desc' => esc_html__('Select Your Theme Color', 'stock-mr'),
                'default' => esc_attr('#278cc1', 'stock-mr')
            ),
            array(
                'id'        => 'theme_secondary_color',
                'type'      => 'color_picker',
                'title' => esc_html__('Theme Secondary Color', 'stock-mr'),
                'desc' => esc_html__('Select Your Theme Secondary Color', 'stock-mr'),
                'default' => esc_attr('#fef14a', 'stock-mr')
            ),
            array(
                'id'        => 'enable_preloader',
                'type'      => 'switcher',
                'default'   => true,
                'title' => esc_html__('Enable Preloader', 'stock-mr'),
                'desc' => esc_html__('Select ON, if you want to activate Preloader', 'stock-mr'),
            ),

            array(
                'id'        => 'enable_boxed_layout',
                'type'      => 'switcher',
                'default'   => false,
                'title' => esc_html__('Enable Boxed Layout', 'stock-mr'),
                'desc' => esc_html__('Select ON, if you want Boxed Layout', 'stock-mr'),
            ),
                array(
                    'id'    => 'body_bg_color',
                    'type'  => 'color_picker',
                    'title' => esc_html__('Body Background Color', 'stock-mr'),
                    'desc' => esc_html__('Select Body Background Color', 'stock-mr'),
                    'dependency'   => array('enable_boxed_layout', '==', 'true'),
                ),
                array(
                    'id'        => 'body_bg_img',
                    'type'      => 'image',
                    'title' => esc_html__('Body Background Image', 'stock-mr'),
                    'desc' => esc_html__('Upload Body Background Image', 'stock-mr'),
                    'dependency'=> array('enable_boxed_layout', '==', 'true')
                ),
                array(
                    'id'        => 'body_bg_repeat',
                    'type'      => 'select',
                    'default'   => 'repeat',
                    'title' => esc_html__('Body Background Repet', 'stock-mr'),
                    'desc' => esc_html__('Select Body Background Repet', 'stock-mr'),
                    'options'   => array(
                        'repeat'      => esc_attr__('Repeat', 'stock-mr'),
                        'no-repeat'   => esc_attr__('No Repet', 'stock-mr'),
                        'cover'       => esc_attr__('Cover', 'stock-mr'),
                    ),
                    'dependency'=> array('enable_boxed_layout', '==', 'true')
                ),
                array(
                    'id'        => 'body_bg_attachment',
                    'type'      => 'select',
                    'default'   => 'scroll',
                    'title' => esc_html__('Body Background Attachment', 'stock-mr'),
                    'desc' => esc_html__('Select Body Background Attachment', 'stock-mr'),
                    'options'   => array(
                        'scroll'      => esc_attr__('Scroll', 'stock-mr'),
                        'fixed'       => esc_attr__('Fixed', 'stock-mr'),
                    ),
                    'dependency'=> array('enable_boxed_layout', '==', 'true')
                ),
        )
    );

    $options[]    = array(
        'name'      => 'stock_mr_blog_settings',
        'title'     => 'Blog Settings',
        'icon'      => 'fa fa-pencil',
        'fields'    => array(
            array(
                'id'        => 'display_post_by',
                'type'      => 'switcher',
                'default'   =>  true,
                'title' => esc_html__('Display Post By?', 'stock-mr'),
                'desc' => esc_html__('Select ON, if you want to show posted by name on blog index page and single blog.', 'stock-mr'),
            ),
            array(
                'id'        => 'display_post_date',
                'type'      => 'switcher',
                'default'   =>  true,
                'title'   => esc_html__('Display post date?', 'stock-mr'),
                'desc'    => esc_html__('If you want to show blog post date on blog index page and single blog, select on', 'stock-mr'),
            ),
            array(
                'id'        => 'display_post_comment_count',
                'type'      => 'switcher',
                'default'   =>  true,
                'title'   => esc_html__('Display comments count?', 'stock-mr'),
                'desc'    => esc_html__('If you want to show comments count on blog index page, select on', 'stock-mr'),
            ),
            array(
                'id'        => 'display_post_category',
                'type'      => 'switcher',
                'default'   =>  true,
                'title'   => esc_html__('Display post categories?', 'stock-mr'),
                'desc'    => esc_html__('If you want to show blog categories on blog index page and single blog, select on', 'stock-mr'),
            ),
            array(
                'id'        => 'display_post_tag',
                'type'      => 'switcher',
                'default'   =>  true,
                'title'   => esc_html__('Display post tags?', 'stock-mr'),
                'desc'    => esc_html__('If you want to show tags on blog index page and single blog, select on', 'stock-mr'),
            ),
            array(
                'id'        => 'display_post_nav',
                'type'      => 'switcher',
                'default'   =>  true,
                'title' => esc_html__('Enable next previous link on single post?', 'stock-mr'),
                'desc' => esc_html__('If you want to show next previous link on single blog, select on', 'stock-mr'),
            ),
        )
    );

    $options[]    = array(
        'name'      => 'stock_mr_footer_settings',
        'title'     => esc_html__('Footer Settings', 'stock-mr'),
        'icon'      => 'fa fa-file-archive-o',
        'fields'    => array(
            array(
                'id'        => 'footer_bg_color',
                'type'      => 'color_picker',
                'title' => esc_html__('Footer Background Color', 'stock-mr'),
                'desc' => esc_html__('Select Footer Background Color', 'stock-mr'),
                'default' => esc_attr('#2a2d2f', 'stock-mr')
            ),
            array(
                'id'        => 'footer_text_color',
                'type'      => 'color_picker',
                'title' => esc_html__('Footer Text Color', 'stock-mr'),
                'desc' => esc_html__('Select Footer Text Color', 'stock-mr'),
                'default' => esc_attr('#afb9c0', 'stock-mr')
            ),
            array(
                'id'        => 'footer_heading_color',
                'type'      => 'color_picker',
                'title'   => esc_html__('Footer heading color', 'stock-mr'),
                'default' => esc_attr__('#ffffff', 'stock-mr'),
            ),
            array(
                'id'        => 'footer_copyright_text',
                'type'      => 'textarea',
                'title'    => esc_html__('Footer Copyright Text', 'stock-mr'),
                'desc' => esc_html__('Type Your Copyright Text', 'stock-mr'),
                'default' => esc_html__('Copyright © 2017 FairDealLab - All Rights Reserved', 'stock-mr')
            ),
        )
    );

    $options[]    = array(
        'name'      => 'stock_mr_script_settings',
        'title'     => 'Script Settings',
        'icon'      => 'fa fa-file-text',
        'fields'    => array(
            array(
                'id'        => 'head_script',
                'type'      => 'textarea',
                'sanitize'   =>  false,
                'title' => esc_html__('Header Script', 'stock-mr'),
                'desc' => esc_html__('Script goes before closing < / head >', 'stock-mr'),
            ),
            array(
                'id'        => 'body_start_script',
                'type'      => 'textarea',
                'sanitize'   =>  false,
                'title' => esc_html__('Body Start Script', 'stock-mr'),
                'desc' => esc_html__('Script goes just after < body > starts', 'stock-mr'),
            ),
            array(
                'id'        => 'body_end_script',
                'type'      => 'textarea',
                'sanitize'   =>  false,
                'title' => esc_html__('Body End Script', 'stock-mr'),
                'desc' => esc_html__('Script goes just before closing < / body >', 'stock-mr'),
            ),
        )
    );

    $options[]    = array(
        'name'      => 'stock_mr_social_links',
        'title' => esc_html__('Social Links', 'stock-mr'),
        'icon'      => 'fa fa-heart',
        'fields'    => array(
            array(
                'id'              => 'social_links',
                'type'            => 'group',
                'title'           => esc_html__('Social Links', 'stock-mr'),
                'button_title'    => esc_html__('Add New', 'stock-mr'),
                'accordion_title' => esc_html__('Add social links', 'stock-mr'),
                'fields'          => array(
                    array(
                        'id'    => 'icon',
                        'type'  => 'icon',
                        'title' => esc_html__('Icon', 'stock-mr'),
                        'desc' => esc_html__('Select Social Icon', 'stock-mr'),
                    ),
                    array(
                        'id'    => 'link',
                        'type'  => 'text',
                        'title' => esc_html__('Link', 'stock-mr'),
                        'desc' => esc_html__('Type Social Link', 'stock-mr'),
                    ),
                ),
            ),
        )
    );

    return $options ;
}
add_filter('cs_framework_options','stock_theme_options');
