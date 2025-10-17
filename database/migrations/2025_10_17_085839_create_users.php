<?php

declare(strict_types=1);

use Database\Factories\UserFactory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        foreach(range(1, 100) as $i) {
            UserFactory::new()->count(1000)->create();
        }
    }
};

