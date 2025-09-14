<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Server;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('server_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Server::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('server_user');
    }
};
