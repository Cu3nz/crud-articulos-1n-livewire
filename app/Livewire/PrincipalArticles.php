<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PrincipalArticles extends Component
{

    use WithPagination;

    //todo variables para la ordenacion de la consulta 

    public string $campo = "articles.id";
    public string $orden ="desc";

    public ?string $estado = "";

    public string $buscar = "";


    //todo Para el create 


    #[On('Crear_RefrescarTable')]
    public function render()
    {
        //? Hacemos un inner join con la tabla categories, donde el id de la tabla categories = al category_id de la tabla articles 
        
        $articles = Article::join('categories' , 'categories.id' , "=" , 'category_id') 
        //? Recogemos de la tabla articles,  el id, nombre , descripcion, estado, imagen
        //? Recogemos de la tabla categories el nombre de la categoria.
        //! IMPORTANTE PONER LOS ALIAS 
        ->select('articles.id as id','articles.nombre as article_nombre' , 'articles.descripcion as descripcion_article' , 'estado' , 'imagen' , 'categories.nombre as category_nombre')
        //todo Estos 3 campos es utilizado para buscar con el buscador que implementaremos mas adelante.
        ->where('articles.nombre' , 'like' , "$this->buscar%") 
        ->orWhere('categories.nombre' , 'like' , "$this->buscar%") 
        ->orWhere('estado' , 'like' , "$this->buscar%")
        //todo  Ordenamos segun lo que haya puesto en las variables
        ->orderBy($this -> campo, $this -> orden)
        //todo Paginamos los articulos de 5 en 5.
        ->paginate(5);
        return view('livewire.principal-articles', compact('articles'));
    }


    public function ordenar($campo){
        //? Si has pulsado para ordenar y orden tiene el valor de asc, te ordena por desc y si tiene el desc, te lo ordena por asc
      $this -> orden =  ($this -> orden == 'asc') ? 'desc' : 'asc';
      $this -> campo = $campo;
    }


    public function updataingBuscar(){
        $this -> resetPage();
    }

    //todo Metodo que ayuda a cambiar el estado haciendo un clikc.

    public function cambiarEstadoClick(Article $article){

       $estado =  ($article -> estado  == 'NO DISPONIBLE') ? 'DISPONIBLE' : 'NO DISPONIBLE';

       $article -> update([
        'estado' => $estado
       ]);

    }

    public function pedirConfirmacion($id){

        //todo Este metodo lo va a escuchar la clase app.blade.php y mas bien el script de sweetAlert que va a estar definido ahi. 

        $this -> dispatch('confirmarDelete' , $id);

    }

    //? Evento que estara definido en el script en app.blade.php, ya que al pulsar en el boton de si el evento deleteAceptado llamara a este metodo.

    #[On('deleteAceptado')]

    public function delete(Article $article){
        //todo En este metodo antes de borrar el articulo, tengo que comprobar la imagen

        if (basename($article -> imagen) != 'noimage.png'){ //? SI el nombre de la iamgen en la base de datos es distinta a noimagen.png
            Storage::delete($article -> imagen); //* Borramos la imagen
        }

        $article -> delete(); //* Borramos el articulo entero

        //? Mandamos el mensaje de swettalert que siempre vemos

        $this -> dispatch('mensaje' , 'Articulo borrado Correctamente');

    }



}
