$('#productForm').validate({
    errorClass: 'text-danger',
    rules: {
        tx_produto: {
            required: true,
        },
        vl_preco_custo:{
            number: true
        },
        vl_preco_de:{
            number: true
        },
        vl_preco_por:{
            number: true
        },
        nr_peso:{
            number: true
        },
        nr_altura:{
            number: true
        },
        nr_largura:{
            number: true
        },
        nr_profundidade:{
            number: true
        },
        'categorias[]': {
            required: true,
            minlength: 1
        },
    },
    messages: {
        tx_produto: {
            required: 'Insira o nome do produto',
        },
        'categorias[]': {
            required: 'Selecione pelo menos uma categoria',
        }
    }
});
