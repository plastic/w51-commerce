@extends('layouts/contentLayoutMaster')

@section('title', 'Categoria')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
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
                    {{-- <div class="col-3">
                    <select class="form-select form-control form-control-lg" id="basicSelect">
                        <option>Ordenar por:</option>
                        <option>Departamento</option>
                        <option>Possui banner</option>
                        <option>Status</option>
                    </select>
                </div> --}}
                    <div class="col-12">

                        @csrf
                        <div class="input-group">
                            <button class="btn btn-outline-primary" type="button">
                                <i data-feather="search"></i>
                            </button>
                            <input type="text" class="form-control form-control-lg" name="search" id="search"
                                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                                placeholder="Digite o nome da categoria" aria-label="Amount" />
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
                                        <th class="bg-primary text-white">Departamento</th>
                                        <th class="bg-primary text-white">Categoria</th>
                                        <th class="bg-primary text-white text-center">Banner</th>
                                        <th class="bg-primary text-white rounded-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr class="table-line">
                                            <td>{{ $categoria->id_categoria }} </td>
                                            <td>{{ $categoria->departamento->tx_departamento ?? '' }} </td>
                                            <td>{{ $categoria->tx_categoria }}</td>
                                            <td class="text-center">
                                                @if ($categoria->tx_banner != null)
                                                    <img src="{{ url('imagens/categorias/' . $categoria->tx_banner) }}"
                                                        width="70" height="30">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($categoria->st_publicado == 'ATIVO')
                                                    <span class="badge rounded-pill badge-light-success"
                                                        text-capitalized="">
                                                        {{ ucfirst(strtolower($categoria->st_publicado)) }}</span>
                                                @elseif($categoria->st_publicado == 'INATIVO')
                                                    <span class="badge rounded-pill badge-light-warning"
                                                        text-capitalized="">
                                                        {{ ucfirst(strtolower($categoria->st_publicado)) }}</span>
                                                @endif

                                            </td>
                                            <td class="actions">
                                                <div class="row">
                                                    <div class="d-flex  gap-1 col-actions">
                                                        <div>
                                                            <form
                                                                action="{{ route('categoria.show', ['categoria' => $categoria]) }}"
                                                                method="GET">
                                                                <button type="submit"
                                                                    class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                    <i data-feather='eye'></i></button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <form
                                                                action="{{ route('categoria.edit', ['categoria' => $categoria]) }}"
                                                                method="GET">
                                                                <button type="submit"
                                                                    class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                    <i data-feather='edit'></i></button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <button
                                                                onclick="deleteCategoria({{ $categoria->id_categoria }} , {{ $categoria->children->count() }})"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect"><i
                                                                    data-feather='trash-2'></i>
                                                            </button>
                                                        </div>

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

    <!-- sweet alert -->
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection


<script type="text/javascript">
    function deleteCategoria(id, child_categorias) {

        if (child_categorias > 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops... ',
                text: 'Para deletar essa categoria, ela n??o deve possuir nenhuma subcategoria.',
            })
            return;
        }

        Swal.fire({
            title: 'Deseja realmente excluir?',
            text: "Voc?? n??o poder?? reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, deletar!',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "{{ route('categoria.delete') }}",
                    method: 'delete',
                    data: {
                        id: id,
                        _token: $("meta[name='csrf-token']").attr("content"),
                    },
                    success: function() {
                        document.location.reload(true);
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'Cancelado',
                    text: 'Exclus??o n??o realizada :)',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                })
            }
        })
    }
</script>
