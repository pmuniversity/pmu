<?php
use PMU\Models\ {
	Role, 
	User
};
use Illuminate\Database\ {
	QueryException, 
	Eloquent\ModelNotFoundException, 
	Seeder
};
class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Excel::selectSheets ( 'Users' )->load ( database_path ( 'seeds/seed_files/product-management.xlsx' ), function ($reader) {
			// Getting all results
			$results = $reader->get ();
			
			// Truncate users
			User::truncate ();
			$i = 0;
			foreach ( $results as $row ) {
				try {
					$role = Role::whereSlug ( $row->role )->firstOrFail ();
					User::create ( [ 
							'email' => strtolower ( $row->email ),
							'password' => bcrypt ( $row->password ),
							'role_id' => $role->id,
							'role_title' => $row->role,
							'full_name' => ucwords ( strtolower ( trim ( $row->full_name ) ) ),
							'activated_at' => $row->activated ? Carbon::now () : null,
							'slug' => str_slug ( ucwords ( strtolower ( $row->full_name ) ), '-' ),
							'sign_up_ip' => getUserIp () 
					] );
				} catch ( QueryException $e ) {
					die ( 'Some exception occured. <br/>' . $e->getMessage () );
				} catch ( ModelNotFoundException $e ) {
					die ( 'Role not found. <br/>' . $e->getMessage () );
				}
				$i ++;
			}
			echo $i . ' Users successfully inserted' . PHP_EOL;
		} );
	}
}
