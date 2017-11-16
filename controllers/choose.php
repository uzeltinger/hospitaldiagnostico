<?php
require_once 'lib/maincontroller.php';

class Choose extends MainController {
    protected $page = 'Choose';

    protected $tpl = 'pages:choose.html';

    public function index() {
        $vars = array();

        $vars['titulo'] = 'Hola choose.php';
        $vars['mensaje'] = 'Esta es choose contenido';

        require_once 'lib/inhouse3/api.php';
        $api = new INhouse3API(430, 'ff76cj');

        //First Title
        $firstTitle = $api->getTexto(12705);
        $vars['firstTitle'] = $firstTitle->get('cuerpo');        

        // Obtener las noticias
        $highlightedAbout = $api->getNoticias(12708);
        // leer el contenido html de la plantilla para cada noticia
        $parteNoticiaOriginal[0] = $this->getParteNoticia('left');
        $parteNoticiaOriginal[1] = $this->getParteNoticia('right');
        $noticias = "";
        $x=0;
        foreach($highlightedAbout as $noticia) {
            // asignar html left o right para cada noticia
            $parteNoticia = $x%2==0?$parteNoticiaOriginal[0]:$parteNoticiaOriginal[1];   
            $id = $noticia->get('id');
            $titulo = $noticia->get('titulo');
            $cuerpo = $noticia->get('cuerpo');
            $portada_thumb = 'http://admininhouse.com/'.$noticia->get('portada_thumb');
            $portada_imagen = $noticia->get('portada_imagen');
            $parteNoticia = str_replace('VAR_TITULO',$titulo,$parteNoticia);
            $parteNoticia = str_replace('VAR_CUERPO',$cuerpo,$parteNoticia);
            $parteNoticia = str_replace('VAR_IMAGEN_SRC',$portada_thumb,$parteNoticia);
            $noticias .= $parteNoticia;
            $x++;
        }        
        $vars['noticias'] = $noticias;

        //Second Title
        $secondTitle = $api->getTexto(12709);
        $vars['secondTitleTitle'] = $secondTitle->get('titulo');
        $vars['secondTitleCuerpo'] = $secondTitle->get('cuerpo');
        $vars['secondTitlePortada'] = $secondTitle->get_portada();

        //Third Title (id: 12710)
        $thirdTitle = $api->getTexto(12710);
        $vars['thirdTitleTitle'] = $thirdTitle->get('titulo');
        $vars['thirdTitleCuerpo'] = $thirdTitle->get('cuerpo');

        //Fourth Title (id: 12712)
        $fourthTitle = $api->getTexto(12712);
        $vars['fourthTitleTitle'] = $fourthTitle->get('titulo');
        $vars['fourthTitleCuerpo'] = $fourthTitle->get('cuerpo');

        // Fifth Title (id: 12713)
        $fifthTitle = $api->getTexto(12713);
        $vars['fifthTitleTitle'] = $fifthTitle->get('titulo');
        $vars['fifthTitleCuerpo'] = $fifthTitle->get('cuerpo');
        $vars['fifthTitlePortada'] = $fifthTitle->get_portada();

        return $vars;
    }

    public function mensaje() {
        $this->setTpl('pages:texto.html');
        $vars = array();
        $vars['titulo'] = 'Esta es una prueba';
        $vars['cuerpo'] = 'lorem ipsum ...';
        return $vars;
    }

    public function getParteNoticia($image_float){        
        $file_name = "html/partes/choose.noticias.$image_float.html";
        $file_data = fopen($file_name, "r");
        if ( !$file_data )
        {
            throw new RenderException( _('No se pudo leer la parte de la plantilla') );
        }
        $content = fread( $file_data, filesize( $file_name ) );
        fclose( $file_data );
        return $content;
    }
}
