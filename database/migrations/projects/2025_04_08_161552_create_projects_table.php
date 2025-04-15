<?php

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
        Schema::create('projects', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->bigInteger('seq')->unique()->index();
            $table->char('owner')->nullable();
            $table->string('title');
            $table->longText('description');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->string('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->string('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->string('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
