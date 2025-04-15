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
        Schema::create('tasks', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->bigInteger('seq')->unique()->index();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('status');
            $table->string('priority');
            $table->char('assigned_to')->nullable();
            $table->char('project_id');
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('completed_date')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('assigned_to')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('tasks');
    }
};
