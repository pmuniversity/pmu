<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class CreateTopicsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'topics', function (Blueprint $table) {
			$table->bigIncrements ( 'id' );
			$table->unsignedMediumInteger ( 'level_id' )->default ( 1 )->index ();
			$table->string ( 'level_title', 50 )->nullable ();
			$table->string ( 'title' )->nullable ();
			$table->mediumText ( 'summary' )->nullable ();
			$table->string ( 'note_title' )->nullable ();
			$table->longText ( 'description' )->nullable ();
			$table->string ( 'picture', 150 )->nullable ();
			$table->unsignedBigInteger ( 'author_id' )->nullable ();
			$table->string ( 'author_name', 200 )->nulable ();
			$table->mediumText ( 'author_location' )->nullable ();
			$table->string ( 'author_office' )->nullable ();
			$table->string ( 'author_designation' )->nullable ();
			$table->string ( 'author_picture' )->nullable ();
			$table->string ( 'h1' )->nullable ();
			$table->string ( 'meta_title' )->nullable ();
			$table->string ( 'meta_description' )->nullable ();
			$table->string ( 'meta_keywords' )->nullable ();
			$table->string ( 'slug' )->nullable ();
			$table->unsignedTinyInteger ( 'active' )->default ( 1 )->index ();
			$table->string ( 'read_time', 30 )->nullable ();
			
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
		Schema::drop ( 'topics' );
	}
}
