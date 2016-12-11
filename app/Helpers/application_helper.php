<?php

/*
 * |--------------------------------------------------------------------------
 * | IP address of the current user
 * |--------------------------------------------------------------------------
 * |
 */
if (! function_exists ( 'getUserIp' )) {
	function getUserIp($integer_format = true) {
		$ip_address = Request::ip ();
		
		return $integer_format ? ip2long ( $ip_address ) : $ip_address;
	}
}

/*
 * |--------------------------------------------------------------------------
 * | User agent (web browser) being used by the current user
 * |--------------------------------------------------------------------------
 * |
 */
if (! function_exists ( 'getUserAgent' )) {
	function getUserAgent() {
		return (! isset ( $_SERVER ['HTTP_USER_AGENT'] )) ? false : $_SERVER ['HTTP_USER_AGENT'];
	}
}

/*
 * Generate a globally unique identifier
 */
if (! function_exists ( 'generateGUID' )) {
	function generateGUID($opt = false) { // Set to true/false as your default way to do this.
		if (function_exists ( 'com_create_guid' )) {
			if ($opt) {
				return com_create_guid ();
			} else {
				return trim ( com_create_guid (), '{}' );
			}
		} else {
			mt_srand ( ( float ) microtime () * 10000 ); // optional for php 4.2.0 and up.
			$charid = strtoupper ( md5 ( uniqid ( rand (), true ) ) );
			$hyphen = chr ( 45 ); // "-"
			$left_curly = $opt ? chr ( 123 ) : ''; // "{"
			$right_curly = $opt ? chr ( 125 ) : ''; // "}"
			$uuid = $left_curly . substr ( $charid, 0, 8 ) . $hyphen . substr ( $charid, 8, 4 ) . $hyphen . substr ( $charid, 12, 4 ) . $hyphen . substr ( $charid, 16, 4 ) . $hyphen . substr ( $charid, 20, 12 ) . $right_curly;
			
			return $uuid;
		}
	}
}

if (! function_exists ( 'getTitleViaLink' )) {
	function getTitleViaLink($url) {
		$pageTitle = '';
		$str = file_get_contents ( $url );
		if (strlen ( $str ) > 0) {
			$str = trim ( preg_replace ( '/\s+/', ' ', $str ) ); // supports line breaks inside <title>
			preg_match ( "/\<title\>(.*)\<\/title\>/i", $str, $title ); // ignore case
			$pageTitle = $title [1];
		}
		
		return $pageTitle;
	}
}

/*
 * Generate unique file name
 */
if (! function_exists ( 'generateFileName' )) {
	
	/**
	 * Return the custom name for uploaded file.
	 *
	 * @param
	 *        	$id
	 * @param string $moduleName        	
	 *
	 * @return string
	 */
	function generateFileName($fileExtension) {
		return time () . '-' . uniqid () . '.' . $fileExtension;
	}
}

if (! function_exists ( 'classActivePath' )) {
	function classActivePath($path) {
		return Request::is ( $path ) ? ' class="active"' : '';
	}
}
if (! function_exists ( 'classActiveTopic' )) {
	function classActiveTopic($topicId) {
		return $topicId == 1 ? 'active ' : '';
	}
}
/*
 * Render HTML helper block
 */
if (! function_exists ( 'classHelperBlock' )) {
	function classHelperBlock($errors, $name) {
		if ($errors->has ( $name )) {
			return '<span class="help-block">' . $errors->first ( $name ) . '</span>';
		}
	}
}
/*
 * Render HTML 'has-error' class
 */
if (! function_exists ( 'classHasError' )) {
	function classHasError($errors, $name, $class = 'has-error') {
		if ($errors->has ( $name )) {
			return $class;
		}
		
		return '';
	}
}
/*
 * Render HTML 'has-error' class
 */
if (! function_exists ( 'classControlLabel' )) {
	function classControlLabel($errors, $name, $class = 'has-error') {
		if ($errors->has ( $name )) {
			return [ 
					'class' => 'control-label' 
			];
		}
		
		return [ ];
	}
}

/**
 * Get video type( Youtube/Vimeo)
 */
if (! function_exists ( 'getVideoType' )) {
	function getVideoType($url = NULL) {
		$returnValue = preg_match ( '/youtu\.be/i', $url ) || preg_match ( '/youtube\.com\/watch/i', $url ) ? 'youtube' : 0;
		
		if (! $returnValue) {
			$returnValue = preg_match ( '/vimeo\.com/i', $url ) ? 'vimeo' : 0;
		}
		return $returnValue;
	}
}
/**
 * Parse Youtube video and get the video id
 */
