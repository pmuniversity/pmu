<?php

namespace PMU\Repositories;

use PMU\Models\ {
	Level, 
	Topic
};

class TopicRepository extends BaseRepository {
	
	/**
	 * Create a new TopicRepository instance.
	 *
	 * @param App\Models\Post $post        	
	 *
	 * @return void
	 */
	public function __construct(Topic $topic) {
		$this->model = $topic;
	}
	
	/**
	 * Get topic collection.
	 *
	 * @param int $n        	
	 * @param int $levelId        	
	 * @param string $orderby        	
	 * @param string $direction        	
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function indexByLevel($levelId) {
		return $this->model->where ( 'level_id', $levelId )->select ( 'id', 'title', 'slug', 'level_title as levelTitle', 'picture' )->latest ()->get ();
	}
	public function show($slug) {
		return $this->model->whereSlug ( $slug )->select ( 'id', 'title', 'description', 'slug', 'level_title as levelTitle', 'picture' )->firstOrFail ();
	}
}
