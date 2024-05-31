<?php

// config for Marcha/Image2
return [
	/**
	 * the image worker, must be "Gd" or "Imagick"
	 */
	'worker' => 'Gd',

	'route' => '/_img',

	/**
	 * note this is the server path to the file
	 * from base_path()
	 */
	'js_path' => '/public/js/Imagecow.js',

	/**
	 * various $_GET variables
	 */
	'vars' =>  [
		'image'           => 'img',
		'responsive_flag' => 'responsive',
		'transform'       => 'transform'
    ],

	'cache' => [
		'lifetime' => 1,
		'path'     => 'images' // /app/storage/cache/{images}
    ]
];
