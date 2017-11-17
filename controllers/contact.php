<?php
require_once 'lib/maincontroller.php';

class Contact extends MainController {
    protected $page = 'Contact';
    protected $tpl = 'pages:contact.html';

    public function index() {
        $vars = array();
        require_once 'config/inhouse.php';
        $api = get_inhouse_api();


        //Background (id: 12740)
        $galerias = $api->getGalerias(12740);        
        foreach($galerias as $galeria){        }        
        $galeria = $api->getGaleria($galeria->get('id'));
        $imagenes = $galeria->get_galeria();
        foreach($imagenes as $imagen){            
            $cover = $imagen->get_imagen();
        }
        $vars['cover'] = $cover;       
        //echo '<pre>';print_r($cover);echo '</pre>';
        //contact  First Title (id: 12755)
        $firstTitle = $api->getTexto(12755);
        $vars['firstTitleTitle'] = $firstTitle->get('titulo'); 
        $vars['firstTitleCuerpo'] = $firstTitle->get('cuerpo');

        //Second Title (id: 12756)
        $secondTitle = $api->getTexto(12756);
        $vars['secondTitleTitle'] = $secondTitle->get('titulo'); 
        $vars['secondTitleCuerpo'] = $secondTitle->get('cuerpo');
        $vars['secondTitleCuerpo'] = str_replace('<p>','',$vars['secondTitleCuerpo'] );
        $vars['secondTitleCuerpo'] = str_replace('</p>','',$vars['secondTitleCuerpo'] );
        //Third Title (id: 12748)
        $thirdTitle = $api->getTexto(12757);
        $vars['thirdTitleTitle'] = $thirdTitle->get('titulo');
        $vars['thirdTitleCuerpo'] = $thirdTitle->get('cuerpo');
        $vars['thirdTitleCuerpo'] = str_replace('<p>','',$vars['thirdTitleCuerpo'] );
        $vars['thirdTitleCuerpo'] = str_replace('</p>','',$vars['thirdTitleCuerpo'] );
        // [#:thirdTitleTitle]  [#:thirdTitleCuerpo] [#:thirdTitlePortada]



/*
        //Service Gallery (id: 12721)
        $galerias = $api->getGalerias(12730);        
        foreach($galerias as $galeria){}
        $galeria = $api->getGaleria($galeria->get('id'));
        $imagenes = $galeria->get_galeria();        
        $slideImages = "";
        foreach($imagenes as $imagen){
            $slideImages .= '<div class="singel-installation bg-img" style="background-image: url('.$imagen->get_imagen().')"></div>';
        }
        $vars['slideImages'] = $slideImages;

        // HotelsTitle (id: 12746)
        $hotelsTitle = $api->getTexto(12746);
        $vars['hotelsTitleTitle'] = $hotelsTitle->get('titulo'); 
        $vars['hotelsTitleCuerpo'] = $hotelsTitle->get('cuerpo');

        //hotels (id: 12747)
        // Obtener las noticias
        $doctoresNoticia = $api->getNoticias(12747);
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
            $portada_thumb = 'http://admininhouse.com/'.$noticia->get('portada_thumb');
            $portada_imagen = $noticia->get('portada_imagen');
            $parteNoticia = str_replace('VAR_NOMBRE',$titulo,$parteNoticia);
            //$parteNoticia = str_replace('VAR_CUERPO',$cuerpo,$parteNoticia);
            $parteNoticia = str_replace('VAR_IMAGEN_SRC',$portada_thumb,$parteNoticia);          
            $noticias .= $parteNoticia;
            $x++;            
        }        
        $vars['noticias'] = $noticias;

        //Third Title (id: 12748)
        $thirdTitle = $api->getTexto(12748);
        $vars['thirdTitleTitle'] = $thirdTitle->get('titulo');
        $vars['thirdTitleCuerpo'] = $thirdTitle->get('cuerpo');
        // [#:thirdTitleTitle]  [#:thirdTitleCuerpo] [#:thirdTitlePortada]

        //Fourth Title (id: 12749)
        $fourthTitle = $api->getTexto(12749);
        $vars['fourthTitleTitle'] = $fourthTitle->get('titulo');
        $vars['fourthTitleCuerpo'] = $fourthTitle->get('cuerpo');
        $vars['fourthTitlePortada'] = $fourthTitle->get_portada();
        // [#:fourthTitleTitle]  [#:fourthTitleCuerpo] [#:fourthTitlePortada]

        // Fifth Title (id: 12750)
        $fifthTitle = $api->getTexto(12750);
        $vars['fifthTitleTitle'] = $fifthTitle->get('titulo');
        $vars['fifthTitleCuerpo'] = $fifthTitle->get('cuerpo');
        $vars['fifthTitlePortada'] = $fifthTitle->get_portada();
        // [#:fifthTitleTitle]  [#:fifthTitleCuerpo] [#:fifthTitlePortada]
*/
        return $vars;
    }

    public function mensaje() {
        $this->setTpl('pages:texto.html');
        $vars = array();
        $vars['titulo'] = 'Esta es una prueba';
        $vars['cuerpo'] = 'lorem ipsum ...';
        return $vars;
    }      
    
    /*public function getParteNoticia(){        
        $content = '
        <div class="col-md-3 col-sm-6">
            <div class="item single-product">
                <img class="img-responsive" src="VAR_IMAGEN_SRC" alt="">
                <div class="info">
                    <h2>VAR_NOMBRE</h2>
                </div>
            </div>
        </div>';
        return $content;
    }*/
}