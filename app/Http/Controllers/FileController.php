<?php

namespace PMU\Http\Controllers;

use Illuminate\Http\Request;
use PMU\Traits\ {
	FileUploadTrait, 
	ApiControllerTrait
};
use PMU\Models\ {
	File
};
use Validator;
use Illuminate\Database\ {
	QueryException
};

class FileController extends Controller {
	use ApiControllerTrait,
    FileUploadTrait;
	
	/**
	 * Illuminate\Http\Request
	 *
	 * @var request
	 */
	protected $request;
	
	/**
	 * Set preferences
	 *
	 * UsersController constructor.
	 *
	 * @param Request $request        	
	 * @param CategoryRepository $categoryRepo        	
	 */
	public function __construct(Request $request) {
		$this->request = $request;
	}
	public function store() {
		$validator = Validator::make ( $this->request->all (), [ 
				'module' => 'sometimes|exists:modules,title' 
		] );
		$validator->after ( function ($validator) {
			$i = 0;
			foreach ( $this->request->all () as $key => $value ) {
				if ($this->request->hasFile ( $key )) {
					$i ++;
				}
			}
			if ($i === 0) {
				$validator->errors ()->add ( 'file', trans ( 'errors.no_image_uploaded' ) );
			}
		} );
		// Validation fail
		if ($validator->fails ()) {
			$errors = formatValidationMessages ( $validator->errors () );
			return $this->respondWithValidationError ( trans ( 'errors.validation_failed' ), $errors );
		}
		try {
			$result = $this->saveFiles ( $this->request );
			$inputs = $result->all ();
			$uri = '';
			foreach ( $inputs as $input ) {
				$uri = $input;
			}
			return response ()->json ( [ 
					'uploaded' => 1,
					'fileName' => $uri,
					'url' => '/uploads/topics/original/' . $uri 
			] );
			return $this->respondCreated ( trans ( 'messages.image_uploaded_success' ) );
		} catch ( QueryException $e ) {
			return $this->respondServerError ( trans ( 'errors.something_went_wrong' ) );
		} catch ( \Exception $e ) {
			return $this->respondWithValidationError ( trans ( 'validation.custom.file.image' ) );
		}
	}
}
