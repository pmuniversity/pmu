<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'users', function (Blueprint $table) {
			$table->bigIncrements ( 'id' );
			$table->string ( 'full_name' )->nullable();
			$table->string ( 'email' )->unique ()->index ();
			$table->string ( 'password' )->nullable();
			$table->unsignedMediumInteger ( 'role_id' )->default ( 1 )->index ();
			$table->string ( 'role_title', 50 )->nullable ();
			$table->string ( 'activation_code' )->nullable ();
			$table->timestamp ( 'activated_at' )->nullable ();
			$table->boolean ( 'news_letter_subscribed' )->default ( false );
			$table->unsignedBigInteger ( 'sign_up_ip' )->nullable ();
			$table->unsignedBigInteger ( 'sign_in_ip' )->nullable ();
			$table->boolean ( 'logged_in' )->default ( false );
			$table->string ( 'slug' )->nullable();
			$table->string ( 'picture' )->nullable ();
			$table->string ( 'location' )->nullable ();
			$table->string ( 'office' )->nullable ();
			$table->string ( 'designation' )->nullable ();
			$table->rememberToken ();
			
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
		Schema::drop ( 'users' );
	}
}
