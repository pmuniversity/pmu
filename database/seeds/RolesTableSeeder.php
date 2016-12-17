<?php
use PMU\Models\Role;
use Illuminate\Database\ {
	QueryException, 
	Seeder
};
class RolesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Excel::selectSheets ( 'Roles' )->load ( database_path ( 'seeds/seed_files/product-management.xlsx' ), function ($reader) {
			// Getting all results
			$results = $reader->get ();
			
			// Truncate role
			Role::truncate ();
			$i = 0;
			foreach ( $results as $row ) {
				try {
					Role::create ( [ 
							'title' => $row->title,
							'slug' => str_slug ( $row->title, '_' ) 
					] );
				} catch ( QueryException $e ) {
					die ( 'Some exception occured. <br/>' . $e->getMessage () );
				}
				$i ++;
			}
			echo $i . ' Roles successfully inserted' . PHP_EOL;
		} );
	}
}
