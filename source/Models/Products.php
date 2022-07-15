<?php 

    namespace Source\Models; 
    use Source\Database\Database;

    class Products {

        private object $conn;

        public function __construct(){
            $this->conn = (new Database)->getConn();
        }

        public function add(String $name, Int $color, String $price){

            $name = isset($name) ? \filter_var($name, FILTER_SANITIZE_ADD_SLASHES) : null;
            $color = isset($color) ? \filter_var($color, FILTER_SANITIZE_NUMBER_INT) : null;
            $price = isset($price) ? intval(($price * 100))/100 : null;

            try {

                $priceDiscount = $this->rules($price, $color);

                $stmt = $this->conn->prepare("INSERT INTO products (name_product, color_product) VALUES (:name_product, :color_product)");
                $stmt->execute(['name_product' => $name, 'color_product' => $color]);

                // pegar id do produto inserido
                $stmt = $this->conn->prepare("SELECT id_product FROM products ORDER BY id_product DESC LIMIT 1");
                $stmt->execute();
                
                $last_id = $stmt->fetch(\PDO::FETCH_ASSOC)['id_product'];

                $stmt = $this->conn->prepare("INSERT INTO price (id_product, price, price_initial) VALUES (:id_product, :price, :price_initial)");
                $stmt->execute(['id_product' => $last_id, 'price' => $priceDiscount, 'price_initial' => $price]);


            } catch (\Throwable $th) {
                throw $th->getMessage();
            }
        }


        public function get(): array
        {
            $stmt = $this->conn->prepare("SELECT * FROM products AS p INNER JOIN price AS pr WHERE p.id_product = pr.id_product ORDER BY p.id_product DESC LIMIT 20");
            $stmt->execute([]);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function remove(Int $id):void
        {
            $stmt = $this->conn->prepare("DELETE FROM products WHERE id_product = :id_product");
            $stmt->execute(['id_product' => $id]);

            $stmt = $this->conn->prepare("DELETE FROM price WHERE id_product = :id_product");
            $stmt->execute(['id_product' => $id]);
            
        }


        private function rules(Int $price, Int $color): int
        {
            if($color == 1){ // Vermelho
                if($price > 50){ // Aplicar desconto de 5%
                    return ($price - ($price / 100 * 5));
                }

                // Aplicar desconto de 20% 
                return ($price - ($price / 100 * 20));
            }

            if($color == 2){ // azul 
                return ($price - ($price / 100 * 20));
            }
            
            if($color == 3){ // azul 
                return ($price - ($price / 100 * 10));
            }
        }

        public function getByID(Int $id):array
        {

            $stmt = $this->conn->prepare("SELECT * FROM products AS p INNER JOIN price AS pr WHERE p.id_product = pr.id_product AND p.id_product = :id_product");
            $stmt->execute(['id_product' => $id]);

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function update(Array $data):void
        {   
            $product = $this->getByID($data['idProduct']);

            $name = isset($data['nameProduct']) ? \filter_var($data['nameProduct'], FILTER_SANITIZE_ADD_SLASHES) : null;
            $price = isset($data['priceProduct']) ? intval(($data['priceProduct'] * 100))/100 : null;
            
            try {
                $priceDiscount = $this->rules($price, $product['color_product']);

                $stmt = $this->conn->prepare("UPDATE products SET name_product = :name_product WHERE id_product = :id_product");
                $stmt->execute(['id_product' => $data['idProduct'], 'name_product' => $name]);

                $stmt = $this->conn->prepare("UPDATE price SET price = :price, price_initial = :price_initial WHERE id_product = :id_product");
                $stmt->execute(['id_product' => $data['idProduct'], 'price' => $priceDiscount, 'price_initial' => $price]);

            }catch (\Throwable $th) {
                throw $th->getMessage();
            }
        }

        public function like(String $name):array
        {
            $name = "%".$name."%";
            $stmt = $this->conn->prepare("SELECT * FROM products AS p INNER JOIN price AS pr ON pr.id_product = p.id_product WHERE p.name_product LIKE :name_product ORDER BY p.id_product DESC LIMIT 20");
            $stmt->execute(['name_product' => $name]);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }