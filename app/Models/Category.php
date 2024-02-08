<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nombre' , 'descripcion']; //? Especifico que en esos campos se pueden insertar borrar y actualizar

    //todo Pongo el nombre de la funcion en plural, porque una categoria puede tener mas de un producto y utilizo HasMany.

    public function articles(){
        return $this -> hasMany(Article::class);
    }


    public function nombre(){
        return Attribute::make(
            set: fn($v) => ucfirst($v)
        );
    }
    public function descripcion(){
        return Attribute::make(
            set: fn($v) => ucfirst($v)
        );
    }

}
