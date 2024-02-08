<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearArticle extends Component
{

    use WithFileUploads; //todo Sin esto no carga las imagenes

    #[Validate(['nullable','image','max:2048'])]
    public $imagen;

    #[Validate(['required','string','min:3','unique:articles,nombre'])]
    public string $nombre;

    #[Validate(['required','string','min:10'])]
    public string $descripcion;

    #[Validate(['nullable'])]
    public ?string $estado = null;

    #[Validate(['required' , 'exists:categories,id'])] //todo Tiene que existir en la tabla categories en la columna id
    public string $category_id;

    public bool $abrirModalCreate = false; //? variable que va a ser utiliza para abrir la modal cuando este el valor a true y para que no se abra cuando se cargue la pagina

    public function render()
    {
        $categorias = Category::select('id' , 'nombre') -> orderBy('nombre') -> get();
        return view('livewire.crear-article' , compact('categorias'));
    }


    public function store(){
        //* Primero validamos
        $this -> validate();

        //* pasadas las validaciones creamos el objeto


        Article::create([

            'nombre' => $this -> nombre,
            'descripcion' => $this -> descripcion,
            'estado' => ($this -> estado) ? "DISPONIBLE" : 'NO DISPONIBLE',
            'imagen' => ($this -> imagen) ? $this -> imagen -> store('articles') : 'noimage.png',
            'category_id' => $this -> category_id
        ]);

        //todo  Una vez que lo hemos creado, tendremos que ejecutar de nuevo la consulta que hay en PrincipalArticles para que la consulta se genere de nuevo y muestre el ultimo articulo, por lo tanto vamos a definir un evento dispatch to

        $this ->  dispatch('Crear_RefrescarTable') -> to(PrincipalArticles::class);


        //todo Ahora vamos a definir un evento para mostrar el mensaje de que se ha creado corectamnete

        $this ->  dispatch('mensaje','Articulo creado correctamnete');

        $this -> CerrarModalCreate();

    }



    public function CerrarModalCreate(){
        //todo Seteamos los campos y cerramos la modal
        $this -> reset('nombre', 'descripcion' , 'imagen' , 'category_id' , 'estado' , 'abrirModalCreate');
    }
}
