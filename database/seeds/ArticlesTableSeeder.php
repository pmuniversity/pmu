<?php
use PMU\Models\ {
	Article, 
	User
};
use PMU\Traits\Sluggable;
use Illuminate\Database\ {
	QueryException, 
	Eloquent\ModelNotFoundException, 
	Seeder
};
class ArticlesTableSeeder extends Seeder {
	use Sluggable;
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Excel::selectSheets ( 'articles' )->load ( database_path ( 'seeds/seed_files/product-management.xlsx' ), function ($reader) {
			// Getting all results
			$results = $reader->get ();
			
			// Truncate articles if any
			DB::table ( 'articles' )->truncate ();
			$i = 0;
			foreach ( $results as $row ) {
				try {
					$content = new Article ();
					$title = $row->title ?? getTitleViaLink ( $row->url );
					$author = User::findOrFail ( $row->author_id );
					Article::create ( [ 
							'topic_id' => $row->topic_id,
							'type_title' => $row->type,
							'source_url' => $row->url,
							'title' => str_limit ( $title, 65 ),
							'author_id' => $row->author_id,
							'author_name' => $author->full_name,
							'author_location' => $author->location,
							'author_organization' => $author->office,
							'author_designation' => $author->designation 
					] );
				} catch ( QueryException $e ) {
					die ( 'Some exception occured. <br/>' . $e->getMessage () );
				} catch ( ModelNotFoundException $e ) {
					die ( 'Article type not found. <br/>' . $e->getMessage () );
				} catch ( \ErrorException $e ) {
					die ( 'Some exception occured. <br/>' . $e->getMessage () );
				}
				$i ++;
			}
			echo $i . ' Articles successfully inserted' . PHP_EOL;
		} );
	}
}
