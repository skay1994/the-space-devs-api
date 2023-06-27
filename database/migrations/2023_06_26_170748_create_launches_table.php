<?php

use App\Enums\Status;
use App\Models\LaunchServiceProvider;
use App\Models\Rocket;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('launches', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignIdFor(LaunchServiceProvider::class, 'launch_provider_id')
                ->index()
                ->constrained((new LaunchServiceProvider)->getTable());
            $table->foreignIdFor(Rocket::class)
                ->index()
                ->constrained();

            $table->enum('status', [Status::values()])->default(Status::HOLD->value);
            $table->string('url');
            $table->bigInteger('launch_library_id')->nullable();
            $table->string('name');
            $table->string('slug')->index();
            $table->dateTime('net');
            $table->dateTime('window_start');
            $table->dateTime('window_end');
            $table->boolean('inhold');
            $table->dateTime('tbdtime')->nullable();
            $table->dateTime('tbddate')->nullable();
            $table->text('probability')->nullable();
            $table->text('holdreason')->nullable();
            $table->text('failreason')->nullable();
            $table->text('hashtag')->nullable();
            $table->boolean('webcast_live')->index();
            $table->string('image');
            $table->string('infographic');
            $table->text('program');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('launches');
    }
};