if (! function_exists ( 'getYoutubeVideoId' )) {
	function getYoutubeVideoId($link) {
		$regexstr = '~
		# Match Youtube link and embed code
		(?:                             # Group to match embed codes
		    (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
		    |(?:                        # Group to match if older embed
			(?:<object .*>)?      # Match opening Object tag
			(?:<param .*</param>)*  # Match all param tags
			(?:<embed [^>]*src=")?  # Match embed tag to the first quote of src
		    )?                          # End older embed code group
		)?                              # End embed code groups
		(?:                             # Group youtube url
		    https?:\/\/                 # Either http or https
		    (?:[\w]+\.)*                # Optional subdomains
		    (?:                         # Group host alternatives.
		    youtu\.be/                  # Either youtu.be,
		    | youtube\.com              # or youtube.com
		    | youtube-nocookie\.com     # or youtube-nocookie.com
		    )                           # End Host Group
		    (?:\S*[^\w\-\s])?           # Extra stuff up to VIDEO_ID
		    ([\w\-]{11})                # $1: VIDEO_ID is numeric
		    [^\s]*                      # Not a space
		)                               # End group
		"?                              # Match end quote if part of src
		(?:[^>]*>)?                       # Match any extra stuff up to close brace
		(?:                             # Group to match last embed code
		    </iframe>                 # Match the end of the iframe
		    |</embed></object>          # or Match the end of the older embed
		)?                              # End Group of last bit of embed code
		~ix';
		preg_match ( $regexstr, $link, $matches );
		return $matches [1];
	}
}
/**
 * Parse Vimeo video and get the video id
 */
if (! function_exists ( 'getVimeoVideoId' )) {
	function getVimeoVideoId($link) {
		$regexstr = '~
            # Match Vimeo link and embed code
            (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
            (?:                         # Group vimeo url
                https?:\/\/             # Either http or https
                (?:[\w]+\.)*            # Optional subdomains
                vimeo\.com              # Match vimeo.com
                (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
                \/                      # Slash before Id
                ([0-9]+)                # $1: VIDEO_ID is numeric
                [^\s]*                  # Not a space
            )                           # End group
            "?                          # Match end quote if part of src
            (?:[^>]*></iframe>)?        # Match the end of the iframe
            (?:<p>.*</p>)?              # Match any title information stuff
            ~ix';
		preg_match ( $regexstr, $link, $matches );
		return $matches [1];
	}
}
/**
 * Validate Youtube video
 */
if (! function_exists ( 'getVimeoVideoId' )) {
	function validateYoutubeId($videoId) {
		$headers = get_headers ( 'http://gdata.youtube.com/feeds/api/videos/' . $video_id );
		if (! strpos ( $headers [0], '200' )) {
			// echo "The YouTube video you entered does not exist";
			return FALSE;
		}
		return TRUE;
	}
}
if (! function_exists ( 'getVideoThumnail' )) {
	function getVideoThumnail($videoId, $videoType = 'youtube') {
		$thumnail = FALSE;
		if ($videoType === 'youtube') {
			$thumnail = "http://img.youtube.com/vi/" . $videoId . "/0.jpg";
		} else {
			$hash = unserialize ( @file_get_contents ( "http://vimeo.com/api/v2/video/" . $videoId . ".php" ) );
			if ($hash && isset ( $hash [0] ) && isset ( $hash [0] ['thumbnail_large'] )) {
				$thumnail = $hash [0] ["thumbnail_large"];
			}
		}
		return $thumnail;
	}
}
/**
 * Get the video embed code
 */
if (! function_exists ( 'getVideoEmbedCode' )) {
	function getVideoEmbedCode($videoId, $videoType = 'youtube') {
		$embedCode = FALSE;
		if ($videoType === 'youtube') {
			$embedCode = '<object width="100%" height="400">
			<param name="movie" value="http://www.youtube.com/v/' . $videoId . '?version=3&amp;hl=en_US&amp;rel=0">
			</param>
			<param name="allowFullScreen" value="true"></param>
			<param name="wmode" value="transparent"></param>
			<param name="allowscriptaccess" value="always"></param>
			<embed src="http://www.youtube.com/v/' . $videoId . '?version=3&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" width="100%" height="400" wmode="transparent" allowscriptaccess="always" allowfullscreen="true"></embed>
		</object>';
		} elseif ($videoType === 'vimeo') {
			$embedCode = '<object width="100%" height="400">
				<param name="allowfullscreen" value="true" />
				<param name="allowscriptaccess" value="always" />
				<param name="wmode" value="transparent"></param>
				<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=' . $videoId . '&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=#00adef&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" />
				<embed src="http://vimeo.com/moogaloop.swf?clip_id=' . $videoId . '&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=#00adef&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="100%" height="400" wmode="transparent"></embed>
			</object>';
		}
		return $embedCode;
	}
}

if (! function_exists ( 'words' )) {
	/**
	 * Limit the number of words in a string.
	 *
	 * @param string $value        	
	 * @param int $words        	
	 * @param string $end        	
	 * @return string
	 */
	function words($value, $words = 100, $end = '...') {
		return \Illuminate\Support\Str::words ( $value, $words, $end );
	}
}
/**
 * Medium-like estimated reading time
 */
if (! function_exists ( 'articleReadTime' )) {
	function articleReadTime($text) {
		$words = str_word_count ( strip_tags ( $text ) );
		$min = floor ( $words / 200 );
		if ($min === 0) {
			return '1 min read';
		}
		return $min . 'min read';
	}
}
/**
 * Customize pagination attributes
 */
if (! function_exists ( 'customizePaginator' )) {
	function customizePaginator($collection, $page) {
		return [ 
				'total' => $collection->total (),
				'currentPage' => $collection->currentPage (),
				'perPage' => $collection->perPage (),
				'hasMore' => $collection->hasMorePages () 
		];
	}
}
