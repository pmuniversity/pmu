<?php
return [		
		// Google Analytics
		'google' => [ 
				'id' => env ( 'GOOGLE_ANALYTICS_ID', 'Google-Analytics-ID' ),
				'open' => env ( 'GOOGLE_OPEN' ) ?: false 
		] 
];