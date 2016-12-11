<?php

namespace PMU\Traits;

use Illuminate\Http\Response as IlluminateResponse;

trait ApiControllerTrait {
	
	/**
	 *
	 * @var int
	 */
	protected $statusCode = IlluminateResponse::HTTP_OK;
	
	/**
	 *
	 * @return mixed
	 */
	public function getStatusCode() {
		return $this->statusCode;
	}
	
	/**
	 *
	 * @param
	 *        	$statusCode
	 *        	
	 * @return $this
	 */
	public function setStatusCode($statusCode) {
		$this->statusCode = $statusCode;
		return $this;
	}
	
	/**
	 *
	 * @param string $message        	
	 * @return mixed
	 */
	public function respondNotFound($message = 'Requested resource not found') {
		return $this->setStatusCode ( IlluminateResponse::HTTP_NOT_FOUND )->respondWithError ( $message );
	}
	
	/**
	 *
	 * @param string $message        	
	 *
	 * @return mixed
	 */
	public function respondBadRequest($message = 'Bad Request') {
		return $this->setStatusCode ( IlluminateResponse::HTTP_BAD_REQUEST )->respondWithError ( $message );
	}
	
	/**
	 *
	 * @param string $message        	
	 * @return mixed
	 */
	public function respondServerError($message = 'Server Error') {
		return $this->setStatusCode ( IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR )->respondWithError ( $message );
	}
	
	/**
	 *
	 * @param string $message        	
	 *
	 * @return mixed
	 */
	public function respondConflict($message = 'Conflict') {
		return $this->setStatusCode ( IlluminateResponse::HTTP_CONFLICT )->respondWithError ( $message );
	}
	
	/**
	 *
	 * @param string $message        	
	 *
	 * @return mixed
	 */
	public function respondUnauthorized($message = 'Unauthorized') {
		return $this->setStatusCode ( IlluminateResponse::HTTP_UNAUTHORIZED )->respondWithError ( $message );
	}
	
	/**
	 *
	 * @param string $message        	
	 *
	 * @return mixed
	 */
	public function respondForbidden($message = 'Forbidden') {
		return $this->setStatusCode ( IlluminateResponse::HTTP_FORBIDDEN )->respondWithError ( $message );
	}
	
	/**
	 *
	 * @param
	 *        	$message
	 * @return mixed
	 */
	public function respondCreated($message, array $data = [], array $headers = []) {
		return $this->setStatusCode ( IlluminateResponse::HTTP_CREATED )->respondWithSuccess ( $message, $data, $headers );
	}
	
	/**
	 *
	 * @param
	 *        	$message
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondOk($message) {
		return $this->setStatusCode ( IlluminateResponse::HTTP_OK )->respondWithSuccess ( $message );
	}
	
	/**
	 *
	 * @param string $message        	
	 * @return mixed
	 */
	public function respondWithValidationError($message, array $data = []) {
		return $this->setStatusCode ( IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY )->respondWithError ( $message, $data );
	}
	
	/**
	 *
	 * @param string $message        	
	 * @return mixed
	 */
	public function respondWithNoContent($message, array $data = []) {
		return $this->setStatusCode ( IlluminateResponse::HTTP_NO_CONTENT )->respondWithSuccess ( $message, $data );
	}
	
	/**
	 *
	 * @param string $message        	
	 * @param mixed $data        	
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithSuccess($message, array $data = [], array $headers = []) {
		$response = [ 
				'httpCode' => $this->getStatusCode (),
				'success' => true,
				'message' => $message 
		];
		if (! empty ( $data )) {
			$response ['data'] = $data;
		}
		return $this->respond ( $response, $headers );
	}
	
	/**
	 *
	 * @param type $message        	
	 * @param array $data        	
	 * @param array $headers        	
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithError($message, array $data = [], array $headers = []) {
		$response = [ 
				'httpCode' => $this->getStatusCode (),
				'success' => false,
				'message' => $message 
		];
		
		if (! empty ( $data )) {
			$response ['data'] = $data;
		}
		return $this->respond ( $response, $headers );
	}
	
	/**
	 *
	 * @param
	 *        	$data
	 * @param array $headers        	
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respond($response, $headers = []) {
		return response ()->json ( $response, $this->getStatusCode (), $headers, JSON_NUMERIC_CHECK );
	}
	public function respondWithCORS($data) {
		return $this->respond ( $data, $this->setCORSHeaders () );
	}
	private function setCORSHeaders() {
		$header ['Access-Control-Allow-Origin'] = '*';
		$header ['Allow'] = 'GET, POST, OPTIONS';
		$header ['Access-Control-Allow-Headers'] = 'Origin, Content-Type, Accept, Authorization, X-Request-With';
		$header ['Access-Control-Allow-Credentials'] = 'true';
		return $header;
	}
}
