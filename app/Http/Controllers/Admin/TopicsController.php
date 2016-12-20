<?php

namespace PMU\Http\Controllers\Admin;

use PMU\Models\ {
	Topic, 
	Level
};
use Illuminate\Http\Request;
use PMU\Repositories\ {
	TopicRepository
};
use PMU\Traits\ {
	ApiControllerTrait, 
	FileUploadTrait
};
use PMU\Http\Controllers\Controller;
use DB, Auth;
use PMU\Http\Requests\TopicRequest;
use Image;

class TopicsController extends Controller {
	use ApiControllerTrait, FileUploadTrait;
	/**
	 * Illuminate\Http\Request
	 *
	 * @var request
	 */
	protected $request;
	/**
	 * The UserRepository instance.
	 *
	 * @var \App\Repositories\UserRepository
	 */
	protected $topicRepo;
	/**
	 * Create a new UserController instance.
	 *
	 * @param \App\Repositories\UserRepository $userRepository        	
	 *
	 * @return void
	 */
	public function __construct(Request $request, TopicRepository $topicRepo) {
		$this->request = $request;
		$this->topicRepo = $topicRepo;
	}
	public function index() {
		return view ( 'admin.topics.index', [ 
				'pageTitle' => 'Topics' 
		] );
	}
	public function indexByLevel($type) {
		$level = Level::whereSlug ( $type )->first ();
		return view ( 'admin.topics.index_by_level', [ 
				'pageTitle' => 'Topics',
				'level' => $level 
		] );
	}
	/**
	 * Display a listing users.
	 *
	 * @param \App\Repositories\RoleRepository $roleRepository        	
	 * @param string $role        	
	 * @return \Illuminate\Http\Response
	 */
	public function ajaxIndexByLevel() {
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
		$levelId = $this->request->input ( 'levelId' );
		$recordsTotal = $this->topicRepo->count ( $levelId );
		
		/* SEARCH CASE : Filtered data */
		if (! empty ( $this->request->input ( 'search.value' ) )) {
			/* WHERE Clause for searching */
			for($i = 0; $i < count ( $columns ); $i ++) {
				if ($columns [$i] ['searchable'] === 'true') {
					$column = $columns [$i] ['data']; // we get the name of each column using its index from POST request
					$where [] = "$column like '%" . $this->request->input ( 'search.value' ) . "%'";
				}
			}
			$where = "WHERE (" . implode ( " OR ", $where ) . ') AND level_id = ' . $levelId; // id like '%searchValue%' or name like '%searchValue%' ....
			/* End WHERE */
			$sql = sprintf ( 'SELECT * FROM ' . env ( 'DB_PREFIX' ) . 'topics %s', $where ); // Search query without limit clause (No pagination)
			
			$recordsFiltered = count ( DB::select ( DB::raw ( $sql ) ) ); // Count of search result
			
			/* SQL Query for search with limit and orderBy clauses */
			$sql = sprintf ( 'SELECT id, title,level_id, level_title, created_at, slug FROM ' . env ( 'DB_PREFIX' ) . 'topics %s ORDER BY %s %s limit %d , %d ', $where, $orderBy, $orderType, $offset, $limit );
			$topics = DB::select ( DB::raw ( $sql ) );
		}  /* END SEARCH */
else {
			$recordsFiltered = $recordsTotal;
			$topics = Topic::select ( 'id', 'title', 'level_title', 'level_id', 'created_at', 'slug' )->where ( 'level_id', $levelId )->orderBy ( $orderBy, $orderType )->offset ( $offset )->limit ( $limit )->get ();
		}
		$data = [ ];
		foreach ( $topics as $topic ) {
			$level = Level::findOrFail ( $topic->level_id );
			$deleteBtn = '<form action="/admin/topics/' . $topic->id . '" method="POST" style="display: inline">
								<input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="_token" value="' . csrf_token () . '">
								<button type="submit" class="btn btn-icon icon-bin" style="background-color:transparent">
								</button>
							</form>';
			$viewBtn = "<a target='_blank' href='/topics/" . $level->slug . "/" . $topic->slug . "' style='color:inherit'><i class='icon-eye2'></i></a> ";
			$editBtn = "<a href='/admin/topics/" . $topic->id . "/edit' style='color:inherit'><i class='icon-pencil3'></i></a>";
			$data [] = [ 
					'id' => $topic->id,
					'title' => $topic->title,
					'level_title' => $topic->level_title,
					'created_at' => date ( 'M j, Y', strtotime ( $topic->created_at ) ),
					'action' => "<span class='text-center'>" . $viewBtn . " <a href='/admin/topics/" . $topic->id . "/edit' style='color:inherit'><i class='icon-pencil3'></i></a> " . $deleteBtn . '</span>',
					'articles' => "<span class='text-center'> <a title='Add an article' href='/admin/articles/create?topicId=" . $topic->id . "' style='color:inherit'><i class='icon-plus-circle2'></i></a> <a title='List out articles' href='/admin/articles?topicId=" . $topic->id . "' style='color:inherit'><i class='icon-list-unordered'></i></a> </span>" 
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
		
		$recordsTotal = $this->topicRepo->count ();
		
		/* SEARCH CASE : Filtered data */
		if (! empty ( $this->request->input ( 'search.value' ) )) {
			/* WHERE Clause for searching */
			for($i = 0; $i < count ( $columns ); $i ++) {
				if ($columns [$i] ['searchable'] === 'true') {
					$column = $columns [$i] ['data']; // we get the name of each column using its index from POST request
					$where [] = "$column like '%" . $this->request->input ( 'search.value' ) . "%'";
				}
			}
			$where = "WHERE " . implode ( " OR ", $where ); // id like '%searchValue%' or name like '%searchValue%' ....
			/* End WHERE */
			$sql = sprintf ( 'SELECT * FROM ' . env ( 'DB_PREFIX' ) . 'topics %s', $where ); // Search query without limit clause (No pagination)
			
			$recordsFiltered = count ( DB::select ( DB::raw ( $sql ) ) ); // Count of search result
			
			/* SQL Query for search with limit and orderBy clauses */
			$sql = sprintf ( 'SELECT id, title,level_id, level_title, created_at, slug FROM ' . env ( 'DB_PREFIX' ) . 'topics %s ORDER BY %s %s limit %d , %d ', $where, $orderBy, $orderType, $offset, $limit );
			$topics = DB::select ( DB::raw ( $sql ) );
		}  /* END SEARCH */
else {
			$recordsFiltered = $recordsTotal;
			$topics = Topic::select ( 'id', 'title', 'level_title', 'level_id', 'created_at', 'slug' )->orderBy ( $orderBy, $orderType )->offset ( $offset )->limit ( $limit )->get ();
		}
		$data = [ ];
		foreach ( $topics as $topic ) {
			$level = Level::findOrFail ( $topic->level_id );
			$deleteBtn = '<form action="/admin/topics/' . $topic->id . '" method="POST" style="display: inline">
								<input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="_token" value="' . csrf_token () . '">
								<button type="submit" class="btn btn-icon icon-bin" style="background-color:transparent"> 									
								</button>
							</form>';
			$viewBtn = "<a target='_blank' href='/topics/" . $level->slug . "/" . $topic->slug . "' style='color:inherit'><i class='icon-eye2'></i></a> ";
			$editBtn = "<a href='/admin/topics/" . $topic->id . "/edit' style='color:inherit'><i class='icon-pencil3'></i></a>";
			$data [] = [ 
					'id' => $topic->id,
					'title' => $topic->title,
					'level_title' => $topic->level_title,
					'created_at' => date ( 'M j, Y', strtotime ( $topic->created_at ) ),
					'action' => "<span class='text-center'>" . $viewBtn . " <a href='/admin/topics/" . $topic->id . "/edit' style='color:inherit'><i class='icon-pencil3'></i></a> " . $deleteBtn . '</span>',
					'articles' => "<span class='text-center'> <a title='Add an article' href='/admin/articles/create?topicId=" . $topic->id . "' style='color:inherit'><i class='icon-plus-circle2'></i></a> <a title='List out articles' href='/admin/articles?topicId=" . $topic->id . "' style='color:inherit'><i class='icon-list-unordered'></i></a> </span>" 
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
		return view ( 'admin.topics.create', [ 
				'pageTitle' => 'Add a topic' 
		] );
	}
	public function store(TopicRequest $request) {
		$redirectUrl = 'admin/topics/create';
		$message = trans ( 'messages.something_went_wrong' );
		$errorLevel = 'danger';
		try {
			$level = Level::findOrFail ( $request->input ( 'level_id' ) );
			$picture = '';
			if ($request->hasFile ( 'picture' )) {
				$file = $request->file ( 'picture' );
				$fileName = generateFileName ( $file->getClientOriginalExtension () );
				$webImage = Image::make ( $file );
				$webPath = public_path ( "images/web/icons/" ) . $fileName;
				$webImage->save ( $webPath );
				
				$mobileImage = Image::make ( $file );
				$mobilePath = public_path ( "images/mobile/icons/" ) . $fileName;
				$mobileImage->save ( $mobilePath );
			}
			$active = false;
			if ($request->has ( 'active' )) {
				$active = true;
			}
			$inputs = array_merge ( $request->all (), [ 
					'level_title' => $level->title,
					'picture' => $fileName,
					'active' => $active 
			] );
			$topic = $this->topicRepo->store ( $inputs, Auth::user ()->id );
			
			flash ()->overlay ( trans ( 'messages.topic_created_success' ), trans ( 'messages.success' ) )->important ();
			
			return redirect ( 'admin/topics' );
		} catch ( QueryException $e ) {
			$message .= ' ' . $e->getMessage ();
		} catch ( \ErrorException $e ) {
			$message .= ' ' . $e->getMessage ();
		}
		
		flash ( $message, $errorLevel )->important ();
		
		return redirect ( $redirectUrl )->withInput ();
	}
	public function edit($id) {
		$topic = Topic::findOrFail ( $id );
		return view ( 'admin.topics.edit', [ 
				'pageTitle' => 'Update topic',
				'topic' => $topic 
		] );
	}
	public function update($id, TopicRequest $request) {
		$redirectUrl = 'admin/topics/' . $id . '/edit';
		$message = trans ( 'errors.something_went_wrong' );
		$errorLevel = 'danger';
		try {
			$level = Level::findOrFail ( $request->input ( 'level_id' ) );
			$topic = Topic::findOrFail ( $id );
			$active = false;
			if ($request->has ( 'active' )) {
				$active = true;
			}
			$inputs = array_merge ( $request->all (), [ 
					'level_title' => $level->title,
					'active' => $active 
			] );
			$topic = $this->topicRepo->saveTopic ( $topic, $inputs, Auth::user ()->id );
			
			flash ()->overlay ( trans ( 'messages.topic_updated_success' ), trans ( 'messages.success' ) )->important ();
			
			return redirect ( 'admin/topics' );
		} catch ( QueryException $e ) {
			$message .= ' ' . $e->getMessage ();
		} catch ( \ErrorException $e ) {
			$message .= ' ' . $e->getMessage ();
		}
		dd ( $message );
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
		$message = trans ( 'messages.topic_deleted_success' );
		$level = 'danger';
		try {
			Topic::destroy ( $id );
			$level = 'success';
			flash ()->overlay ( trans ( 'messages.topic_deleted_success' ), trans ( 'messages.success' ) )->important ();
			return redirect ( 'admin/topics' );
		} catch ( ModelNotFoundException $e ) {
			$message = trans ( 'errors.resource_not_found' );
		} catch ( QueryException $e ) {
			$message = trans ( 'errors.something_went_wrong' );
		}
		flash ()->overlay ( $message, 'Danger' )->important ();
		return redirect ( 'admin/topics' );
	}
}
