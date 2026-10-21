<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom role sudah ada, jadi tidak perlu ditambahkan lagi.
        // Kita hanya memastikan role akun demo sudah sesuai.

        DB::table('users')
            ->where('email', 'admin@inventory.test')
            ->update(['role' => 'admin']);

        DB::table('users')
            ->where('email', 'staff@inventory.test')
            ->update(['role' => 'staff']);

        DB::table('users')
            ->where('email', 'user@inventory.test')
            ->update(['role' => 'user']);
    }

    public function down(): void
    {
        // Jangan hapus kolom role karena sudah ada sebelumnya.
    }
};