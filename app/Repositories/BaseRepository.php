<?php

namespace PMU\Repositories;

use PMU\Traits\Sluggable;
use Cache;

abstract class BaseRepository {
	use Sluggable;
	
	/**
	 * The Model instance.
	 *
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $model;
	
	/**
	 * Get number of records.
	 *
	 * @return array
	 */
	public function getNumber() {
		$total = $this->model->count ();
		
		$new = $this->model->whereSeen ( 0 )->count ();
		
		return compact ( 'total', 'new' );
	}
	
	/**
	 * Destroy a model.
	 *
	 * @param int $id        	
	 *
	 * @return void
	 */
	public function destroy($id) {
		$this->getById ( $id )->delete ();
	}
	
	/**
	 * Get Model by id.
	 *
	 * @param int $id        	
	 *
	 * @return App\Models\Model
	 */
	public function getById($id) {
		return $this->model->findOrFail ( $id );
	}
	
	/**
	 * Get max id.
	 *
	 * @return type
	 */
	public function getMaxValue($columnName = 'id') {
		return $this->model->max ( $columnName );
	}
	/**
	 * Get the DB drive name
	 *
	 * @return mixed null|mysql|pgsql
	 */
	public function getConnectionName() {
		return $this->model->getConnection ()->getConfig ( 'driver' );
	}
	
	/**
	 * Generate the unique cache key for the query.
	 *
	 * @return string
	 */
	public function generateCacheKey($queryBuilder) {
		return md5 ( $this->getConnectionName () . $queryBuilder->toSql () . serialize ( $queryBuilder->getBindings () ) );
	}
	
	/**
	 * Get the query from cache
	 *
	 * @param object $queryBuilder        	
	 * @param int $timeout        	
	 * @param string $fetchMethod
	 *        	get|first|last
	 * @return mixed
	 */
	
	/**
	 * Get the query from cache
	 *
	 * @param unknown $queryBuilder        	
	 * @param number $timeout        	
	 * @param string $fetchMethod        	
	 */
	public function cachePaginateResult($queryBuilder, $timeout = 15, $perPage = 15) {
		$cacheKey = $this->generateCacheKey ( $queryBuilder );
		return Cache::remember ( $cacheKey, $timeout, function () use ($queryBuilder, $perPage) {
			
			return $queryBuilder->paginate ( $perPage );
		} );
	}
	
	/**
	 * Update cache result
	 *
	 * @param string $cacheKey        	
	 * @param object $queryBuilder        	
	 * @param int $timeout        	
	 * @param string $fetchMethod
	 *        	get|first|last
	 */
	public function updatePaginateQueryCache($cacheKey, $queryBuilder, $timeout = 15, $perPage = 15) {
		$result = $queryBuilder->paginate ( $perPage );
		Cache::put ( $cacheKey, $result, $timeout );
	}
}
