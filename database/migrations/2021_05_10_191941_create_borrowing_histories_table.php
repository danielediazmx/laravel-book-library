<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowing_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')
                ->on('books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('borrowing_histories', function (Blueprint $table) {
            $table->dropForeign('borrowing_histories_book_id_foreign');
            $table->dropIndex('borrowing_histories_book_id_foreign');
            $table->dropColumn('book_id');

            $table->dropForeign('borrowing_histories_user_id_foreign');
            $table->dropIndex('borrowing_histories_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('borrowing_histories');
    }
}
