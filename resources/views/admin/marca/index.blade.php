@extends('layouts/contentLayoutMaster')

@section('title', 'Marcas')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
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
            <form method="POST" action="" enctype="multipart/form-data">
            <div class="row ">
                <div class="col-12">

                        @csrf
                        <div class="input-group">
                            <button class="btn btn-outline-primary" type="button">
                                <i data-feather="search"></i>
                            </button>
                            <input type="text" class="form-control form-control-lg" name="search" id="search"
                                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                                placeholder="Digite o nome da marca" aria-label="Amount" />
                            <button class="btn btn-outline-primary" type="submit">Buscar</button>
                        </div>

                </div>
            </div>
         </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Basic table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="datatables-basic table">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="bg-primary text-white rounded-start">Id</th>
                                        <th class="bg-primary text-white">Marca</th>
                                        <th class="bg-primary text-white">Data de Cadastro</th>
                                        <th class="bg-primary text-white rounded-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marcas as $marca)
                                        <tr class="table-line">
                                            <td>{{ $marca->id_marca }} </td>
                                            <td>{{ $marca->tx_marca }}</td>
                                            <td>{{date('d/m/Y H:i', strtotime($marca->dh_cadastro))}}</td>
                                            <td>
                                                @if ($marca->st_publicado == 'ATIVO')
                                                <span class="badge rounded-pill badge-light-success" text-capitalized="">
                                                    {{ ucfirst(strtolower($marca->st_publicado)) }}</span>
                                            @elseif($marca->st_publicado == 'INATIVO')
                                                <span class="badge rounded-pill badge-light-warning"
                                                    text-capitalized="">
                                                    {{ ucfirst(strtolower($marca->st_publicado)) }}</span>
                                            @endif

                                            </td>
                                            <td class="actions">
                                                <div class="row">
                                                    <div class="d-flex gap-1 col-actions">

                                                        {{-- <form action="{{ route('marca.show', ['marca' => $marca]) }}"
                                                            method="GET"> --}}
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                <i data-feather='eye'></i></button>
                                                        {{-- </form> --}}

                                                        {{-- <form action="{{ route('marca.edit', ['marca' => $marca]) }}"
                                                            method="GET"> --}}
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                <i data-feather='edit'></i></button>
                                                        {{-- </form> --}}

                                                        {{-- <form action="{{ route('marca.delete', ['marca' => $marca]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete') --}}
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect"><i
                                                                    data-feather='trash-2'></i></button>
                                                        {{-- </form> --}}

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- PAGINATION --}}
                            <div class="row justify-content-center mx-0 px-0">
                                {{ $marcas->links() }}
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
