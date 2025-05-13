<?php
class kiwiController 
{
    public function paginaManga() 
    {
        $title = "KiwiMangas";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/style.css">';
        $scripts = '<script src="../view/js/Populares.js"></script>';
        $contenido = '../view/manga/PaginaMangaV2.php';
        require '../view/admin/plantilla.php';
    }
    public function catalogo() 
    {
        $title = "Catalogo";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Catalogo.css">';
        $scripts = '<script src="../view/js/Catalogo.js"></script>';
        $contenido = '../view/manga/Catalogo.php';
        require '../view/admin/plantilla.php';
    }

    public function detalles() 
    {
        $title = "Detalles";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Detalles.css">';
        $scripts = '<script src="../view/js/Detalles.js"></script>';
        $contenido = '../view/manga/Detalles.php';
        require '../view/admin/plantilla.php';
    }

    public function categorias() 
    {
        $title = "Categorías";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Categorias.css">';
        $scripts = '<script src="../view/js/Categorias.js"></script>';
        $contenido = '../view/manga/Categorias.php';
        require '../view/admin/plantilla.php';
    }

    public function personajes() 
    {
        $title = "Personajes";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Personajes.css">';
        $scripts = '<script src="../view/js/Personajes.js"></script>';
        $contenido = '../view/manga/Personajes.php';
        require '../view/admin/plantilla.php';
    }

    public function ayuda(){
        $title = "Ayuda";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Ayuda.css">';
        $scripts = '<script src="../view/js/Ayuda.js"></script>';
        $contenido = '../view/manga/Ayuda.php';
        require '../view/admin/plantilla.php';

    }
    public function quienesSomos() 
    {
        $title = "Quienes Somos?";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Faq.css">';
        
        $contenido = '../view/manga/quienesSomos.php';
        require '../view/admin/plantilla.php';
    }
    public function afiliados() 
    {
        $title = "Tiendas Afiliadas";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Afiliados.css">';
        
        $contenido = '../view/manga/Afiliados.php';
        require '../view/admin/plantilla.php';
    }
    
}
?>