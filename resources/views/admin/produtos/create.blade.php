@extends('layouts/contentLayoutMaster')

@section('title', 'Produto')

@section('vendor-style')
    <!-- vendor css files -->
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

@section('content')
    <!-- Kick start -->

    @if ($errors->any())
        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
            <div class="alert-body d-flex align-items-center">
                @foreach ($errors->all() as $error)
                    <i data-feather="info" class="me-50"></i>
                    <span>{{ $error }} | </span>
                @endforeach
            </div>
        </div>
    @endif

    <form  method="POST" action="{{route('produto.store')}}" enctype="multipart/form-data" id="productForm">
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
                    <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger" style="display:none">
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

                      <form>
                        <div class="row">

                            <div class="mb-1 col-12">
                                <label class="form-label">Nome do produto</label>
                                <input type="text" class="form-control" name="tx_produto" placeholder="Nome" required />
                            </div>

                            <div class="mb-1 col-12 mb-5 pb-3">
                                <label class="form-label">Descrição</label>
                                <div id="editor" >
                                    <p>Hello World!</p>
                                    <p>Some initial <strong>bold</strong> text</p>
                                    <p><br></p>
                                </div>
                                <textarea name="tx_descricao" style="display:none" id="hiddenTextArea"></textarea>

                            </div>

                            <div class="col-md-6 ">
                                <label class="form-label" for="select2-basic">Marca</label>
                                <select class="select2 form-select" id="select2-basic">
                                  <option value="AK">Alaska</option>
                                  <option value="HI">Hawaii</option>
                                  <option value="CA">California</option>
                                  <option value="NV">Nevada</option>
                                  <option value="OR">Oregon</option>
                                  <option value="WA">Washington</option>
                                  <option value="AZ">Arizona</option>
                                  <option value="CO">Colorado</option>
                                  <option value="ID">Idaho</option>
                                  <option value="MT">Montana</option>
                                  <option value="NE">Nebraska</option>
                                  <option value="NM">New Mexico</option>
                                  <option value="ND">North Dakota</option>
                                  <option value="UT">Utah</option>
                                  <option value="WY">Wyoming</option>
                                  <option value="AL">Alabama</option>
                                  <option value="AR">Arkansas</option>
                                  <option value="IL">Illinois</option>
                                  <option value="IA">Iowa</option>
                                  <option value="KS">Kansas</option>
                                  <option value="KY">Kentucky</option>
                                  <option value="LA">Louisiana</option>
                                  <option value="MN">Minnesota</option>
                                  <option value="MS">Mississippi</option>
                                  <option value="MO">Missouri</option>
                                  <option value="OK">Oklahoma</option>
                                  <option value="SD">South Dakota</option>
                                  <option value="TX">Texas</option>
                                  <option value="TN">Tennessee</option>
                                  <option value="WI">Wisconsin</option>
                                  <option value="CT">Connecticut</option>
                                  <option value="DE">Delaware</option>
                                  <option value="FL">Florida</option>
                                  <option value="GA">Georgia</option>
                                  <option value="IN">Indiana</option>
                                  <option value="ME">Maine</option>
                                  <option value="MD">Maryland</option>
                                  <option value="MA">Massachusetts</option>
                                  <option value="MI">Michigan</option>
                                  <option value="NH">New Hampshire</option>
                                  <option value="NJ">New Jersey</option>
                                  <option value="NY">New York</option>
                                  <option value="NC">North Carolina</option>
                                  <option value="OH">Ohio</option>
                                  <option value="PA">Pennsylvania</option>
                                  <option value="RI">Rhode Island</option>
                                  <option value="SC">South Carolina</option>
                                  <option value="VT">Vermont</option>
                                  <option value="VA">Virginia</option>
                                  <option value="WV">West Virginia</option>
                                </select>
                            </div>

                            <div class="col-md-6 ">

                            </div>

                        </div>


                        <hr class="my-2">

                        <div class="row">

                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Tipo de produto</label>
                                    <div class="demo-inline-spacing">
                                        <div class="form-check form-check-inline mt-0">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="product_type"
                                              id="inlineRadio1"
                                              value="fisico"
                                              checked
                                            />
                                            <label class="form-check-label" for="inlineRadio1">Físico</label>
                                          </div>
                                          <div class="form-check form-check-inline mt-0">
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              name="product_type"
                                              id="inlineRadio2"
                                              value="virtual"
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Virtual</label>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Produto com variação</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox"  class="form-check-input" id="tp_variacao"
                                            name="tp_variacao" />
                                    </div>
                                </div>
                            </div>


                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Produto em destaque</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox"  class="form-check-input" id="customSwitch4"
                                            name="st_publicado" />
                                    </div>
                                </div>
                            </div>
                            <div class=" col-2">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50">Publicado</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox" checked class="form-check-input" id="customSwitch4"
                                            name="st_publicado" />
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


                                       <div id="actions" class="dropzone dropzone-area">
                                            <div  id="allImagesWrapper" class="col-lg-12 d-flex actions">

                                            </div>
                                              <label class="custom-file-label" for="files">
                                                <div class="dz-message " id="dz-message">Clique aqui ou arraste as imagens.</div>
                                            </label>
                                            <div class="col-lg-12">
                                              <div class="input-group">
                                                <div class="custom-file">
                                                  <input type="file" class="custom-images-input" id="files" name="images[]"
                                                  hidden multiple  filesize=1500>
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
                                    <input type="text" class="form-control" name="tx_video" placeholder="Ex. https://www.youtube.com/watch?v=000"  />
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
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                              </div>
                          </div>
                          <div class="  col-md-3">
                            <label class="form-check-label mb-50">Preço de venda (preço de)</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                              </div>
                          </div>
                          <div class=" col-md-3">
                            <label class="form-check-label mb-50">Preço promocional (preço por)</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
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
                                        <input type="checkbox"  class="form-check-input" id="st_estoque"
                                            name="st_estoque" />
                                    </div>
                                </div>
                            </div>

                          <div class="  col-md-2 qnt" >
                            <label class="form-check-label mb-50">Quantide</label>
                            <input type="text" class="form-control" name="estoque">
                          </div>
                          <div class="  col-md-3 sku">
                            <label class="form-check-label mb-50">SKU (Unidade de manutenção de estoque)</label>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                          </div>
                          <div class=" col-md-3">
                            <label class="form-check-label mb-50">Código de barras (GTIN, EAN, ISBN, etc.)</label>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                          </div>

                        </div>


                        <hr class="my-2 dimensoes">

                        <div class="row dimensoes">
                         <h4 class="card-title">Peso e dimensões</h4>

                          <div class="col-md-2">
                            <label class="form-check-label mb-50">Peso</label>
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">Kg</span>
                              </div>
                          </div>
                          <div class="col-md-2">
                            <label class="form-check-label mb-50">Altura</label>
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">cm</span>
                              </div>
                          </div>
                          <div class="col-md-2">
                            <label class="form-check-label mb-50">Largura</label>
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">cm</span>
                              </div>
                          </div>
                          <div class="col-md-2">
                            <label class="form-check-label mb-50">Profundidade</label>
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">cm</span>
                              </div>
                          </div>

                        </div>


                        <hr class="my-2">

                        <div class="row">
                         <h4 class="card-title">Categoria</h4>

                          <div class="  col-md-12">
                            <select class="select2 form-select" id="select2-multiple" multiple>
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                  <option value="AK">Alaska</option>
                                  <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                  <option value="CA">California</option>
                                  <option value="NV">Nevada</option>
                                  <option value="OR">Oregon</option>
                                  <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                  <option value="AZ">Arizona</option>
                                  <option value="CO" selected>Colorado</option>
                                  <option value="ID">Idaho</option>
                                  <option value="MT">Montana</option>
                                  <option value="NE">Nebraska</option>
                                  <option value="NM">New Mexico</option>
                                  <option value="ND">North Dakota</option>
                                  <option value="UT">Utah</option>
                                  <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                  <option value="AL">Alabama</option>
                                  <option value="AR">Arkansas</option>
                                  <option value="IL">Illinois</option>
                                  <option value="IA">Iowa</option>
                                  <option value="KS">Kansas</option>
                                  <option value="KY">Kentucky</option>
                                  <option value="LA">Louisiana</option>
                                  <option value="MN">Minnesota</option>
                                  <option value="MS">Mississippi</option>
                                  <option value="MO">Missouri</option>
                                  <option value="OK">Oklahoma</option>
                                  <option value="SD">South Dakota</option>
                                  <option value="TX">Texas</option>
                                  <option value="TN">Tennessee</option>
                                  <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                  <option value="CT">Connecticut</option>
                                  <option value="DE">Delaware</option>
                                  <option value="FL" selected>Florida</option>
                                  <option value="GA">Georgia</option>
                                  <option value="IN">Indiana</option>
                                  <option value="ME">Maine</option>
                                  <option value="MD">Maryland</option>
                                  <option value="MA">Massachusetts</option>
                                  <option value="MI">Michigan</option>
                                  <option value="NH">New Hampshire</option>
                                  <option value="NJ">New Jersey</option>
                                  <option value="NY">New York</option>
                                  <option value="NC">North Carolina</option>
                                  <option value="OH">Ohio</option>
                                  <option value="PA">Pennsylvania</option>
                                  <option value="RI">Rhode Island</option>
                                  <option value="SC">South Carolina</option>
                                  <option value="VT">Vermont</option>
                                  <option value="VA">Virginia</option>
                                  <option value="WV">West Virginia</option>
                                </optgroup>
                              </select>
                          </div>

                        </div>


                        <hr class="my-2">

                        <div class="row mb-2">
                         <h4 class="card-title">SEO</h4>

                          <div class="col-md-6">
                            <label class="form-check-label mb-50">URL do produto</label>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                          </div>
                          <div class="col-md-6">
                            <label class="form-check-label mb-50">Tag Title</label>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                          </div>
                          <div class="col-12 mt-2">
                            <label class="form-check-label mb-50">Meta Tag Description</label>
                            <textarea class="form-control" name="tx_meta_description" placeholder="Descrição..." required> </textarea>
                          </div>
                          <div class="col-12 mt-2">
                            <label class="form-check-label mb-50">Incluir no XML de Google</label>
                                    <div class="form-check form-check-success form-switch">
                                        <input type="checkbox"  class="form-check-input" id="customSwitch4"
                                            name="st_publicado" />
                                    </div>
                          </div>

                        </div>


                      </form>

                      <div class="d-flex justify-content-between mt-3">

                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>


                        <a class="btn btn-primary btn-next ms-auto" id="variacoes-buttton" style="display:none">
                          <span class="align-middle d-sm-inline-block d-none">Variações</span>
                          <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </a>

                        <button class="btn btn-success btn-next ms-auto" id="product-buttton" >
                            <span class="align-middle d-sm-inline-block d-none">Criar produto</span>
                        </button>


                      </div>
                    </div>
                    <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">

                      <form>
                        <div class="row">
                          <div class=" col-md-6">
                            <label class="form-label" for="first-name">First Name</label>
                            <input type="text" name="first-name" id="first-name" class="form-control" placeholder="John" />
                          </div>
                          <div class=" col-md-6">
                            <label class="form-label" for="last-name">Last Name</label>
                            <input type="text" name="last-name" id="last-name" class="form-control" placeholder="Doe" />
                          </div>
                        </div>
                        <div class="row">
                          <div class=" col-md-6">
                            <label class="form-label" for="country">Country</label>
                            <select class="select2 w-100" name="country" id="country">
                              <option label=" "></option>
                              <option>UK</option>
                              <option>USA</option>
                              <option>Spain</option>
                              <option>France</option>
                              <option>Italy</option>
                              <option>Australia</option>
                            </select>
                          </div>
                          <div class=" col-md-6">
                            <label class="form-label" for="language">Language</label>
                            <select class="select2 w-100" name="language" id="language" multiple>
                              <option>English</option>
                              <option>French</option>
                              <option>Spanish</option>
                            </select>
                          </div>
                        </div>
                      </form>
                      <div class="d-flex justify-content-between">
                        <a class="btn btn-primary btn-prev">
                          <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Detalhes</span>
                        </a>
                        <button class="btn btn-primary btn-submit">
                          <span class="align-middle d-sm-inline-block d-none">Criar</span>
                        </button>
                      </div>
                    </div>


                  </div>
                </div>
              </section>
              <!-- /Horizontal Wizard -->


    </div>


    </form>
    <!--/ Kick start -->
    <!--/ Page layout -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/sortable/html5sortable.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-images.js')) }}"></script>

