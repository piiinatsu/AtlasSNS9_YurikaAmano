<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 新しいカラムを先に追加する
            $table->string('icon_image')->nullable()->after('bio');
        });

        // 新しいカラムに旧カラムの値をコピーする
        DB::statement('UPDATE users SET icon_image = images');
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('icon_image');
        });
    }
};
