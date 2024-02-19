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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->string('slug',400);
            $table->integer('quantity');
            $table->longText('description')->nullable();
            $table->boolean('published')->default(0);
            $table->boolean('inStock')->default(0);
            $table->decimal('price',10,2);
            $table->foreignIdFor(\App\Models\User::class,'created_by')->nullable();
            $table->foreignIdFor(\App\Models\User::class,'updated_by')->nullable();
            $table->foreignIdFor(\App\Models\Brand::class,'brand_id')->nullable();
            $table->foreignIdFor(\App\Models\Category::class,'category_id')->nullable();
            $table->softDeletes();
            $table->foreignIdFor(\App\Models\User::class,'deleted_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
