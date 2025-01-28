<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueProfileIdToUsersTable extends Migration
{
    /**
     * Выполняется при применении миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Добавление уникального идентификатора профиля, который может быть NULL
            // и будет размещен сразу после столбца 'id'
            $table->uuid('profile_id')->unique()->nullable()->after('id');
        });
    }

    /**
     * Выполняется при откате миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Удаление столбца profile_id
            $table->dropColumn('profile_id');
        });
    }
}
