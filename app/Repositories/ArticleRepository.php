<?php

namespace PMU\Repositories;

use PMU\Models\Article;

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
	 * Create a query for Article.
	 *
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	private function queryActiveOrderByDate($topicId, $type, $orderBy = 'created_at', $sort = 'desc') {
		$query = $this->model->select ( 'id', 'created_at as postedOn', 'updated_at', 'title', 'source_url as sourceUrl', 'author_id as authorId', 'description', 'sequence', 'file_path', 'type_title as articleType', 'author_name as authorName', 'author_location as authorLocation', 'author_office as authorOffice', 'author_designation as authorDesignation', 'upvotes_count as upvoteCount' )->where ( 'topic_id', $topicId );
		if ($type === 'top-10' or $type === 'latest') {
			return $query->orderBy ( $orderBy, $sort );
		}
		return $query->where ( 'type_title', $type )->orderBy ( $orderBy, $sort );
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
			$query = $this->queryActiveOrderByDate ( $topicId, $type, 'sequence' );
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
		if ($article->articleType === 'videos') 

		{
			if (getVideoType ( $article->file_path ) === 'youtube') {
				$article->videoSrc = 'https://www.youtube.com/embed/' . getYoutubeVideoId ( $article->file_path ) . '?rel=0&amp;controls=0&amp;showinfo=0';
			}
		}
		$articleFormat ['title'] = $article->title;
		$article ['image'] = $article->file_path && $article->articleType !== 'videos' ? url ( '/images/web/' . $article->file_path ) : '';
		return $articleFormat;
	}
}
