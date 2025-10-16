<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    Schema::create('surveys', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description')->nullable();
    $table->timestamps();
});

}
