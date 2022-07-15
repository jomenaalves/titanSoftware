<?php $this->layout('/theme/_theme'); ?>

<?php $this->unshift('head') ?>
    <title> <?= $this->e($title) ?> </title>
    <link rel="stylesheet" href="<?= PATH_OF_YOUR_APP . "/assets/css/style.css" ?>">
<?php $this->end() ?>


<?php $this->unshift('mainContent');?>
    <main>
        <div class="container">

            <div class="add-product">
                <p>Cadastrar novo produto</p>

                <form id="formAddProduct">
                    <div class="add-product-form">
                        <div class="form-group">
                            <label for="name">Nome do produto</label>
                            <input type="text" name="name" id="name" value="" required>
                        </div>
    
                        <div class="form-group">
                            <label for="name">Cor do produto</label>
                            <select name="color" id="color" required>
                                <option value="1" selected>Vermelho</option>
                                <option value="2">Azul</option>
                                <option value="3">Amarelo</option>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="name">Preço do produto</label>
                            <input type="text" name="price" id="price" value="" required>
                        </div>
                    </div>

                    <div class="buttons">
                        <button type="button" class="close" id="closeProduct">Fechar</button>
                        <button type="submit" class="save">Salvar Produto</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <p>Listagem de produtos</p>  
                    <button id="addProduct">Adiconar Produto</button>
                </div>

                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome do Produto</th>
                                <th>Cor</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <td> <?= $product['name_product'] ?> </td>
                                    <td>
                                        <div class="color color-<?= $product['color_product'] ?>"></div>
                                    </td>
                                    <td>
                                        <div>
                                            <small>
                                                <s>
                                                    R$ <?= number_format($product['price_initial'], 2, ',', '.') ?>
                                                </s>
                                            </small>
                                        </div>
                                        R$ <?= number_format($product['price'], 2, ',', '.'); ?>
                                        <?php if($product['color_product'] == 1): ?>
                                            <!-- DESCONTO DE 20% ou 5% -->
                                            <small class="discount">
                                                <?= $product['price_initial'] > 50 ? '-5%' : '-20%' ?> OFF
                                            </small>
                                        <?php endif; ?>
                                        <?php if($product['color_product'] == 2): ?>
                                            <!-- DESCONTO DE 20% -->
                                            <small class="discount">-20% OFF</small>
                                        <?php endif; ?>
                                        <?php if($product['color_product'] == 3): ?>
                                            <small class="discount">-10% OFF</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <svg xmlns="http://www.w3.org/2000/svg" data-remove="trash" data-id="<?= $product['id_product'] ?>" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/></svg>
                                        <svg xmlns="http://www.w3.org/2000/svg"  data-update="update" data-id="<?= $product['id_product'] ?>" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M421.7 220.3L188.5 453.4L154.6 419.5L158.1 416H112C103.2 416 96 408.8 96 400V353.9L92.51 357.4C87.78 362.2 84.31 368 82.42 374.4L59.44 452.6L137.6 429.6C143.1 427.7 149.8 424.2 154.6 419.5L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3zM492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75z"/></svg>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-body-js">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome do Produto</th>
                                <th>Cor</th>
                                <th>Preço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="mountTR">

                        </tbody>
                    </table>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </main>

    <!--  MODAL DE EDIÇÃO DO PRODUTO -->
    <div class="modal">
        <div class="contentModal">
            <div class="modal-header">
                <p> Atualizar produto - <span id="name-product-modal"> Nome do produto </span></p> 
            </div>

            <div class="modal-body">
                <form id="updateProduct" action="">
                    <input type="hidden" name="idProduct" id="idProduct" value="">
                    <div class="update-product-form">
                        <div class="form-group">
                            <label for="name">Nome do produto</label>
                            <input type="text" name="nameProduct" id="nameProduct">
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Preço do produto</label>
                            <input type="text" name="priceProduct" id="priceProduct">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="color">Cor do produto <small>(Não editavél)</small></label>
                        <span class="color" data-color="color"></span>
                    </div>

                    <div class="buttons">
                        <button type="button" class="closeUpdate">Fechar</button>
                        <button type="submit" class="save">Atualizar produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= PATH_OF_YOUR_APP . 'assets/js/HomeController.js'?>"></script>
    <script>
        function removeProduct(id){
            
            const confirmResponse = confirm('Tem certeza que deseja deletar esse produto?');
            if(confirmResponse){
                const formData = new FormData();
                formData.append('id', id);

                const URL = `/api/removeProduct/${id}`;
                fetch(URL, {method: 'DELETE'}).then(response => {
                    return response.json();
                }).then(response => {
                    if(response.status == 204){
                        alert(response.msg);
                        window.location.reload();
                        return;
                    }

                    alert(response.msg);
                })
            }
        }
        function mountModal(id){
            // abrir modal
            const modal = document.querySelector('.modal'); 
            modal.classList.add('show-f');

            // adicionar informações nos inputs 
            const URL = `/api/get/${id}`;
            fetch(URL).then(response => {
                return response.json();
            }).then(({data}) => {
                document.querySelector('#nameProduct').value = data.name_product;
                document.querySelector('#priceProduct').value = data.price_initial;
                document.querySelector('#idProduct').value = data.id_product;
                document.querySelector('[data-color="color"]').classList.add(`color-${data.color_product}`);
            })

        }

    </script>
<?php $this->end() ?>