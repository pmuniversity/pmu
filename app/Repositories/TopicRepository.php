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
	/**
	 * Count the users for a role.
	 *
	 * @param string $role        	
	 * @return int
	 */
	public function count($levelId = null) {
		if ($levelId) {
			return $this->model->where ( 'level_id', $levelId )->count ();
		}
		return $this->model->count ();
	}
	
	/**
	 * Create a topic.
	 *
	 * @param array $inputs        	
	 * @param int $user_id        	
	 *
	 * @return void
	 */
	public function store($inputs, $userId) {
		$topic = $this->saveTopic ( new $this->model (), $inputs, $userId );
		
		return $topic;
	}
	
	/**
	 * Create or update a topic.
	 *
	 * @param App\Models\Topic $topic        	
	 * @param array $inputs        	
	 * @param bool $user_id        	
	 *
	 * @return App\Models\Topic
	 */
	public function saveTopic($topic, $inputs, $userId = null) {
		$topic->level_id = ( int ) $inputs ['level_id'];
		$topic->level_title = $inputs ['level_title'];
		$topic->title = ucwords ( strtolower ( $inputs ['title'] ) );
		$topic->description = ucwords ( $inputs ['description'] );
		$topic->picture = $inputs ['picture'] ?? null;
		$topic->author_name = isset ( $inputs ['author_name'] ) ? ucwords ( strtolower ( $inputs ['author_name'] ) ) : null;
		$topic->author_location = isset ( $inputs ['author_location'] ) ? ucwords ( strtolower ( $inputs ['author_location'] ) ) : null;
		$topic->author_office = isset ( $inputs ['author_office'] ) ? ucwords ( strtolower ( $inputs ['author_office'] ) ) : null;
		$topic->author_designation = isset ( $inputs ['author_designation'] ) ? ucwords ( strtolower ( $inputs ['author_designation'] ) ) : null;
		$topic->author_picture = isset ( $inputs ['author_picture'] ) ? ucwords ( strtolower ( $inputs ['author_picture'] ) ) : null;
		$topic->h1 = isset ( $inputs ['h1'] ) ? ucfirst ( $inputs ['h1'] ) : null;
		$topic->meta_title = $inputs ['meta_title'] ?? null;
		$topic->meta_description = $inputs ['meta_description'] ?? null;
		$topic->meta_keywords = $inputs ['meta_keywords'] ?? null;
		$topic->slug = $this->generateSlug ( $topic, $inputs ['title'] );
		$topic->active = $inputs ['active'] ?? 1;
		$topic->read_time = articleReadTime ( $inputs ['title'] );
		if ($userId) {
			$topic->author_id = $userId;
		}
		$topic->save ();
		
		return $topic;
	}
}
