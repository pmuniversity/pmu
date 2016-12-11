<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class CreateArticlesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'articles', function (Blueprint $table) {
			$table->bigIncrements ( 'id' );
			$table->unsignedInteger ( 'topic_id' )->index ();
			
			$table->string ( 'type_title' )->nullable ();
			$table->string ( 'source_url' )->nullable ();
			$table->string ( 'title' )->nullable ();
			$table->longText ( 'description' )->nullable ();
			$table->string ( 'file_path' )->nullable ();
			$table->unsignedBigInteger ( 'author_id' )->nullable ();
			$table->string ( 'author_name', 200 )->nulable ();
			$table->mediumText ( 'author_location' )->nullable ();
			$table->string ( 'author_office' )->nullable ();
			$table->string ( 'author_designation' )->nullable ();
			$table->string ( 'author_picture' )->nullable ();
			$table->unsignedInteger ( 'sequence' )->default ( 1 );
			$table->string ( 'slug' )->nullabe();
			$table->unsignedInteger ( 'upvotes_count' )->default ( 0 );
			$table->unsignedInteger ( 'downvotes_count' )->default ( 0 );
			
			// Timestamps
			$table->timestamp ( 'created_at' )->default ( DB::raw ( 'CURRENT_TIMESTAMP' ) );
			$table->timestamp ( 'updated_at' )->nullable ();
			
			// Soft delete
			$table->softDeletes ()->index ();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'articles' );
	}
}
