<?php 

    namespace Source\App\Renderers;
    use League\Plates\Engine;
    use Source\App\Controller;
use Source\Models\Products;

    class HomeController implements Controller{

        public function __construct(){
            // Directory of this controller's view
            $directory = __DIR__ . "/" . "../../.././views";
            $this->view = new Engine($directory);
        }

        public function render(){
            echo $this->view->render('home', [
                "title" => 'Homepage',
                "products" => (new Products)->get()
            ]);
        }
    }