class HomeController{

    constructor(){
        this.initEvents();
    }

    initEvents(){
        const addProductButton = document.querySelector('#addProduct');
        const contentAddProduct = document.querySelector('.add-product');

        // Abrir conteudo para cadastrar produto
        addProductButton.addEventListener('click', (element) => {
            contentAddProduct.classList.add('show')
        });

        // Fechar conteudo para cadastrar produto
        const btnClose = document.querySelector('#closeProduct');
        btnClose.addEventListener('click', () => {
            contentAddProduct.classList.remove('show');
        });

        const formAddProduct = document.querySelector('#formAddProduct');
        formAddProduct.addEventListener('submit', (e) => {
            e.preventDefault();
            this.addProduct(formAddProduct);
        });

        const deleteProductBtn = document.querySelectorAll('[data-remove="trash"]');
        deleteProductBtn.forEach((element) => {
            element.addEventListener('click', (e) => {
                const confirmResponse = confirm('Tem certeza que deseja deletar esse produto?');
                if(confirmResponse){
                    console.log(element.dataset.id);
                    this.removeProduct(element.dataset.id);
                }
            })
        })

        const updateProductModal = document.querySelectorAll('[data-update="update"]');
        updateProductModal.forEach(element => {
            element.addEventListener('click', () => {
                const id = element.dataset.id;
                this.mountModal(id);
            })
        })

        const closeUpdate = document.querySelector('.closeUpdate');
        closeUpdate.addEventListener('click', () => {
            const modal = document.querySelector('.modal'); 
            modal.classList.remove('show-f');
        });

        const updateProduct = document.querySelector('#updateProduct');
        updateProduct.addEventListener('submit', (e) => {
            e.preventDefault();
            this.updateProduct(updateProduct);
        })

        const searchInput = document.querySelector('#searchInput');
        const container = document.querySelector('.card-body');
        const tableJS = document.querySelector('.card-body-js');

        searchInput.addEventListener('keyup', () => {
            const val = searchInput.value;

            if(val.length > 0){
                container.classList.add('hide');   
                this.mountTable(val);
                return;
            }

            tableJS.classList.remove('show');
            container.classList.remove('hide');  
            console.log(val.length, container);
        })
    }

    addProduct(form){

        const formData = new FormData(form);

        const URL = '/api/addProduct';
        fetch(URL, {method: 'POST', body: formData}).then(response => {
            return response.json();
        }).then(response => {
            if(response.status == 201){
                alert(response.msg);
                window.location.reload();
                return;
            }

            alert(response.msg);
        })
    }

    removeProduct(id){
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

    updateProduct(form){
        
        const formData = new FormData(form);

        const URL = '/api/updateProduct';
        fetch(URL, {method: 'POST', body: formData}).then(response => {
            return response.json();
        }).then(response => {
            if(response.status == 200){
                alert(response.msg);
                window.location.reload();
                return;
            }

            alert(response.msg);
        })

    }
    
    mountModal(id){
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

    mountTable(value){
        const tableJS = document.querySelector('.card-body-js');
        const mount = document.querySelector('.mountTR');
        const formData = new FormData();
        formData.append('name', value);
        
        tableJS.classList.add('show');
        let tRows = "";
        
        // filtro de produtos parecidos
        const URL = `/api/like`;
        fetch(URL, {method: 'POST', body: formData}).then(response => {
            return response.json();
        }).then(({data}) => {

            if(data.length == 0){
                const error = document.querySelector('.error');
                error.innerHTML = 'Nenhum produto encontrado!';
            }

           data.forEach(element => {
            let discount = "";

            if(element.color_product == 1){
                discount = `
                    <small class="discount">
                        ${element.price_initial > 50 ? '-5%' : '-20%'} OFF
                    </small>
                `;
            }

            if(element.color_product == 2){
                discount = `
                    <small class="discount">-20% OFF</small>
                `;
            }

            if(element.color_product == 3){
                discount = `
                    <small class="discount">-10% OFF</small>
                `;
            }
                tRows += `
                    <tr>
                        <td>${element.name_product}</td>
                        <td>
                            <div class="color color-${element.color_product}"></div>
                        </td>
                        <td>
                            <div>
                                <small>
                                    <s>
                                        R$ ${(element.price_initial).toLocaleString(['pt-br'])}
                                    </s>
                                </small>
                            </div>


                            R$  ${(element.price).toLocaleString(['pt-br'])}
                            ${discount}
                        </td>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" onclick="removeProduct(${element.id_product})" data-remove="trashL" data-id="${element.id_product}" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" onclick="mountModal(${element.id_product})" data-update="updateL" data-id="${element.id_product}" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M421.7 220.3L188.5 453.4L154.6 419.5L158.1 416H112C103.2 416 96 408.8 96 400V353.9L92.51 357.4C87.78 362.2 84.31 368 82.42 374.4L59.44 452.6L137.6 429.6C143.1 427.7 149.8 424.2 154.6 419.5L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3zM492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75z"/></svg>
                        </td>
                    </tr>
                `;
           });
           mount.innerHTML = tRows;
        })

    }
}


new HomeController();