<?php

namespace PMU\Traits;

use Illuminate\Http\Request;
use Image;

trait FileUploadTrait {
	
	/**
	 * File upload trait used in controllers to upload files
	 */
	public function saveFiles(Request $request) {
		$moduleType = getModuleType ( $request );
		$basePath = 'uploads/' . $moduleType;
		foreach ( config ( 'image.storage_folders' ) as $type ) {
			if (! file_exists ( public_path ( $basePath . '/' . $type ) )) {
				mkdir ( public_path ( $basePath . '/' . $type ), 0777 );
			}
		}
		$mainFolder = $moduleType === 'users' ? 'avatars' : 'topics';
		$filesArr = [ ];
		foreach ( $request->all () as $key => $value ) {
			
			if ($request->hasFile ( $key )) {
				$file = $request->file ( $key );
				$fileName = generateFileName ( $file->getClientOriginalExtension () );
				
				// Image resizing
				if (config ( 'image.sizes' )) {
					foreach ( config ( 'image.sizes' ) as $dimensionType => $dimension ) {
						
						$image = Image::make ( $file );
						
						// Check file width
						$width = $image->width ();
						
						$height = $image->height ();
						
						if ($width > $dimension ['width'] && $height > $dimension ['height']) {
							
							$image->resize ( $dimension ['width'], $dimension ['height'] );
						} elseif ($width > $dimension ['width']) {
							
							$image->resize ( $dimension ['width'], null, function ($constraint) {
								
								$constraint->aspectRatio ();
							} );
						} elseif ($height > $dimension ['width']) {
							
							$image->resize ( null, $dimension ['height'], function ($constraint) {
								
								$constraint->aspectRatio ();
							} );
						}
						$absolutePath = public_path ( "$basePath/$dimensionType" ) . '/' . $fileName;
						
						$image->save ( $absolutePath );
						if (env ( 'FILESYSTEM_DRIVER' ) === 's3') {
							$this->saveToS3 ( $absolutePath, "$moduleType/$dimensionType/$fileName" );
						}
					}
				}
				// Save original image
				$request->file ( $key )->move ( public_path ( $basePath . '/' . 'original' ), $fileName );
				$filesArr [$key] = $fileName;
			}
		}
		return new Request ( array_merge ( $request->all (), $filesArr ) );
	}
}
