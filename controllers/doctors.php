<?php
require_once 'lib/maincontroller.php';

class Doctors extends MainController {
    protected $page = 'Doctors';
    protected $tpl = 'pages:doctors.html';

    public function index() {
        $vars = array();
        require_once 'config/inhouse.php';
        $api = get_inhouse_api();
        //First Title (id: 12724)
        $firstTitle = $api->getTexto(12724);
        $vars['firstTitleTitle'] = $firstTitle->get('titulo'); 
        $vars['firstTitleCuerpo'] = $firstTitle->get('cuerpo'); 
        $vars['firstTitlePortada'] = $firstTitle->get_portada();

        //Second Title (id: 12726)
        $secondTitle = $api->getTexto(12726);
        $vars['secondTitleTitle'] = $secondTitle->get('titulo');
        $vars['secondTitleCuerpo'] = $secondTitle->get('cuerpo');
        $vars['secondTitlePortada'] = $secondTitle->get_portada();

        //Doctors (id: 12725)
        // Obtener las noticias
        $doctoresNoticia = $api->getNoticias(12725);
        // leer el contenido html de la plantilla para cada noticia
        $parteNoticiaOriginal = $this->getParteNoticia();
        $noticias = "";
        $x=0;
        foreach($doctoresNoticia as $noticia) {
            $parteNoticia = $parteNoticiaOriginal;
            $id = $noticia->get('id');
            $idGaleria = $noticia->get('id_galeria');
            $titulo = $noticia->get('titulo');
            $cuerpo = $noticia->get('cuerpo');
            $enlace_noticia= $noticia->get('enlace');
            $especialidad = $this->getEspecialidad($idGaleria);
            if(!$enlace_noticia){
                $enlace_noticia = './doctor?id='.$id;
            }
            $portada_thumb = 'http://admininhouse.com/'.$noticia->get('portada_thumb');
            $portada_imagen = $noticia->get('portada_imagen');
            $parteNoticia = str_replace('VAR_NOMBRE',$titulo,$parteNoticia);
            $parteNoticia = str_replace('VAR_CUERPO',$cuerpo,$parteNoticia);
            $parteNoticia = str_replace('VAR_IMAGEN_SRC',$portada_thumb,$parteNoticia);
            $parteNoticia = str_replace('VAR_ESPECIALIDAD',$especialidad,$parteNoticia);
            $parteNoticia = str_replace('VAR_LINK',$enlace_noticia,$parteNoticia);            
            $noticias .= $parteNoticia;
            $x++;            
        }
        
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
        $file_name = "html/partes/doctors.noticias.html";
        $file_data = fopen($file_name, "r");
        if ( !$file_data )
        {
            throw new RenderException( _('No se pudo leer la parte de la plantilla') );
        }
        $content = fread( $file_data, filesize( $file_name ) );
        fclose( $file_data );
        return $content;
    }

    function getEspecialidad($gaelryId){
        require_once 'config/inhouse.php';
        $api = get_inhouse_api();
        $galeria = $api->getGaleria($gaelryId);
        $imagenes = $galeria->get_galeria();        
        foreach($imagenes as $imagen){
            $datosImagen = $imagen;
        }        
        if($datosImagen){
            return $datosImagen->get('nombre_media');
        }else{
            return null;
        }
    }
}