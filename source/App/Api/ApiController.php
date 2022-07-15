<?php 

    namespace Source\App\Api;

    use Source\Models\Products;

    class ApiController {

        public function __construct()
        {
            header('Content-Type: application/json; charset=utf-8');
        }

        /**
         * Route POST: '/api/addProduct'
         * Role responsible from add product in db
         */
        public function addProduct():void
        {
            try {
                $products = (new Products())->add($_POST['name'], $_POST['color'], $_POST['price']);
                echo json_encode(['status' => 201, 'msg' => 'Produto adicionado com sucesso!']);
            } catch (\Throwable $th) {
                echo json_encode(['status' => 500, 'msg' => 'Erro interno!' . $th->getMessage()]);
            }
        }

        /**
         * Route DELETE: '/api/deleteProduct/{id}'
         * Role responsible for delete product in db
         */
        public function removeProduct(Array $data):void
        {
            try {
                $products = (new Products())->remove((int) $data['id']);
                echo json_encode(['status' => 204, 'msg' => 'Produto removido com sucesso!']);

            } catch (\Throwable $th) {
                echo json_encode(['status' => 500, 'msg' => 'Erro interno!' . $th->getMessage()]);
            }
        }


        /**
         * Route GET: 'api/get/{id}'
         * Role responsible for get specif product by id
         */
        public function get(Array $data):void
        {
            try {
                $product = (new Products())->getByID((int) $data['id']);
                echo json_encode(['status' => 200, 'data' => $product]);

            } catch (\Throwable $th) {
                echo json_encode(['status' => 500, 'msg' => 'Erro interno!' . $th->getMessage()]);
            }
        }

        /**
         * Route PUT: 'api/updateProduct'
         * Role responsible for update product in db
         */
        public function updateProduct():void
        {
            try {
                $product = (new Products())->update($_POST);
                echo json_encode(['status' => 200,  'msg' => 'Produto atualizado com sucesso!', 'data' => $product]);

            } catch (\Throwable $th) {
                echo json_encode(['status' => 500, 'msg' => 'Erro interno!' . $th->getMessage()]);
            }
        }

        /**
         * Route POST: '/api/like'
         * Role responsible for filter products by name
         */
        public function like():void 
        {   

            try {
                $product = (new Products())->like($_POST['name']);
                echo json_encode(['status' => 200, 'data' => $product]);

            } catch (\Throwable $th) {
                echo json_encode(['status' => 500, 'msg' => 'Erro interno!' . $th->getMessage()]);
            }
        }
    }


