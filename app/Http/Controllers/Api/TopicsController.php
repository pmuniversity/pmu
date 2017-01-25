<?php

namespace PMU\Http\Controllers\Api;

use Illuminate\Http\Request;
use PMU\Repositories\ {
	TopicRepository, 
	ArticleRepository
};
use PMU\Traits\ApiControllerTrait;
use PMU\Http\Controllers\Controller;
use Cache;
use PMU\Models\ {
	Level, 
	Article, 
	Topic
};
use Illuminate\Database\ {
	Eloquent\ModelNotFoundException, 
	QueryException
};

class TopicsController extends Controller {
	use ApiControllerTrait;
	/**
	 * Illuminate\Http\Request.
	 *
	 * @var request
	 */
	protected $request;
	
	/**
	 * The TopicRepository instance.
	 *
	 * @var App\Repositories\TopicRepository
	 */
	protected $topicGestion;
	/**
	 * The ArticleRepository instance.
	 *
	 * @var App\Repositories\ArticleRepository
	 */
	protected $articleGestion;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request, TopicRepository $topicRepo, ArticleRepository $articleRepo) {
		$this->request = $request;
		$this->topicGestion = $topicRepo;
		$this->articleGestion = $articleRepo;
	}
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($levelSlug) {
		try {
			$level = Level::whereSlug ( $levelSlug )->first ();
			$levelId = $level->id;
			$topics = Cache::remember ( $level->slug . '_topics', env ( 'CACHE_DEFAULT_EXPIRE_TIME' ), function () use ($levelId) {
				return $this->topicGestion->indexByLevel ( $levelId );
			} );
			foreach ( $topics as $topic ) {
				$topic->slug = $topic->slug;
				$topic->picture = $topic->picture ? url ( 'images/web/icons/' . $topic->picture ) : '';
			}
			$data = [ 
					'topics' => $topics 
			];
			return $this->respondWithSuccess ( 'success', $data );
		} catch ( ModelNotFoundException $e ) {
			return $this->respondNotFound ( trans ( 'Requested resource not found' ) );
		} catch ( QueryException $e ) {
			return $this->respondServerError ( trans ( 'Something went wrong' ) . $e->getMessage () );
		}
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug) {
		$topic = $this->topicGestion->show ( $slug );
		$articles = $this->articleGestion->index ( 15, $topic->id, 'latest' );
		$previousTopic = Topic::find ( $topic->nextRecord () );
		$nextTopic = Topic::find ( $topic->previousRecord () );
		
		return view ( 'topic_detail', compact ( 'topic', 'articles', 'nextTopic', 'previousTopic' ) );
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function indexArticles($type) {
		// Set pagination
		$perPage = $this->request->has ( 'perPage' ) ? $this->request->input ( 'perPage' ) : 5;
		$page = ( int ) $this->request->input ( 'page', 1 );
		
		$topicId = $this->request->input ( 'topicId' );
		
		$articles = $this->articleGestion->index ( $perPage, $topicId, $type );
		
		$formatArticles = [ ];
		
		if ($articles->total () === 0) {
			return $this->respondNotFound ( 'No records found' );
		}
		
		foreach ( $articles as $article ) {
			$formatArticles [] = $this->articleGestion->formatResponse ( $article );
		}
		
		$data ['pagination'] = customizePaginator ( $articles, $page );
		$data ['articles'] = $formatArticles;
		return $this->respondWithSuccess ( 'success', $data );
	}
	/**
	 *
	 * @param integer $articleId        	
	 */
	public function upvotes($articleId) {
		$article = $this->articleGestion->getById ( $articleId );
		$upvoteCnt = $article->upvotes_count + 1;
		Article::find ( $articleId )->increment ( 'upvotes_count' );
		return $this->respondWithSuccess ( 'success', [ 
				'count' => $upvoteCnt 
		] );
	}
}
