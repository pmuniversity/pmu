<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class CreateLevelsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'levels', function (Blueprint $table) {
			$table->mediumIncrements ( 'id' );
			$table->string ( 'title', 40 );
			
			// Slug
			$table->string ( 'slug', 20 )->nullable();
			
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
		Schema::drop ( 'levels' );
	}
}
