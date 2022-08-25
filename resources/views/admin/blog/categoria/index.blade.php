@extends('layouts/contentLayoutMaster')

@section('title', 'Categoria')

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
                <div class=" col-md-3">
                    <div class="d-grid">
                        <a class="btn btn-outline-primary waves-effect p-1" data-bs-toggle="modal"
                            data-bs-target="#modals-new"> Nova</a>
                    </div>
                </div>

                <div class="col-md-9 col-12">

                        @csrf
                        <div class="input-group">
                            <button class="btn btn-outline-primary" type="button">
                                <i data-feather="search"></i>
                            </button>
                            <input type="text" class="form-control form-control-lg" name="search" id="search"
                                value="{{ isset($search) ? $search : '' }}"
                                placeholder="Digite o nome da categoria" aria-label="Amount" />
                            <button class="btn btn-outline-primary" type="submit">Buscar</button>
                        </div>

                </div>
            </div>
         </form>
        </div>
    </div>


    <div class="modal modal-slide-in fade" id="modals-new">
        <div class="modal-dialog sidebar-lg">
            <form class="add-new-record modal-content pt-0" method="POST" action="{{ route('blog.categoria.store') }}"
                enctype="multipart/form-data">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Nova categoria</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="tx_blog_categoria" placeholder="Nome" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-check-label mb-50">Status</label>
                        <div class="form-check form-check-success form-switch">
                            <input type="checkbox" checked class="form-check-input" id="customSwitch4"
                                name="st_publicado" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary data-submit me-1">Enviar</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal modal-slide-in fade" id="modals-edit">
        <div class="modal-dialog sidebar-lg">
            <form class="add-new-record modal-content pt-0" method="POST" action="{{ route('blog.categoria.update') }}"
                enctype="multipart/form-data">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Editar categoria</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <input type="hidden" name="id_blog_categoria" value="" id="modal-id_blog_categoria">
                    <div class="mb-1">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="tx_blog_categoria" placeholder="Nome" required  id="modal-tx_blog_categoria"/>
                    </div>
                    <div class="mb-1">
                        <label class="form-check-label mb-50">Status</label>
                        <div class="form-check form-check-success form-switch">
                            <input type="checkbox"  class="form-check-input" id="modal-st_categoria"
                                name="st_publicado" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary data-submit me-1">Editar</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
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
                                        <th class="bg-primary text-white">Categoria</th>
                                        <th class="bg-primary text-white">Posts</th>
                                        <th class="bg-primary text-white">Data de Cadastro</th>
                                        <th class="bg-primary text-white rounded-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr class="table-line">
                                            <td>{{ $categoria->id_blog_categoria }} </td>
                                            <td>{{ $categoria->tx_blog_categoria }}</td>
                                            <td>20</td>
                                            <td>{{ date('d/m/Y H:i', strtotime($categoria->dh_cadastro))}}</td>
                                            <td>
                                                @if ($categoria->st_publicado == 'ATIVO')
                                                <span class="badge rounded-pill badge-light-success" text-capitalized="">
                                                    {{ ucfirst(strtolower($categoria->st_publicado)) }}</span>
                                            @elseif($categoria->st_publicado == 'INATIVO')
                                                <span class="badge rounded-pill badge-light-warning"
                                                    text-capitalized="">
                                                    {{ ucfirst(strtolower($categoria->st_publicado)) }}</span>
                                            @endif

                                            </td>
                                            <td class="actions">
                                                <div class="row">
                                                    <div class="d-flex gap-1 col-actions">


                                                        <a  data-bs-toggle="modal" class="editCat"
                                                        data-bs-target="#modals-edit"
                                                        data-cat-id="{{ $categoria->id_blog_categoria }}"
                                                        data-cat-title="{{ $categoria->tx_blog_categoria }}"
                                                        data-status="{{ $categoria->st_publicado }}"
                                                        >
                                                        <button type="submit"
                                                        class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                        <i data-feather='edit'></i></button>
                                                        </a>

                                                        <form action="{{ route('blog.categoria.delete', ['categoria' => $categoria]) }}"
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
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- PAGINATION --}}
                            <div class="row justify-content-center mx-0 px-0">
                                {{ $categorias->links() }}
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
@section('page-script')
<script>
    $('.editCat').click(function(){
        $('#modal-id_blog_categoria').val( $(this).attr('data-cat-id'));
        $('#modal-tx_blog_categoria').val( $(this).attr('data-cat-title'));
        console.log($(this).attr('data-status'))
        if($(this).attr('data-status') == 'ATIVO'){
            $('#modal-st_categoria').attr('checked',true);
        }else{
            $('#modal-st_categoria').attr('checked',false);
        }
    })
</script>
@endsection
