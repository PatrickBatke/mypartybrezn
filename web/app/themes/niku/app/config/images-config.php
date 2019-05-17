<?php

return array(

    /**
     * Edit this file in order to configure the additional
     * image sizes your application need.
     * @link http://codex.wordpress.org/Function_Reference/add_image_size
     *
     * @key string The size name.
     * @param int $width The image width.
     * @param int $height The image height.
     * @param bool|array $crop Crop option. Since 3.9, define a crop position with an array.
     * @param bool $media Add to media selection dropdown. Make it also available to media custom field.
     */
    'small'             => array( 80, 80, true ),
    'menu_small'        => array( 60, 60, true ),
    'blog_thumbnail'    => array( 850, 567, true ),
    'random_thumbnail'  => array( 300, 300, true ),
    'related_thumbnail'  => array( 300, 250, true ),


);