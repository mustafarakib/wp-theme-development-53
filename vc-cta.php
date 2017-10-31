<?php

vc_map(array(
    "name" => esc_html__("Stock Call to Action", "stock-toolkit"),
    "base" => "stock_cta",
    "category" => esc_html__("Stock", "stock-toolkit"),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "stock-toolkit"),
            "param_name" => "title",
            "description" => esc_html__("", "stock-toolkit"),
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__("Content", "stock-toolkit"),
            "param_name" => "desc",
            "description" => esc_html__("", "stock-toolkit"),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Theme", "stock-toolkit"),
            "param_name" => "theme",
            "std" => esc_html__("1", "stock-toolkit"),
            "value" => array(
                esc_html__('General theme', 'stock-toolkit') => 1,
                esc_html__('Colored theme', 'stock-toolkit') => 2,
            )
        ),

        array(
            "type" => "dropdown",
            "heading" => esc_html__("Link Type", "stock-toolkit"),
            "param_name" => "type",
            "std" => esc_html__("1", "stock-toolkit"),
            "value" => array(
                'Link to page' => 1,
                'External link' => 2,
                esc_html__('Link to page', 'stock-toolkit') => 1,
                esc_html__('External link', 'stock-toolkit') => 2,
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Link to page", "stock-toolkit"),
            "param_name" => "link_to_page",
            "description" => esc_html__("", "stock-toolkit"),
            "value" => stock_toolkit_get_page_as_list(),
            "dependency" => array(
                 esc_html__("element", "stock-toolkit") => "type",
                 esc_html__("value", "stock-toolkit") => array("1"),
            )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("External Link", "stock-toolkit"),
            "param_name" => "external_link",
            "description" => esc_html__("", "stock-toolkit"),
            "dependency" => array(
                esc_html__("element", "stock-toolkit") => "type",
                esc_html__("value", "stock-toolkit") => array("2"),
            )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link Text", "stock-toolkit"),
            "param_name" => "link_text",
            "description" => esc_html__("", "stock-toolkit"),
            "std" => esc_html__("See more", "stock-toolkit"),
        ),
    )
));