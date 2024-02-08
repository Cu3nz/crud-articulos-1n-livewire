<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake())); //? Añadimos esta linea para las imagenes super importante

        return [
            //

            'nombre' => fake() -> unique() -> words(3,true), 
            'descripcion' => fake() -> text(),
            'estado' => fake() -> randomElement(['DISPONIBLE' , 'NO DISPONIBLE']), //! Importante sqlite no utiliza 1 y 2 para definir disponible o no disponible hay que pasarle los valores permitidos por eso utilizo el randomElement
            'imagen' => "articles/" . fake()->picsum("public/storage/articles", 640, 400, false), //? Importante poner el false, esto lo que devuelve es articles/imagenlogo1fgfsfd.png

            'category_id' => Category::all() -> random() -> id //? Me traigo todas las categorias y cojo un id aleatoria y se lo asigno a ese articulo que estoy creando.
        ];
    }
}
