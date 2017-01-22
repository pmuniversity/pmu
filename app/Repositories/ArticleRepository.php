<?php

namespace PMU\Repositories;

use PMU\Models\Article;
use Storage;

class ArticleRepository extends BaseRepository {
	
	/**
	 * Create a new ArticleRepository instance.
	 *
	 * @param Article $article        	
	 */
	public function __construct(Article $article) {
		$this->model = $article;
	}
	
	/**
	 * Count the users for a role.
	 *
	 * @param string $role        	
	 * @return int
	 */
	public function count($topicId = null) {
		return $this->model->where ( 'topic_id', $topicId )->count ();
	}
	
	/**
	 * Create a query for Article.
	 *
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	private function queryActiveOrderByDate($topicId, $type, $orderBy = 'created_at', $sort = 'desc') {
		$query = $this->model->select ( 'id', 'created_at as postedOn', 'updated_at', 'title', 'source_url as sourceUrl', 'author_id as authorId', 'description', 'top10_order', 'file_path', 'video_url as videoUrl', 'type_title as articleType', 'author_name as authorName', 'author_location as authorLocation', 'author_organization as authorOffice', 'author_designation as authorDesignation', 'upvotes_count as upvoteCount' )->where ( 'topic_id', $topicId );
		if ($type === 'top-10' or $type === 'latest') {
			return $query->orderBy ( $orderBy, $sort );
		}
		return $query->where ( 'type_title', $type )->orderBy ( $orderBy, $sort );
	}
	private function queryActiveOrderByLatest($topicId, $type, $orderBy = 'latest_order', $sort = 'desc') {
		$query = $this->model->select ( 'id', 'created_at as postedOn', 'updated_at', 'title', 'source_url as sourceUrl', 'author_id as authorId', 'description', 'top10_order', 'file_path', 'video_url as videoUrl', 'type_title as articleType', 'author_name as authorName', 'author_location as authorLocation', 'author_organization as authorOffice', 'author_designation as authorDesignation', 'upvotes_count as upvoteCount' )->where ( 'topic_id', $topicId );
		
		return $query->orderBy ( $orderBy, $sort );
	}
	private function queryActiveOrderByTop($topicId, $type, $orderBy = 'top10_order', $sort = 'desc') {
		$query = $this->model->select ( 'id', 'created_at as postedOn', 'updated_at', 'title', 'source_url as sourceUrl', 'author_id as authorId', 'description', 'top10_order', 'file_path', 'video_url as videoUrl', 'type_title as articleType', 'author_name as authorName', 'author_location as authorLocation', 'author_organization as authorOffice', 'author_designation as authorDesignation', 'upvotes_count as upvoteCount' )->where ( 'topic_id', $topicId );
		
		return $query->orderBy ( $orderBy, $sort );
	}
	
	/**
	 * Get post collection.
	 *
	 * @param int $n        	
	 * @param int $id        	
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function indexBytype($n, $topicId, $type = 'top-ten') {
		if ($type === 'top-10') {
			$query = $this->queryActiveOrderByTop ( $topicId, $type, 'top10_order' );
		} elseif ($type === 'latest') {
			$query = $this->queryActiveOrderByLatest ( $topicId, $type );
		} else {
			$query = $this->queryActiveOrderByDate ( $topicId, $type );
		}
		
		return $query->paginate ( $n );
	}
	
	/**
	 * Get post collection.
	 *
	 * @param int $n        	
	 * @param int $id        	
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function index($n, $topicId, $type = 'top-ten') {
		if ($type === 'top-10') {
			$query = $this->queryActiveOrderByDate ( $topicId, $type, 'top10_order' );
		} elseif ($type === 'latest') {
			$query = $this->queryActiveOrderByDate ( $topicId, $type );
		} else {
			$query = $this->queryActiveOrderByDate ( $topicId, $type );
		}
		
		return $query->paginate ( $n );
	}
	
	/**
	 * Fotmat voteup resopnse
	 */
	public function formatResponse($article) {
		if ($article->articleType === 'videos') {
			if (getVideoType ( $article->videoUrl ) === 'youtube') {
				$article->videoSrc = 'https://www.youtube.com/embed/' . getYoutubeVideoId ( $article->videoUrl ) . '?rel=0&amp;controls=0&amp;showinfo=0';
			}
		}
		$article->file_path = $article->file_path && $article->articleType !== 'videos' ? Storage::url ( $article->file_path ) : '';
		return $article;
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
		$article = $this->saveArticle ( new $this->model (), $inputs, $userId );
		
		return $article;
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
	public function saveArticle($article, $inputs, $userId = null) {
		$article->topic_id = ( int ) $inputs ['topic_id'];
		$article->source_url = $inputs ['source_url'] ?? null;
		$article->type_title = $inputs ['type_title'];
		$article->title = ucwords ( strtolower ( $inputs ['title'] ) );
		$article->description = ucwords ( $inputs ['description'] );
		if (isset ( $inputs ['file_path'] )) {
			$article->file_path = $inputs ['file_path'] ?? null;
		}
		$article->video_url = $inputs ['video_url'] ?? null;
		$article->author_name = isset ( $inputs ['author_name'] ) ? ucwords ( strtolower ( $inputs ['author_name'] ) ) : null;
		$article->author_location = isset ( $inputs ['author_location'] ) ? ucwords ( strtolower ( $inputs ['author_location'] ) ) : null;
		$article->author_organization = isset ( $inputs ['author_organization'] ) ? ucwords ( strtolower ( $inputs ['author_organization'] ) ) : null;
		$article->author_designation = isset ( $inputs ['author_designation'] ) ? ucwords ( strtolower ( $inputs ['author_designation'] ) ) : null;
		$article->author_picture = isset ( $inputs ['author_picture'] ) ? ucwords ( strtolower ( $inputs ['author_picture'] ) ) : null;
		
		$article->active = $inputs ['active'] ?? 1;
		if ($userId) {
			$article->author_id = $userId;
		}
		$article->save ();
		
		return $article;
	}
}
