<?php
require_once 'lib/maincontroller.php';

class Service extends MainController {
    protected $page = 'Service';

    protected $tpl = 'pages:service.html';

    public function index() {
        $vars = array();

        require_once 'config/inhouse.php';
        $api = get_inhouse_api();

        //About the treatment (id: 12729)
        $firstTitle = $api->getTexto(12729);
        $vars['firstTitleTitle'] = $firstTitle->get('titulo'); 
        $vars['firstTitleCuerpo'] = $firstTitle->get('cuerpo'); 
        $vars['firstTitlePortada'] = $firstTitle->get_portada();
        //Procedures (id: 12730)
        $secondTitle = $api->getTexto(12730);
        $vars['secondTitleTitle'] = $secondTitle->get('titulo');
        $vars['secondTitleCuerpo'] = $secondTitle->get('cuerpo');
        $vars['secondTitlePortada'] = $secondTitle->get_portada();


        //Service Gallery (id: 12721)
        $galerias = $api->getGalerias(12730);
        
        foreach($galerias as $galeria){
            
        }
        $galeria = $api->getGaleria($galeria->get('id'));
        $imagenes = $galeria->get_galeria();
        
        $slideImages = "";
        foreach($imagenes as $imagen){
            $slideImages .= '<div class="singel-installation bg-img" style="background-image: url('.$imagen->get_imagen().')"></div>';
        }
        $vars['slideImages'] = $slideImages;
        //echo '<pre>';print_r($imagenes);echo '</pre>';

        //Quotes (id: 12725)
        // Obtener las noticias
        $serviceNoticia = $api->getNoticias(12731);
        // leer el contenido html de la plantilla para cada noticia
        $parteNoticiaOriginal = $this->getParteNoticia();
        $noticias = "";
        $x=0;
        
        foreach($serviceNoticia as $noticia) {
            $parteNoticia = $parteNoticiaOriginal;
            $id = $noticia->get('id');
            //$idGaleria = $noticia->get('id_galeria');
            $titulo = $noticia->get('titulo');
            $cuerpo = $noticia->get('cuerpo');
            $enlace_noticia= $noticia->get('enlace');
            //$especialidad = $this->getEspecialidad($idGaleria);
            if(!$enlace_noticia){
                $enlace_noticia = './doctor?id='.$id;
            }
            //$portada_thumb = 'http://admininhouse.com/'.$noticia->get('portada_thumb');
            //$portada_imagen = $noticia->get('portada_imagen');
            //$parteNoticia = str_replace('VAR_NOMBRE',$titulo,$parteNoticia);
            $parteNoticia = str_replace('VAR_CUERPO',$cuerpo,$parteNoticia);
            //$parteNoticia = str_replace('VAR_IMAGEN_SRC',$portada_thumb,$parteNoticia);
            //$parteNoticia = str_replace('VAR_ESPECIALIDAD',$especialidad,$parteNoticia);
            //$parteNoticia = str_replace('VAR_LINK',$enlace_noticia,$parteNoticia);            
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
    public function getParteNoticia(){        
        $file_name = "html/partes/service.noticias.html";
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