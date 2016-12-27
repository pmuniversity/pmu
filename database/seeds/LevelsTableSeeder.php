<?php
use PMU\Models\Level;
use Illuminate\Database\ {
	QueryException, 
	Seeder
};
class LevelsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Excel::selectSheets ( 'Levels' )->load ( database_path ( 'seeds/seed_files/product-management.xlsx' ), function ($reader) {
			// Getting all results
			$results = $reader->get ();
			
			// Truncate Level
			Level::truncate ();
			$i = 0;
			foreach ( $results as $row ) {
				try {
					Level::create ( [ 
							'title' => $row->title,
							'description' => $row->description,
							'slug' => str_slug ( $row->title ) 
					] );
				} catch ( QueryException $e ) {
					die ( 'Some exception occured. <br/>' . $e->getMessage () );
				}
				$i ++;
			}
			echo $i . ' Levels successfully inserted' . PHP_EOL;
		} );
	}
}
