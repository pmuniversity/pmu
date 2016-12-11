<?php

namespace PMU\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
	
	/**
	 * Get next record
	 */
	public function nextRecord() {
		return $this->where ( 'id', '<', $this->id )->max ( 'id' );
	}
	
	/**
	 * * Get previous record
	 */
	public function previousRecord() {
		return $this->where ( 'id', '>', $this->id )->min ( 'id' );
	}
	
	/**
	 * Get next record
	 */
	public static function findNext($id) {
		return static::where ( 'id', '>', $id )->first ();
	}
	
	/**
	 * Get previous record
	 */
	public static function findPrevious($id) {
		return static::where ( 'id', '<', $id )->first ();
	}
}
