<?php

use App\Models\Location;
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
        Schema::create('pads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Location::class)
                ->index()
                ->constrained();

            $table->string('url');
            $table->bigInteger('agency_id')->nullable();
            $table->string('name');
            $table->string('info_url')->nullable();
            $table->string('wiki_url');
            $table->string('map_url');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('map_image');
            $table->integer('total_launch_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pads');
    }
};
