<?php
if (!function_exists('them_style')) {
    function them_style()
    {

        wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
        wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
        wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
    }
}

add_action('wp_enqueue_scripts', 'them_style');

if (!function_exists('mytheme_register_nav_menu')) {

    function mytheme_register_nav_menu()
    {
        register_nav_menus(array(
            'primary_menu' => __('Menu chinh cua trang', 'university'),
            'footer_menu_1' => __('Menu footer vi tri 1', 'university'),
            'footer_menu_2' => __('Menu footer vi tri 2', 'university'),
        ));
    }
    add_action('after_setup_theme', 'mytheme_register_nav_menu', 0);
}
