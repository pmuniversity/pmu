<?php
return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',
		'allowed_formats' => [ 
				'gif',
				'png',
				'jpg',
				'jpeg',
				'bmp',
				'svg' 
		],
		'default_profile_pic_path' => 'uploads/default_profile_pics/Abul-Kalam-Azad.jpg',
		'storage_folders' => [ 
				'original',
				'medium',
				'thumbnail' 
		],
		'sizes' => [ 
				'thumbnail' => [ 
						'width' => 50,
						'height' => 50 
				],
				'medium' => [ 
						'width' => 480,
						'height' => 320 
				] 
		] 
);
