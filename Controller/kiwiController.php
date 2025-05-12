<?php
class kiwiController 
{
    public function paginaManga() 
    {
        $contenido = '../view/manga/PaginaMangaV2.php';
        require '../view/admin/plantilla.php';
    }
    public function catalogo() 
    {
        $contenido = '../view/manga/Catalogo.php';
        require '../view/admin/plantilla.php';
    }

    public function detalles() 
    {
        $contenido = '../view/manga/Detalles.php';
        require '../view/admin/plantilla.php';
    }

    public function categorias() 
    {
        $contenido = '../view/manga/Categorias.php';
        require '../view/admin/plantilla.php';
    }

    public function personajes() 
    {
        $contenido = '../view/manga/Personajes.php';
        require '../view/admin/plantilla.php';
    }
    

   
}
?>