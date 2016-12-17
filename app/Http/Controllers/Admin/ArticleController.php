<?php

namespace PMU\Http\Controllers\Admin;

use PMU\Http\Controllers\Controller;
use PMU\Http\Requests\ArticleRequest;
use PMU\Models\ {
	Article
};
use PMU\Repositories\ArticleRepository;
use Auth, DB;
use Illuminate\Http\Request;
use PMU\Traits\FileUploadTrait;

class ArticleController extends Controller {
	use FileUploadTrait;
	/**
	 * Illuminate\Http\Request.
	 *
	 * @var request
	 */
	protected $request;
	
	/**
	 * The ArticleRepository instance.
	 *
	 * @var App\Repositories\ArticleRepository
	 */
	protected $articleGestion;
	private $topicId;
	
	/**
	 * Set preferences.
	 *
	 * ArticleController constructor.
	 *
	 * @param Request $request        	
	 */
	public function __construct(Request $request, ArticleRepository $articleRepo) {
		$this->request = $request;
		$this->articleGestion = $articleRepo;
	}
	public function index() {
		return view ( 'admin.articles.index', [ 
				'pageTitle' => 'Articles',
				'topicId' => $this->request->input ( 'topicId' ) 
		] );
	}
	
	/**
	 * Display a listing users.
	 *
	 * @param \App\Repositories\RoleRepository $roleRepository        	
	 * @param string $role        	
	 * @return \Illuminate\Http\Response
	 */
	public function ajaxIndex() {
		/* Useful $_POST Variables coming from the plugin */
		$draw = $this->request->input ( 'draw' ); // counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
		$order = $this->request->input ( 'order' );
		$orderByColumnIndex = $order [0] ['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
		$columns = $this->request->input ( 'columns' );
		$orderBy = $columns [$orderByColumnIndex] ['data']; // Get name of the sorting column from its index
		$orderType = $order [0] ['dir']; // ASC or DESC
		$offset = $this->request->input ( 'start' ); // Paging first record indicator.
		$limit = $this->request->input ( 'length' ); // Number of records that the table can display in the current draw
		/* END of POST variables */
		
		$topicId = $this->request->input ( 'topicId' );
		
		$recordsTotal = $this->articleGestion->count ( $topicId );
		
		/* SEARCH CASE : Filtered data */
		if (! empty ( $this->request->input ( 'search.value' ) )) {
			/* WHERE Clause for searching */
			for($i = 0; $i < count ( $columns ); $i ++) {
				if ($columns [$i] ['searchable'] === 'true') {
					$column = $columns [$i] ['data']; // we get the name of each column using its index from POST request
					$where [] = "$column like '%" . $this->request->input ( 'search.value' ) . "%'";
				}
			}
			$where = "WHERE (" . implode ( " OR ", $where ) . ') AND topic_id = ' . $topicId; // id like '%searchValue%' or name like '%searchValue%' ....
			/* End WHERE */
			$sql = sprintf ( 'SELECT * FROM ' . env ( 'DB_PREFIX' ) . 'articles %s', $where ); // Search query without limit clause (No pagination)
			
			$recordsFiltered = count ( DB::select ( DB::raw ( $sql ) ) ); // Count of search result
			
			/* SQL Query for search with limit and orderBy clauses */
			$sql = sprintf ( 'SELECT id,topic_id, title, type_title, source_url, created_at FROM ' . env ( 'DB_PREFIX' ) . 'articles %s ORDER BY %s %s limit %d , %d ', $where, $orderBy, $orderType, $offset, $limit );
			$articles = DB::select ( DB::raw ( $sql ) );
		}  /* END SEARCH */
else {
			$recordsFiltered = $recordsTotal;
			$articles = Article::select ( 'id', 'topic_id', 'title', 'type_title', 'source_url', 'created_at' )->where ( 'topic_id', $topicId )->orderBy ( $orderBy, $orderType )->offset ( $offset )->limit ( $limit )->get ();
		}
		$data = [ ];
		foreach ( $articles as $article ) {
			$deleteBtn = '<form action="/admin/articles/' . $article->id . '" method="POST" style="display: inline">
								<input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="_token" value="' . csrf_token () . '">
								<button type="submit" class="btn btn-icon icon-bin" style="background-color:transparent">
								</button>
							</form>';
			$data [] = [ 
					'id' => $article->id,
					'topic_id' => $article->topic_id,
					'title' => str_limit ( $article->title, 30 ),
					'type_title' => ucfirst ( $article->type_title ),
					'created_at' => date ( 'M j, Y', strtotime ( $article->created_at ) ),
					'action' => "<span class='text-center'> <a href='/admin/articles/" . $article->id . "/edit' style='color:inherit'><i class='icon-pencil3'></i></a> " . $deleteBtn . '</span>' 
			];
		}
		
		/* Response to client before JSON encoding */
		$response = array (
				"draw" => intval ( $draw ),
				"recordsTotal" => $recordsTotal,
				"recordsFiltered" => $recordsFiltered,
				"data" => $data 
		);
		return response ()->json ( $response );
	}
	public function create() {
		return view ( 'admin.articles.create', [ 
				'pageTitle' => 'Add an article',
				'topicId' => $this->request->input ( 'topicId' ) 
		] );
	}
	public function store(ArticleRequest $request) {
		$topicId = $this->request->input ( 'topic_id' );
		$redirectUrl = 'admin/articles/create?topicId=' . $topicId;
		$message = trans ( 'errors.something_went_wrong' );
		$errorLevel = 'danger';
		try {
			$filePath = '';
			if ($request->hasFile ( 'file_path' )) {
				$result = $this->saveFiles ( $request );
				$filePath = $result->input ( 'file_path' );
			}
			$inputs = array_merge ( $request->all (), [ 
					'file_path' => $filePath 
			] );
			$topic = $this->articleGestion->store ( $inputs, Auth::user ()->id );
			
			flash ()->overlay ( trans ( 'messages.article_created_success' ), trans ( 'messages.success' ) )->important ();
			
			return redirect ( 'admin/articles?topicId=' . $topicId );
		} catch ( QueryException $e ) {
			$message .= ' ' . $e->getMessage ();
		} catch ( \ErrorException $e ) {
			$message .= ' ' . $e->getMessage ();
		}
		
		flash ( $message, $errorLevel )->important ();
		
		return redirect ( $redirectUrl )->withInput ();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$message = trans ( 'messages.article_deleted_success' );
		$level = 'danger';
		try {
			$article = Article::findOrFail ( $id );
			Article::destroy ( $id );
			$level = 'success';
			flash ()->overlay ( $message, trans ( 'messages.success' ) )->important ();
			return redirect ( 'admin/articles?topicId=' . $article->topic_id );
		} catch ( ModelNotFoundException $e ) {
			$message = trans ( 'errors.resource_not_found' );
		} catch ( QueryException $e ) {
			$message = trans ( 'errors.something_went_wrong' );
		}
		flash ()->overlay ( $message, 'Danger' )->important ();
		return redirect ( 'admin/articles?topicId=' . $article->topic_id );
	}
}
