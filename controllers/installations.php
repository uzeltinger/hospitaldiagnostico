<?php
require_once 'lib/maincontroller.php';

class Installations extends MainController {
    protected $page = 'Installations';

    protected $tpl = 'pages:installations.html';

    public function index() {
        $vars = array();

        require_once 'config/inhouse.php';
        $api = get_inhouse_api();

        //First Title (id: 12719)
        $firstTitle = $api->getTexto(12719);
        $vars['firstTitleTitle'] = $firstTitle->get('titulo'); 
        $vars['firstTitleCuerpo'] = $firstTitle->get('cuerpo'); 
        $vars['firstTitlePortada'] = $firstTitle->get_portada();

        //Second Title (id: 12720)
        $secondTitle = $api->getTexto(12720);
        $vars['secondTitleTitle'] = $secondTitle->get('titulo');
        $vars['secondTitleCuerpo'] = $secondTitle->get('cuerpo');
        $vars['secondTitlePortada'] = $secondTitle->get_portada();

        //Third Title (id: 12710)
        $thirdTitle = $api->getTexto(12722);
        $vars['thirdTitleTitle'] = $thirdTitle->get('titulo');
        $vars['thirdTitleCuerpo'] = $thirdTitle->get('cuerpo');
        $vars['thirdTitlePortada'] = $thirdTitle->get_portada();

        //Installations Gallery (id: 12721)
        $galerias = $api->getGalerias(12721);
        foreach($galerias as $galeria){
            
        }
        $galeria = $api->getGaleria($galeria->get('id'));
        $imagenes = $galeria->get_galeria();
        
        $slideImages = "";
        foreach($imagenes as $imagen){
            $slideImages .= '<div class="singel-installation bg-img" style="background-image: url('.$imagen->get_imagen().')"></div>';
        }
        $vars['slideImages'] = $slideImages;

        return $vars;
    }

    public function mensaje() {
        $this->setTpl('pages:texto.html');
        $vars = array();
        $vars['titulo'] = 'Esta es una prueba';
        $vars['cuerpo'] = 'lorem ipsum ...';
        return $vars;
    }
}