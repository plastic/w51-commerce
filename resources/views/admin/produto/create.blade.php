@extends('layouts/contentLayoutMaster')

@section('title', 'Produto')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-produtos.css')) }}">
@endsection
<style>
    .w-87px {
        /* width: 87px !important; */
        min-width: 87px !important;
    }

    .w-105px {
        /* width: 105px !important; */
        min-width: 105px !important;
    }

    .w-105px {
        /* width: 105px !important; */
        min-width: 105px !important;
    }

    .w-230px {
        /* width: 230px !important; */
        min-width: 230px !important;
    }

    .w-330px {
        /* width: 320px !important; */
        min-width: 320px !important;
    }

    .linha {
        overflow-x: auto;
        white-space: nowrap;

    }

    .linha table {
        width: 100%;
    }


    /* width */
    .linha::-webkit-scrollbar {
        height: 8px;
    }

    /* Handle */
    .linha::-webkit-scrollbar-thumb {
        background: #7367f0;
        border-radius: 10px;
    }

    /* Handle on hover */
    .linha::-webkit-scrollbar-thumb:hover {
        background: #7367f0;
    }

    .atributos-header {
        display: none;
    }

    .atributos-input {
        display: none;
    }

    .dimensoes-header {
        display: none;
    }

    .dimensoes-input {
        display: none;
    }

    .image-upload>input {
        display: none;
    }
