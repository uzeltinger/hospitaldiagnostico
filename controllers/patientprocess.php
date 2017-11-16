<?php
require_once 'lib/maincontroller.php';

class PatientProcess extends MainController {
    protected $page = 'PatientProcess';
    protected $tpl = 'pages:patientprocess.html';

    public function index() {
        $vars = array();
        require_once 'config/inhouse.php';
        $api = get_inhouse_api();
        //Cover (id: 12735)
        $galerias = $api->getGalerias(12735);        
        foreach($galerias as $galeria){        }        
        $galeria = $api->getGaleria($galeria->get('id'));
        $imagenes = $galeria->get_galeria();
        foreach($imagenes as $imagen){            
            $cover = $imagen->get_imagen();
        }
        $vars['cover'] = $cover;       
        //echo '<pre>';print_r($cover);echo '</pre>';
        //About the treatment (id: 12736)
        $firstTitle = $api->getTexto(12736);
        $vars['firstTitleTitle'] = $firstTitle->get('titulo'); 
        $vars['firstTitleCuerpo'] = $firstTitle->get('cuerpo');
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