<?php

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->enum('status', TaskStatusEnum::values())->default('toDo');
            $table->enum('priority', TaskPriorityEnum::values())->default('1');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('parentId')->nullable();
            $table->foreign('parentId')->references('id')->on('tasks')->cascadeOnDelete();
            $table->string('title', 50);
            $table->string('description', 255);
            $table->timestamp('completedAt')->nullable();
            $table->timestamp('createdAt');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
