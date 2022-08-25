@extends('layouts/contentLayoutMaster')

@section('title', 'Produto')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-produtos.css')) }}">
@endsection

@section('content')

@if (session()->has('msg-sucess'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="alert-body">
        {{ session()->get('msg-sucess') }}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

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

    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-9">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <button class="btn btn-outline-primary" type="button">
                                <i data-feather="search"></i>
                            </button>
                            <input type="text" class="form-control form-control-lg" name="search" id="search"
                                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                                placeholder="Digite o nome do produtto" aria-label="Amount" />
                            <button class="btn btn-outline-primary" type="submit">Buscar</button>
                        </div>

                    </form>
                </div>

                <div class="col-3 d-flex justify-content-end">
                    <a class="btn btn-outline-primary waves-effect p-1 h-100" data-bs-toggle="modal"
                    data-bs-target="#modals-slide-in"><i data-feather='filter'></i> Filtos</a>

                    <div class="d-flex justify-content-end">
                        <a class="nav-link p-0 ms-2 h-100" href="{{route('produtos.export', ['search' => isset($search) ? $search : ''] ) }}">
                            <div class="btn-export h-100">
                                <button class="btn btn-primary ag-grid-export-btn d-flex align-items-center h-100">
                                    <i data-feather='pie-chart' class="font-medium-3 me-50"></i>
                                    <span class="fw-bold">Exportar</span>
                                </button>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-lg">
            <form class="add-new-record modal-content pt-0" method="POST" action="{{ route('user.store') }}"
                enctype="multipart/form-data">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Filtros</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label">Ordernar por</label>
                        <select class="form-select" name="order">
                            <option value="date" selected>Data de criação</option>
                            <option value="alpha">Ordem alfabética</option>
                            <option value="featureds">Destaques</option>
                            <option value="topSellers">Mais vendidos</option>
                            <option value="stock">Estoque</option>
                          </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Categoria</label>
                          <select class="select2 form-select" id="select2-multiple" multiple data-placeholder="Selecione">
                            @foreach ($departamentos as $departamento)
                            @if(count($departamento->categorias) > 0)
                            <optgroup label="{{$departamento->tx_departamento }}">
                                @foreach ($departamento->categorias as $categoria)
                                    <option value="{{$categoria->id_categoria}}">{{$categoria->tx_categoria }}</option>
                                @endforeach
                            </optgroup>
                            @endif
                            @endforeach

                          </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Marcas</label>
                        <select class="select2 form-select" name="status" multiple  data-placeholder="Selecione">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Status do produto</label>
                        <select class="form-select" name="status">
                            <option selected>Todos</option>
                            <option value="actives">Ativos</option>
                            <option value="inactives">Inativos</option>
                            <option value="stockout">Indisponíveis</option>
                          </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Produto com variação</label>
                        <select class="form-select" name="variation">
                            <option selected>Selecionar</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                          </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Produto em destaque</label>
                        <select class="form-select" name="featured">
                            <option selected>Selecionar</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                          </select>
                    </div>


                    <button type="submit" class="btn btn-primary data-submit me-1">Aplicar filtros</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic table -->
            <section id="basic-datatable-produtos">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="datatables-basic table">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="bg-primary text-white rounded-start">SKU</th>
                                        <th class="bg-primary text-white"></th>
                                        <th class="bg-primary text-white">Produto</th>
                                        <th class="bg-primary text-white text-center">Tipo</th>
                                        <th class="bg-primary text-white text-center">Com variante</th>
                                        <th class="bg-primary text-white text-center">Preço de</th>
                                        <th class="bg-primary text-white text-center">Preço por</th>
                                        <th class="bg-primary text-white text-center rounded-end">Estoque</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-line">
                                        <td>449174971459</td>
                                        <td><div class="product-image">
                                            <img src="https://pixinvent.com/demo/vuexy-bootstrap-laravel-admin-template/demo-1/images/pages/eCommerce/3.png" alt="Avatar" width="70" height="70">

                                        </div></td>
                                        <td>Apple iMac 27-inch</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i data-feather='package' style="margin-right:0.3em"></i> Físico
                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <div class="avatar avatar-status bg-light-success"><span class="avatar-content" title="Sim">
                                                <i data-feather='check-circle'></i>
                                            </span></div>
                                        </td>
                                        <td class="text-center">R$ 30,00</td>
                                        <td class="text-center">R$ 20,00</td>
                                        <td class="text-center">10</td>

                                        <td class="actions"><div class="row ">
                                            <div class="d-flex gap-1 col-actions">

                                                <form action="{{ route('produto.create', ['produto' => '']) }}"
                                                    method="GET">
                                                    <button type="submit"
                                                        class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                        <i data-feather='eye'></i></button>
                                                </form>

                                                <form action="{{ route('produto.create', ['produto' => '']) }}"
                                                    method="GET">
                                                    <button type="submit"
                                                        class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                        <i data-feather='edit'></i></button>
                                                </form>

                                                <form action="{{ route('produto.create', ['produto' => '']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-icon rounded-circle btn-outline-primary waves-effect"><i
                                                            data-feather='trash-2'></i></button>
                                                </form>

                                            </div>
                                        </div></td>
                                    </tr>

                                    <tr class="table-line">
                                        <td>45252626626</td>
                                        <td><div class="product-image">
                                            <img src="https://pixinvent.com/demo/vuexy-bootstrap-laravel-admin-template/demo-1/images/pages/eCommerce/1.png" alt="Avatar" width="70" height="70">

                                        </div></td>
                                        <td>Apple Watch Series 5 com nome bem grande e divertido</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i data-feather='monitor' style="margin-right:0.3em"></i> Virtual
                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <div class="avatar avatar-status bg-light-secondary"><span class="avatar-content" title="Não">
                                                <i data-feather='circle'></i>
                                            </span></div>
                                        </td>
                                        <td class="text-center">R$ 70,00</td>
                                        <td class="text-center">R$ 55,27</td>
                                        <td class="text-center">1000</td>

                                        <td class="actions"><div class="row ">
                                            <div class="d-flex gap-1 col-actions">

                                                <form action="{{ route('produto.create', ['produto' => '']) }}"
                                                    method="GET">
                                                    <button type="submit"
                                                        class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                        <i data-feather='eye'></i></button>
                                                </form>

                                                <form action="{{ route('produto.create', ['produto' => '']) }}"
                                                    method="GET">
                                                    <button type="submit"
                                                        class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                        <i data-feather='edit'></i></button>
                                                </form>

                                                <form action="{{ route('produto.create', ['produto' => '']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-icon rounded-circle btn-outline-primary waves-effect"><i
                                                            data-feather='trash-2'></i></button>
                                                </form>

                                            </div>
                                        </div></td>
                                    </tr>

                                    {{-- @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->id_categoria }} </td>
                                            <td>{{ $categoria->tx_categoria }}</td>
                                            <td>{{ ucfirst(strtolower($categoria->st_publicado)) }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="d-flex gap-1 col-actions">

                                                        <form action="{{ route('categoria.show', ['categoria' => $categoria]) }}"
                                                            method="GET">
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                <i data-feather='eye'></i></button>
                                                        </form>

                                                        <form action="{{ route('categoria.edit', ['categoria' => $categoria]) }}"
                                                            method="GET">
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                <i data-feather='edit'></i></button>
                                                        </form>

                                                        <form action="{{ route('categoria.delete', ['categoria' => $categoria]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect"><i
                                                                    data-feather='trash-2'></i></button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                            {{-- PAGINATION --}}
                            <div class="row justify-content-center mx-0 px-0">
                                {{-- {{ $produtos->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Basic table -->
        </div>
    </div>
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
{{-- <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script> --}}
<script>
    $('.select2').select2({
    minimumResultsForSearch: -1,
    dropdownAutoWidth: false,
    multiple: true,
    width: '100%',
    height: '10px',
    placeholder: "Selecione",
    allowClear: true
    });
    $('.select2-search__field').css('width', '100%');
</script>

@endsection
