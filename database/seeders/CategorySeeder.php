<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categorias = [
            'Portátiles' => 'Dispositivos móviles para todo tipo de usuarios, desde básicos hasta de alto rendimiento para gaming y diseño gráfico.',
            'Sobremesa' => 'Ordenadores de sobremesa potentes para uso profesional, personal y de gaming.',
            'Monitores' => 'Pantallas de alta definición y para gaming, con variadas tasas de refresco y tamaños.',
            'Periféricos' => 'Teclados, ratones, alfombrillas y más accesorios para mejorar tu estación de trabajo o juego.',
            'Almacenamiento' => 'Soluciones de almacenamiento como SSDs, HDDs y unidades externas para todo tipo de necesidades.',
            'Componentes' => 'Piezas para ensamblar o mejorar tu ordenador, incluyendo tarjetas gráficas, CPUs y memorias RAM.',
            'Redes' => 'Equipos para configurar tu red doméstica o de oficina, incluyendo routers, switches y adaptadores WiFi.',
            'Software' => 'Sistemas operativos, aplicaciones de oficina, herramientas de diseño y software antivirus para tu seguridad.',
        ];
        
        foreach ($categorias as $nombre => $descripcion) {
            
            Category::create(compact('nombre' , 'descripcion'));

        }

    }
}
