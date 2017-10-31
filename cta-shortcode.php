<?php

function stock_cta_shortcode( $atts, $content = null ){

    extract(shortcode_atts(array(
        'title' => '',
        'desc' => '',
        'type' => 1,
        'link_to_page' => '',
        'theme' => 1,
        'link_source' => '',
        'external_link' => '',
        'link_text' => esc_html__( 'See more', 'stock-toolkit' ),
    ), $atts));

    if($type == 1){
        $link_source = get_page_link($link_to_page);
    }else{
        $link_source = $external_link;
    }

    $stock_cta_desc_allowed_tags = array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ),
        'img' => array(
            'alt' => array(),
            'src' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array()
    );

    $stock_cta_markup = '
		<div class="stock-cta-box stock-cta-box-theme-'.esc_attr($theme).'" >
            <h2>'.esc_html($title).'</h2>
            '.wp_kses(wpautop($desc), $stock_cta_desc_allowed_tags).'
            
            <a href="'.esc_url($link_source).'" class="bordered-btn"> '.esc_html($link_text).'</a>
		</div>
	';

    $stock_cta_markup .= '';

    return $stock_cta_markup;
}
add_shortcode('stock_cta', 'stock_cta_shortcode');