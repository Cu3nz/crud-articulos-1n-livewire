<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //? Llamamos al seeder de categorias 

        $this->call(CategorySeeder::class);

        //? Llalamos al modelo para los usuarios y nos genera dos usuarios.
        User::factory(2)->create();

        //? Borramos el directorio articles

        Storage::deleteDirectory('articles');

        //? Creamos el directorio 

        Storage::createDirectory('articles');

        //? Llamamos al factory de articulos y nos creamos 50
        Article::factory(50)->create();
    }
}
