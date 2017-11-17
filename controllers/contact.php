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
