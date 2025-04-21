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
        Schema::create('task_time_trackers', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->bigInteger('seq')->unique()->index();
            $table->char('task_id');
            $table->char('assignee');
            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('task_id')->references('id')->on('tasks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('assignee')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('task_time_trackers');
    }
};
