<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['nombre' , 'descripcion','estado','imagen' , 'category_id']; 



    //todo El nombre de la funcion va en singular, ya que un articulo solo puede tener una categoria y por eso utilizamos el belongTo

    public function category(){
        return $this -> belongsTo(Category::class);
    }


    public function nombre (){
        return Attribute::make(
            set: fn($v) => ucfirst($v)
        );
    }
    public function descripcion (){
        return Attribute::make(
            set: fn($v) => ucfirst($v)
        );
    }

}
