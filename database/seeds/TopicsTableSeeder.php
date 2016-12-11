<?php
use PMU\Models\ {
	Level, 
	Topic, 
	User
};
use Illuminate\Database\ {
	QueryException, 
	Eloquent\ModelNotFoundException, 
	Seeder
};
class TopicsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Excel::selectSheets ( 'topics' )->load ( database_path ( 'seeds/seed_files/product-management.xlsx' ), function ($reader) {
			// Getting all results
			$results = $reader->get ();
			
			// Truncate topics
			Topic::truncate ();
			$i = 0;
			foreach ( $results as $row ) {
				try {
					$level = Level::findOrFail ( ( int ) $row->level );
					$author = User::findOrFail ( ( int ) $row->created_by );
					Topic::create ( [ 
							'title' => ucwords ( strtolower ( $row->title ) ),
							'description' => Lipsum::medium ()->link ()->html ( 8 ),
							'picture' => $row->picture ?? null,
							'level_id' => ( int ) $level->id,
							'level_title' => $level->title,
							'author_id' => ( int ) $row->created_by,
							'author_name' => $author->full_name,
							'author_location' => $author->location,
							'author_office' => $author->office,
							'author_designation' => $author->designation,
							'active' => 1,
							'slug' => str_slug ( $row->title, '-' ) 
					] );
				} catch ( QueryException $e ) {
					die ( 'Some exception occured. <br/>' . $e->getMessage () );
				} catch ( ModelNotFoundException $e ) {
					die ( 'Level not found. <br/>' . $e->getMessage () );
				}
				$i ++;
			}
			echo $i . ' Topics successfully inserted' . PHP_EOL;
		} );
	}
}