<script>
   var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        ['link','image','video'],

        [{ 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

        [{ 'header': [2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];
    var quill = new Quill('#editor', {
    modules: {
        toolbar: toolbarOptions,
        history: {          // Enable with custom configurations
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



$('#tp_variacao').change(function() {

  if( $(this).is(':checked')){
    console.log('Com variação')
    $('#personal-info-trigger').show();
    $('#personal-info-trigger-arrow').show();
    $('#variacoes-buttton').show();
    $('.prices, .stock, .dimensoes').hide();
    $('#product-buttton').hide();
  }else{
    console.log('Sem variação');
    $('#personal-info-trigger').hide();
    $('#personal-info-trigger-arrow').hide();
    $('#variacoes-buttton').hide();
    $('.prices, .stock, .dimensoes').show();
    $('#product-buttton').show();
  }
});

$('#st_estoque').change(function() {

  if( $(this).is(':checked')){
    $('.qnt').hide();
  }else{
    $('.qnt').show();
  }
});

$('input[name=product_type]').change(function() {
  console.log($(this).val());

  if( $(this).val() == 'fisico'){
    $('.dimensoes').show();
  }else{
    $('.dimensoes').hide();
  }
});

var wizardExample = document.querySelector('.horizontal-example')

$('#productForm').validate({
      errorClass: 'text-danger',
      rules: {
        tx_produto: {
          required: true,
        }
      },
      messages: {
        tx_produto: {
            required: 'Insira o nome do produto',
        }
      }
});

if (typeof wizardExample !== undefined && wizardExample !== null) {
    var numberedStepper = new Stepper(wizardExample, {
        linear: true,
    })

    $(wizardExample)
        .find('.btn-next, .step')
        .each(function () {
        $(this).on('click', function (e) {
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
    .on('click', function () {
        numberedStepper.previous()
    })

    $(wizardExample)
    .find('.btn-submit')
    .on('click', function () {
      var isValid = $('#productForm').valid()
      if (isValid) {
        alert('Submitted..!!')
      }
    })
}


</script>

@endsection
