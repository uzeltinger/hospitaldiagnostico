<?php
require_once 'lib/maincontroller.php';

class Faq extends MainController {
    protected $page = 'Faq';
    protected $tpl = 'pages:faq.html';

    public function index() {
        $vars = array();
        require_once 'config/inhouse.php';
        $api = get_inhouse_api();
        //FAQ  Title (id: 12752)
        $firstTitle = $api->getTexto(12752);
        $vars['firstTitleTitle'] = $firstTitle->get('titulo'); 
        $vars['firstTitleCuerpo'] = $firstTitle->get('cuerpo');


        //faq (id: 12753)
        // Obtener las noticias
        $faqNoticia = $api->getNoticias(12753);
        // leer el contenido html de la plantilla para cada noticia
        $parteNoticiaOriginal = "<h2>VAR_NOMBRE</h2><p>VAR_CUERPO</p>";
        $noticias = "";
        $x=0;
        
        foreach($faqNoticia as $noticia) {
            $parteNoticia = $parteNoticiaOriginal;
            $id = $noticia->get('id');
            $titulo = $noticia->get('titulo');
            $cuerpo = $noticia->get('cuerpo');
            $enlace_noticia= $noticia->get('enlace');
            $parteNoticia = str_replace('VAR_NOMBRE',$titulo,$parteNoticia);
            $parteNoticia = str_replace('VAR_CUERPO',$cuerpo,$parteNoticia);  
            $noticias .= $parteNoticia;
            $x++;            
        }
        //echo '<pre>';print_r($parteNoticia);echo '</pre>';
        $vars['noticias'] = $noticias;

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