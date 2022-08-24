@extends('layouts/contentLayoutMaster')

@section('title', 'Produto')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
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
                <div class="col-12">
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

            </div>
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
                                            <img src="http://localhost:8000/imagens/departamentos/1660930518-image.jpg" alt="Avatar" width="70" height="70">

                                        </div></td>
                                        <td>Mochila Loading</td>
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

                                        <td class="status"><div class="row ">
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
                                            <img src="http://localhost:8000/imagens/departamentos/1660930518-image.jpg" alt="Avatar" width="70" height="70">

                                        </div></td>
                                        <td>Mochila Virtual com nome bem grande e divertido</td>
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

                                        <td class="status"><div class="row ">
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
@endsection