</style>
@section('content')
    <!-- Kick start -->

    @if ($errors->any())
        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
            <p class="ps-1 pt-1 pb-0"><strong>Oops... Algo deu errado</strong></p>
            <ul class="alert-body">
                @foreach ($errors->all() as $error)
                    <li class="list-unstyled"> <i data-feather="info" class="me-50"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('produto.store') }}" enctype="multipart/form-data" id="productForm">
        @csrf

        <section class="horizontal-wizard">
            <div class="bs-stepper horizontal-example">
                <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">1</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Detalhes</span>
                                <span class="bs-stepper-subtitle">Informações gerais</span>
                            </span>
                        </button>
                    </div>
                    <div class="line" id="personal-info-trigger-arrow" style="display:none">
                        <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger"
                        style="display:none">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">2</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Variações</span>
                                <span class="bs-stepper-subtitle">Produtos X</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">

                        <div class="row">

                            <div class="mb-1 col-12">
                                <label class="form-label">Nome do produto</label>
                                <input type="text" class="form-control" name="tx_produto" placeholder="Nome"
                                    maxlength="250" value="{{ old('tx_produto') }}" />
                            </div>

                            <div class="mb-1 col-12 mb-5 pb-3">
                                <label class="form-label">Descrição</label>
                                <div id="editor">
                                </div>
                                <textarea name="tx_descricao" style="display:none" id="hiddenTextArea">{{ old('tx_produto') }}</textarea>
                            </div>

                            <div class="col-md-6 ">
                                <label class="form-label" for="select2-basic">Marca</label>
                                <select class="select2 form-select" name="id_marca" id="select2-basic">
                                    <option value="">Selecione...</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id_marca }}">{{ $marca->tx_marca }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <hr class="my-2">

                        <div class="row">

                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Tipo de produto</label>
                                    <div class="demo-inline-spacing">
                                        <div class="form-check form-check-inline mt-0">
                                            <input class="form-check-input" type="radio" name="tp_produto"
                                                id="inlineRadio1" value="FISICO" checked />
                                            <label class="form-check-label" for="inlineRadio1">Físico</label>
                                        </div>
                                        <div class="form-check form-check-inline mt-0">
                                            <input class="form-check-input" type="radio" name="tp_produto"
                                                id="inlineRadio2" value="VIRTUAL" />
                                            <label class="form-check-label" for="inlineRadio2">Virtual</label>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Produto com variação</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox" class="form-check-input" id="tp_variacao"
                                            name="tp_produto_variante" />
                                    </div>
                                </div>
                            </div>


                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Produto em destaque</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox" class="form-check-input" id="customSwitch4"
                                            name="tp_destaque" />
                                    </div>
                                </div>
                            </div>
                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Publicado</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox" checked class="form-check-input" name="st_publicado" />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="my-2">

                        <div class="row">
                            <div class="col-12">

                                <h4 class="card-title">Imagens do produto</h4>

                                <p class="card-text">
                                    Suba aqui as imagens do produto<code>1440x500 | jpg.png</code>
                                </p>


                                <div id="produtcimages">
                                    <div id="actions" class="dropzone dropzone-area">
                                        <div id="allImagesWrapper" class="col-lg-12 d-flex actions">

                                        </div>
                                        <label class="custom-file-label" for="files">
                                            <div class="dz-message " id="dz-message">Clique aqui ou arraste as imagens.
                                            </div>
                                        </label>
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-images-input" id="files"
                                                        name="images[]" hidden multiple limit=4 filesize=1500>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <input type="hidden" id="serialized" name="serialized">

                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-check-label mb-50">Vídeo do produto</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i data-feather='youtube'></i></span>
                                    <input type="text" class="form-control" name="tx_url_video"
                                        placeholder="Ex. https://www.youtube.com/watch?v=000"
                                        value="{{ old('tx_url_video') }}" />
                                </div>
                            </div>
                        </div>

                        <hr class="my-2 prices">

                        <div class="row prices">
                            <h4 class="card-title">Preços</h4>

                            <div class="  col-md-3">
                                <label class="form-check-label mb-50">Preço de custo</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" name="vl_preco_custo"
                                        value="{{ old('vl_preco_custo') }}">
                                </div>
                            </div>
                            <div class="  col-md-3">
                                <label class="form-check-label mb-50">Preço de venda (preço de)</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" name="vl_preco_de"
                                        value="{{ old('vl_preco_de') }}">
                                </div>
                            </div>
                            <div class=" col-md-3">
                                <label class="form-check-label mb-50">Preço promocional (preço por)</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" name="vl_preco_por"
                                        value="{{ old('vl_preco_por') }}">
                                </div>
                            </div>

                        </div>

                        <hr class="my-2 stock">

                        <div class="row stock">
                            <h4 class="card-title">Estoque</h4>

                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Venda ilimitada</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox" class="form-check-input" id="st_estoque"
                                            name="tp_venda" />
                                    </div>
                                </div>
                            </div>

                            <div class="  col-md-2 qnt">
                                <label class="form-check-label mb-50">Quantidade</label>
                                <input type="text" class="form-control" name="nr_quantidade"
                                    value="{{ old('nr_quantidade') }}">
                            </div>
                            <div class="  col-md-3">
                                <label class="form-check-label mb-50">SKU (Unidade de manutenção de estoque)</label>
                                <input type="text" class="form-control" name="tx_sku" value="{{ old('tx_sku') }}">
                            </div>
                            <div class=" col-md-3">
                                <label class="form-check-label mb-50">Código de barras (GTIN, EAN, ISBN, etc.)</label>
                                <input type="text" class="form-control" name="tx_isbn_ean"
                                    value="{{ old('tx_isbn_ean') }}">
                            </div>

                        </div>

                        <hr class="my-2 dimensoes">

                        <div class="row dimensoes">
                            <h4 class="card-title">Peso e dimensões</h4>

                            <div class="col-md-2">
                                <label class="form-check-label mb-50">Peso</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nr_peso"
                                        value="{{ old('nr_peso') }}">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label mb-50">Altura</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nr_altura"
                                        value="{{ old('nr_altura') }}">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label mb-50">Largura</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nr_largura"
                                        value="{{ old('nr_largura') }}">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label mb-50">Profundidade</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nr_profundidade"
                                        value="{{ old('nr_profundidade') }}">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>

                        </div>

                        <hr class="my-2">

                        <div class="row">
                            <h4 class="card-title">Categoria</h4>

                            <div class=" col-md-12">
                                <select class="select2 form-select select-dep-cat" name="categorias[]"
                                    id="select2-multiple" multiple>
                                </select>
                            </div>

                        </div>

                        <hr class="my-2">

                        <div class="row mb-2">
                            <h4 class="card-title">SEO</h4>

                            <div class="col-md-6">
                                <label class="form-check-label mb-50">URL do produto</label>
                                <input type="text" class="form-control" name="tx_url" value="{{ old('tx_url') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-check-label mb-50">Title</label>
                                <input type="text" class="form-control" name="tx_title"
                                    value="{{ old('tx_title') }}">
                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-check-label mb-50">Meta Tag Description</label>
                                <textarea class="form-control" name="tx_meta_description" placeholder="Descrição..."> </textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-check-label mb-50">Incluir no XML de Google</label>
                                <div class="form-check form-check-success form-switch">
                                    <input type="checkbox" class="form-check-input" id="customSwitch4"
                                        name="tp_google_xml" />
                                </div>
                            </div>

                        </div>



                        <div class="d-flex justify-content-between mt-3">

                            <button type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancelar</button>


                            <a class="btn btn-primary btn-next ms-auto" id="variacoes-buttton" style="display:none">
                                <span class="align-middle d-sm-inline-block d-none">Variações</span>
                                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                            </a>

                            <button class="btn btn-success btn-next ms-auto" id="product-buttton">
                                <span class="align-middle d-sm-inline-block d-none">Criar produto</span>
                            </button>


                        </div>
                    </div>

                    <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">

                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Atributos que o produto possui ?</h4>
                                <select class="select2 form-select" multiple>

                                    <option value="">Cor</option>
                                    <option value="">Tamanho</option>
                                    <option value="">Modelo</option>

                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <hr class="my-2">

                        <div class="row">

                            <div class=" col-md-6">
                                <div class="d-flex flex-row">
                                    <div>
                                        <h4 class="card-title">Cada variação possui foto diferente?</h4>
                                    </div>
                                    <div class="form-check form-check-success form-switch ms-1">
                                        <input type="checkbox" class="form-check-input" id="checkUploadImage" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" id="uploadImageProduto">
                                <p class="card-text">
                                    Suba aqui as imagens do produto<code>1440x500 | jpg.png</code>
                                </p>

                                <div id="variationimages">

                                </div>


                                <input type="hidden" id="serialized" name="serialized">

                            </div>

                        </div>

                        <hr class="my-2">

                        <div class="row">
                            <div class=" col-md-6">

                                <div class="d-flex flex-row">
                                    <div>
                                        <h4 class="card-title">Possuem as mesmas informações de peso e
                                            dimenções?</h4>
                                    </div>
                                    <div class="form-check form-check-success form-switch ms-1">
                                        <input type="checkbox" checked class="form-check-input" id="peso-dimencoes-check"
                                            name="peso_dimencoes_check" />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-1" id="peso-dimencoes-2" style="display:none">
                            <div class="col-md-2">
                                <label class="form-check-label mb-50">Peso</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nr_peso"
                                        value="{{ old('nr_peso') }}">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label mb-50">Altura</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nr_altura"
                                        value="{{ old('nr_altura') }}">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label mb-50">Largura</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nr_largura"
                                        value="{{ old('nr_largura') }}">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label mb-50">Profundidade</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nr_profundidade"
                                        value="{{ old('nr_profundidade') }}">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>

                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="card-title">Variações</h4>
                            </div>
                        </div>

                        <div action="#" class="row invoice-repeater">
                            <div class="col-12">
                                <div class="linha">
                                    <table>
                                        <thead class="text-center">
                                            <tr>
                                                <th class="bg-primary text-white rounded-start p-1 w-330px column-image-upload">Imagem</th>
                                                <th class="bg-primary text-white p-1 w-230px">Nome</th>


                                                <th class="bg-primary text-white atributos-header p-1 w-230px">Cor</th>
                                                <th class="bg-primary text-white atributos-header p-1 w-230px">Tamanho</th>

                                                <th class="bg-primary text-white w-87px">Preço Custo</th>
                                                <th class="bg-primary text-white w-87px">Preço de</th>
                                                <th class="bg-primary text-white w-87px">Preço por</th>

                                                <th class="bg-primary text-white p-1 w-87px">Quantidade</th>
                                                <th class="bg-primary text-white p-1 w-105px">SKU</th>
                                                <th class="bg-primary text-white p-1 w-105px">EAN</th>


                                                <th class="bg-primary text-white dimensoes-header p-1 w-105px">Peso</th>
                                                <th class="bg-primary text-white dimensoes-header p-1 w-105px">Altura</th>
                                                <th class="bg-primary text-white dimensoes-header p-1 w-105px">Largura</th>
                                                <th class="bg-primary text-white dimensoes-header p-1 w-105px">Profundidade
                                                </th>


                                                <th class="bg-primary text-white rounded-end"></th>
                                            </tr>
                                        </thead>
                                        <tbody data-repeater-list="invoice">

                                            <tr data-repeater-item>
                                                <td class="column-image-upload">

                                                    {{-- <div class="image-upload">
                                                        <label for="uploadImage">
                                                            <img src="https://i.pinimg.com/originals/54/38/19/543819d33dfcfe997f6c92171179e4cd.png"
                                                                id="uploadPreview" style="width: 45px; height: 45px;">
                                                        </label>
                                                        <input id="uploadImage" type="file" name="foto"
                                                            onchange="PreviewImage();">
                                                    </div> --}}

                                                    <div class="image-upload">
                                                        <label onclick="clickInput($(this));">

                                                            <img src="https://i.pinimg.com/originals/54/38/19/543819d33dfcfe997f6c92171179e4cd.png"
                                                                class="uploadPreview" style="width: 45px; height: 45px;">

                                                        </label>
                                                        <input class="uploadImage" type="file" name="foto"
                                                            onchange="PreviewImage(this);">
                                                    </div>

                                                </td>

                                                <td><input type="text" class="form-control form-control-sm"
                                                        name="nameVariante" placeholder="Nome " /></td>


                                                <td class="atributos-input">
                                                    <select class="form-control form-control-sm">
                                                        <option>Selecione</option>
                                                    </select>
                                                </td>

                                                <td class="atributos-input">
                                                    <select class="form-control form-control-sm">
                                                        <option>Selecione</option>
                                                    </select>
                                                </td>


                                                <td>
                                                    <input type="text" class="form-control form-control-sm w-87px"
                                                        name="preco_custo" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm w-87px"
                                                        name="preco_de" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm w-87px"
                                                        name="preco_por" />
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="quantidade" />
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="sku" placeholder="SKU" />
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="ean" placeholder="EAN" />
                                                </td>


                                                <td class="dimensoes-input">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="peso" placeholder="Peso" />
                                                </td>

                                                <td class="dimensoes-input">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="altura" placeholder="Altura" />
                                                </td>

                                                <td class="dimensoes-input">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="largura" placeholder="Largura" />
                                                </td>

                                                <td class="dimensoes-input">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="profundidade" placeholder="profundidade" />
                                                </td>


                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-repeater-delete>
                                                        <span>Deletar</span>
                                                    </button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                            <div class="col-12 mt-3 ">
                                <button type="button" class="btn btn-icon btn-primary" id="addNewRow"
                                    data-repeater-create>
                                    <i data-feather="plus" class="me-25"></i>
                                    <span>Adicionar nova variação</span>
                                </button>
                            </div>

                            <div class="d-flex justify-content-between mt-3">

                                <button type="reset" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>

                                <a class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Detalhes</span>
                                </a>

                                <a class="btn btn-primary btn-next ms-auto" id="variacoes-buttton" style="display:none">
                                    <span class="align-middle d-sm-inline-block d-none">Variações</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </a>

                                <button class="btn btn-success btn-next ms-auto" id="product-buttton">
                                    <span class="align-middle d-sm-inline-block d-none">Criar produto</span>
                                </button>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /Horizontal Wizard -->
    </form>
    <!--/ Kick start -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>

