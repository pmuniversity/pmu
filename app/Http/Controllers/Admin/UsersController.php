<?php

namespace PMU\Http\Controllers\Admin;

use PMU\Models\User;
use Illuminate\Http\Request;
use PMU\Repositories\ {
	UserRepository, 
	RoleRepository
};
use PMU\Traits\ApiControllerTrait;
use PMU\Http\Controllers\Controller;
use DB;

class UsersController extends Controller {
	use ApiControllerTrait;
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
	protected $userRepo;
	/**
	 * The RoleRepository instance.
	 *
	 * @var \App\Repositories\RoleRepository
	 */
	protected $roleRepo;
	/**
	 * Create a new UserController instance.
	 *
	 * @param \App\Repositories\UserRepository $userRepository        	
	 *
	 * @return void
	 */
	public function __construct(Request $request, UserRepository $userRepository) {
		$this->request = $request;
		$this->userRepo = $userRepository;
	}
	public function index() {
		return view ( 'admin.users.index', ['pageTitle' => 'Users'] );
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
		
		$recordsTotal = $this->userRepo->count ();
		
		/* SEARCH CASE : Filtered data */
		if (! empty ( $this->request->input ( 'search.value' ) )) {
			/* WHERE Clause for searching */
			for($i = 0; $i < count ( $columns ); $i ++) {
				$column = $columns [$i] ['data']; // we get the name of each column using its index from POST request
				$where [] = "$column like '%" . $this->request->input ( 'search.value' ) . "%'";
			}
			$where = "WHERE " . implode ( " OR ", $where ); // id like '%searchValue%' or name like '%searchValue%' ....
			/* End WHERE */
			$sql = sprintf ( 'SELECT * FROM ' . env ( 'DB_PREFIX' ) . 'users %s', $where ); // Search query without limit clause (No pagination)
			
			$recordsFiltered = count ( DB::select ( DB::raw ( $sql ) ) ); // Count of search result
			
			/* SQL Query for search with limit and orderBy clauses */
			$sql = sprintf ( 'SELECT id, full_name, email, role_title FROM ' . env ( 'DB_PREFIX' ) . 'users %s ORDER BY %s %s limit %d , %d ', $where, $orderBy, $orderType, $offset, $limit );
			$data = DB::select ( DB::raw ( $sql ) );
		}  /* END SEARCH */
else {
			$recordsFiltered = $recordsTotal;
			$data = User::select ( 'id', 'full_name', 'email', 'role_title' )->orderBy ( $orderBy, $orderType )->offset ( $offset )->limit ( $limit )->get ();
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
	 * Update "seen" field for user.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param \App\Models\User $user        	
	 * @return \Illuminate\Http\Response
	 */
	public function updateSeen(Request $request, User $user) {
		$this->userRepository->update ( $request->all (), $user );
		
		return response ()->json ();
	}
	
	/**
	 * Validate an user for comments
	 *
	 * @param Illuminate\Http\Request $request        	
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function valid(Request $request, $id) {
		$this->userRepository->valid ( $request->input ( 'valid' ), $id );
		
		return response ()->json ();
	}
}
