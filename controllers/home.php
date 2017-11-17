<?php

require_once 'lib/maincontroller.php';


class Home extends MainController {
    protected $page = 'Inicio';

    protected $tpl = 'pages:home.html';

    public function index() {
        $vars = array();
        require_once 'config/inhouse.php';
        $api = get_inhouse_api();

        //First Title 12648
        $firstTitle = $api->getTexto(12648);
        $vars['firstTitleTitle'] = $firstTitle->get('titulo');   
        $vars['firstTitleCuerpo'] = $firstTitle->get('cuerpo');       
        
        //First Icon 01 (id: 12649)
        $firstIcon = $api->getTexto(12649);
        $vars['firstIconTitle'] = $firstIcon->get('titulo');
        $vars['firstIconCuerpo'] = $firstIcon->get('cuerpo');
        $vars['firstIconPortada'] = $firstIcon->get_portada();
        // [#:firstIconTitle]  [#:firstIconCuerpo] [#:firstIconPortada]

        //second Icon 01 (id: 12650)
        $secondIcon = $api->getTexto(12650);
        $vars['secondIconTitle'] = $secondIcon->get('titulo');
        $vars['secondIconCuerpo'] = $secondIcon->get('cuerpo');
        $vars['secondIconPortada'] = $secondIcon->get_portada();
        // [#:secondIconTitle]  [#:secondIconCuerpo] [#:secondIconPortada]

         //third Icon 01 (id: 12651)
         $thirdIcon = $api->getTexto(12651);
         $vars['thirdIconTitle'] = $thirdIcon->get('titulo');
         $vars['thirdIconCuerpo'] = $thirdIcon->get('cuerpo');
         $vars['thirdIconPortada'] = $thirdIcon->get_portada();
         // [#:thirdIconTitle]  [#:thirdIconCuerpo] [#:thirdIconPortada]   
         
        //fourth Icon 01 (id: 12652)
        $fourthIcon = $api->getTexto(12652);
        $vars['fourthIconTitle'] = $fourthIcon->get('titulo');
        $vars['fourthIconCuerpo'] = $fourthIcon->get('cuerpo');
        $vars['fourthIconPortada'] = $fourthIcon->get_portada();
        // [#:fourthIconTitle]  [#:fourthIconCuerpo] [#:fourthIconPortada]

        //Second Title
        $secondTitle = $api->getTexto(12653);
        $vars['secondTitleTitle'] = $secondTitle->get('titulo');
        $vars['secondTitleCuerpo'] = $secondTitle->get('cuerpo');
        $vars['secondTitlePortada'] = $secondTitle->get_portada();
        // [#:secondTitleTitle]  [#:secondTitleCuerpo] [#:secondTitlePortada]


        //Highlighted Services (id: 12655)
        // Obtener las noticias
        $highlightedNoticia = $api->getNoticias(12655);
        // leer el contenido html de la plantilla para cada noticia
        $parteNoticiaOriginal = $this->getParteNoticia();
        $noticias = "";
        $x=0;
        
        foreach($highlightedNoticia as $noticia) {
            $parteNoticia = $parteNoticiaOriginal;
            $id = $noticia->get('id');
            $titulo = $noticia->get('titulo');
            $cuerpo = $noticia->get('cuerpo');
            $enlace_noticia= $noticia->get('enlace');
            $portada_thumb = 'http://admininhouse.com/'.$noticia->get('portada_thumb');
            $portada_imagen = $noticia->get('portada_imagen');
            $parteNoticia = str_replace('VAR_TITULO',$titulo,$parteNoticia);
            $parteNoticia = str_replace('VAR_CUERPO',$cuerpo,$parteNoticia); 
            $parteNoticia = str_replace('VAR_IMAGEN_SRC',$portada_thumb,$parteNoticia); 
            $noticias .= $parteNoticia;
            $x++;            
        }
        //echo '<pre>';print_r($parteNoticia);echo '</pre>';
        $vars['noticias'] = $noticias;

        //Quotes Background (id: 12689)
        $galerias = $api->getGalerias(12689);        
        foreach($galerias as $galeria){        }        
        $galeria = $api->getGaleria($galeria->get('id'));
        $imagenes = $galeria->get_galeria();
        foreach($imagenes as $imagen){            
            $cover = $imagen->get_imagen();
        }
        $vars['quotesCover'] = $cover; // [#:quotesCover] 


        //Quotes (id: 12690)
        // Obtener las noticias
        $quotesNoticia = $api->getNoticias(12690);
        // leer el contenido html de la plantilla para cada noticia
        $parteNoticiaOriginal = $this->getParteQuote();
        $noticias = "";
        $x=0;
        
        foreach($quotesNoticia as $noticia) {
            $parteNoticia = $parteNoticiaOriginal;
            $id = $noticia->get('id');
            $cuerpo = $noticia->get('cuerpo');
            $parteNoticia = str_replace('VAR_CUERPO',$cuerpo,$parteNoticia); 
            $quotes .= $parteNoticia;
            $x++;            
        }
        //echo '<pre>';print_r($quotesNoticia);echo '</pre>';
        $vars['quotes'] = $quotes;// [#:quotes] 

        
        //Third Title (id: 12657)
        $thirdTitle = $api->getTexto(12657);
        $vars['thirdTitleTitle'] = $thirdTitle->get('titulo');
        $vars['thirdTitleCuerpo'] = $thirdTitle->get('cuerpo');
        $vars['thirdTitlePortada'] = $thirdTitle->get_portada();
        // [#:thirdTitleTitle]  [#:thirdTitleCuerpo] [#:thirdTitlePortada]
        

/*
        //Second Title
        $secondTitle = $api->getTexto(12709);
        $vars['secondTitleTitle'] = $secondTitle->get('titulo');
        $vars['secondTitleCuerpo'] = $secondTitle->get('cuerpo');
        $vars['secondTitlePortada'] = $secondTitle->get_portada();

        

        //Fourth Title (id: 12712)
        $fourthTitle = $api->getTexto(12712);
        $vars['fourthTitleTitle'] = $fourthTitle->get('titulo');
        $vars['fourthTitleCuerpo'] = $fourthTitle->get('cuerpo');

        // Fifth Title (id: 12713)
        $fifthTitle = $api->getTexto(12713);
        $vars['fifthTitleTitle'] = $fifthTitle->get('titulo');
        $vars['fifthTitleCuerpo'] = $fifthTitle->get('cuerpo');
        $vars['fifthTitlePortada'] = $fifthTitle->get_portada();
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
    public function getParteNoticia(){        
        $content = '
        <div class="item single-product">
            <img class="img-responsive" src="VAR_IMAGEN_SRC" alt="">
            <div class="info">
                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                <h2>VAR_TITULO</h2>
            </div>
        </div>';
        return $content;
    }

    public function getParteQuote(){        
        $content = '<div class="singel-quotation">
            <div class="text-table">
                <div class="text-tablecell">
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                VAR_CUERPO
                            </div>
                        </div>
                </div>
            </div>
        </div>';
        return $content;
    }

}