@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/sortable/html5sortable.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-images.js')) }}"></script>

    <script>
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],
            ['link', 'image', 'video'],

            [{
                'header': 2
            }], // custom button values
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // superscript/subscript
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent

            [{
                'header': [2, 3, 4, 5, 6, false]
            }],

            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            ['clean'] // remove formatting button
        ];
        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions,
                history: { // Enable with custom configurations
                    'delay': 2500,
                    'userOnly': true
                },
            },
            theme: 'snow'
        });

        quill.on('text-change', function(delta, oldDelta, source) {
            console.log(quill.container.firstChild.innerHTML)
            $('#hiddenTextArea').val(quill.container.firstChild.innerHTML);
        });

        $('.select2-search__field').css('width', '100%');

        $('#tp_variacao').change(function() {

            if ($(this).is(':checked')) {
                console.log('Com variação')
                $('#personal-info-trigger').show();
                $('#personal-info-trigger-arrow').show();
                $('#peso-dimencoes-2').show();
                $('#variacoes-buttton').show();
                $('.prices, .stock, .dimensoes').hide();
                $('#product-buttton').hide();
                $('#produtcimages #actions').appendTo('#variationimages');
            } else {
                $('#personal-info-trigger').hide();
                $('#personal-info-trigger-arrow').hide();
                $('#peso-dimencoes-2').hide();
                $('#variacoes-buttton').hide();
                $('.prices, .stock, .dimensoes').show();
                $('#product-buttton').show();
                $('#variationimages #actions').appendTo('#produtcimages');
            }
        });


        $('#st_estoque').change(function() {

            if ($(this).is(':checked')) {
                $('.qnt').hide();
            } else {
                $('.qnt').show();
            }
        });

        $('input[name=product_type]').change(function() {
            console.log($(this).val());

            if ($(this).val() == 'fisico') {
                $('.dimensoes').show();
            } else {
                $('.dimensoes').hide();
            }
        });



        var wizardExample = document.querySelector('.horizontal-example')

        // $('#productForm').validate({
        //     errorClass: 'text-danger',
        //     rules: {
        //         tx_produto: {
        //             required: true,
        //         }
        //     },
        //     messages: {
        //         tx_produto: {
        //             required: 'Insira o nome do produto',
        //         }
        //     }
        // });

        if (typeof wizardExample !== undefined && wizardExample !== null) {
            var numberedStepper = new Stepper(wizardExample, {
                linear: true,
            })

            $(wizardExample)
                .find('.btn-next, .step')
                .each(function() {
                    $(this).on('click', function(e) {
                        var isValid = $('#productForm').valid()
                        console.log(isValid);
                        if (isValid) {
                            numberedStepper.next()
                        } else {
                            e.preventDefault()
                        }
                    })
                })
            $(wizardExample)
                .find('.btn-prev')
                .on('click', function() {
                    numberedStepper.previous()
                })

            $(wizardExample)
                .find('.btn-submit')
                .on('click', function() {
                    var isValid = $('#productForm').valid()
                    if (isValid) {
                        alert('Submitted..!!')
                    }
                })
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {

            var json = <?php echo json_encode($departamentos); ?>;

            console.log(json);

            $.each(json, function(i, departamento) {
                $(".select-dep-cat").append('<option disabled>' + departamento.tx_departamento +
                    '</option>');

                if (departamento.categorias.length != 0) {
                    montaSubCategoria(departamento.categorias)
                }
            });

            function montaSubCategoria(categoria, level = 1) {

                $.each(categoria, function(i, categoria, ) {
                    espacos = ' &nbsp; &nbsp;'.repeat(level);

                    $(".select-dep-cat").append('<option value="' + categoria.id_categoria + '">' +
                        espacos + categoria.tx_categoria + '</option>');

                    if (categoria.all_children.length != 0) {
                        level++;
                        montaSubCategoria(categoria.all_children, level)
                        level = 1;
                    }
                });

            }

        });
    </script>

    <script>
        $('.invoice-repeater, .repeater-default').repeater({
            show: function() {
                $(this).slideDown();


            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
    </script>

    <script>
        $('#addNewRow').click(function() {
            var checkBoxes = $("#peso-dimencoes-check");
            // checkBoxes.prop("checked", !checkBoxes.prop("checked"));
            if (checkBoxes.is(':checked')) {
                $('#peso-dimencoes-2').show();
                $('.atributos-header').hide();
                $('.atributos-input').hide();
                $('.dimensoes-header').hide();
                $('.dimensoes-input').hide();

            } else {
                $('#peso-dimencoes-2').hide();

                $('.atributos-header').show();
                $('.atributos-input').show();
                $('.dimensoes-header').show();
                $('.dimensoes-input').show();
            }
        });


        $('#peso-dimencoes-check').change(function() {

            if ($(this).is(':checked')) {
                $('#peso-dimencoes-2').show();

                $('.atributos-header').hide();
                $('.atributos-input').hide();
                $('.dimensoes-header').hide();
                $('.dimensoes-input').hide();

            } else {
                $('#peso-dimencoes-2').hide();

                $('.atributos-header').show();
                $('.atributos-input').show();
                $('.dimensoes-header').show();
                $('.dimensoes-input').show();
            }
        });
        $('#checkUploadImage').change(function() {

            if ($(this).is(':checked')) {
                $('#uploadImageProduto').hide();
                $('.linha .column-image-upload').show();

            } else {
                $('#uploadImageProduto').show();
                $('.linha .column-image-upload').hide();
            }
        });
    </script>

    <script>
        // PREVIEW FOTO
        // function PreviewImage() {

        //     var oFReader = new FileReader();
        //     oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        //     oFReader.onload = function(oFREvent) {
        //         document.getElementById("uploadPreview").src = oFREvent.target.result;
        //     };
        // };

        function clickInput(label){
            label.siblings('input').click();
        }

        function PreviewImage(input) {

            var oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[0]);

            oFReader.onload = function(oFReader) {
                console.log(input.parentElement.querySelector('.uploadPreview'));
                input.parentElement.querySelector('.uploadPreview').src = oFReader.target.result;
            };
        }
    </script>


@endsection
