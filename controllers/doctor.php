<?php
require_once 'lib/maincontroller.php';

class Doctor extends MainController {
    protected $page = 'Doctor';
    protected $tpl = 'pages:doctor.html';

    public function index() {
        $vars = array();
        require_once 'config/inhouse.php';
        $api = get_inhouse_api();        

        //Doctors (id: 12725)
        // Obtener las noticias
        if($_GET['id']){            
            $noticiaId = (int) $_GET['id'];
        }else{
            $noticiaId = 0;
        }
        $doctorNoticia = $api->getNoticia($noticiaId);

            $id = $doctorNoticia->get('id');
            $idGaleria = $doctorNoticia->get('id_galeria');
            $titulo = $doctorNoticia->get('titulo');
            $cuerpo = $doctorNoticia->get('cuerpo');
            //$especialidad = $this->getEspecialidad($idGaleria);            
            $portada_thumb = 'http://admininhouse.com/'.$doctorNoticia->get('portada_thumb');
            $portada_imagen = $doctorNoticia->get('portada_imagen');
            $galeria = $api->getGaleria($idGaleria);
            $imagenes = $galeria->get_galeria();        
            foreach($imagenes as $imagen){
                $datosImagen = $imagen;
            }
            $nombre_media = $datosImagen->get('nombre_media');
            $descripcion_media = $datosImagen->get('descripcion_media');        
        
        $vars['doctorTitulo'] = $titulo;
        $vars['doctorCuerpo'] = $cuerpo;
        $vars['doctorImagen'] = $portada_thumb;
        $vars['doctorNombreMedia'] = $nombre_media;
        $vars['doctorDescripcionMedia'] = $descripcion_media;

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
            $nombre_media = $datosImagen->get('nombre_media');
            $descripcion_media = $datosImagen->get('descripcion_media');
            $datosImagen->get('nombre_media');
            return $datosImagen->get('nombre_media');
        }else{
            return null;
        }
    }
}