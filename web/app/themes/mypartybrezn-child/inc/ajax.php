<?php
add_action('wp_enqueue_scripts', 'enqueue_script');

function enqueue_script()
{
    wp_enqueue_script('mypartybrezn', get_stylesheet_directory_uri() . '/assets/js/mypartybrezn.js', array('jquery'), '1.0.0');

    wp_localize_script(
        'mypartybrezn',
        'variables',
        array(
            'ajax_url' => admin_url('admin-ajax.php')
        )
    );
}
