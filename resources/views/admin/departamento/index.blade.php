@extends('layouts/contentLayoutMaster')

@section('title', 'Departamento')

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
                                placeholder="Digite o nome do departamento" aria-label="Amount" />
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
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="datatables-basic table">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="bg-primary text-white rounded-start">Id</th>
                                        <th class="bg-primary text-white">Nome</th>
                                        <th class="bg-primary text-white text-center">Menu Principal</th>
                                        <th class="bg-primary text-white text-center">Banner</th>
                                        <th class="bg-primary text-white text-center rounded-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departamentos as $departamento)
                                        <tr class="table-line">
                                            <td>{{ $departamento->id_departamento }}</td>
                                            <td>{{ $departamento->tx_departamento }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    @if ($departamento->st_menu_principal == true)
                                                        <span class="badge rounded-pill badge-light-success"
                                                            text-capitalized="">sim</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-light-warning"
                                                            text-capitalized="">não</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($departamento->tx_banner != null)
                                                    <img src="{{ url('imagens/departamentos/' . $departamento->tx_banner) }}"
                                                        alt="Avatar" width="70" height="30">
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    @if ($departamento->st_publicado == 'ATIVO')
                                                        <span class="badge rounded-pill badge-light-success"
                                                            text-capitalized="">
                                                            {{ ucfirst(strtolower($departamento->st_publicado)) }}</span>
                                                    @elseif($departamento->st_publicado == 'INATIVO')
                                                        <span class="badge rounded-pill badge-light-warning"
                                                            text-capitalized="">
                                                            {{ ucfirst(strtolower($departamento->st_publicado)) }}</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-light-secondary"
                                                            text-capitalized="">
                                                            {{ ucfirst(strtolower($departamento->st_publicado)) }}</span>
                                                    @endif
                                                </div>

                                            </td>
                                            <td class="actions">
                                                <div class="row">
                                                    <div class="d-flex gap-1 col-actions">
                                                        <div>
                                                            <form
                                                                action="{{ route('departamento.show', ['departamento' => $departamento]) }}"
                                                                method="GET">
                                                                <button type="submit"
                                                                    class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                    <i data-feather='eye'></i></button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <form
                                                                action="{{ route('departamento.edit', ['departamento' => $departamento]) }}"
                                                                method="GET">
                                                                <button type="submit"
                                                                    class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                    <i data-feather='edit'></i></button>
                                                            </form>
                                                        </div>

                                                        <div>
                                                            <button
                                                                onclick="deleteDepartamento({{ $departamento->id_departamento }} , {{ $departamento->categorias->count() }})"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect"><i
                                                                    data-feather='trash-2'></i>
                                                            </button>
                                                        </div>

                                                    </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- PAGINATION --}}
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                    {{ $departamentos->links() }}
                                </div>
                            </div>
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
    function deleteDepartamento(id, categorias) {

        if (categorias > 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops... ',
                text: 'Para deletar esse departamento, ele não deve possuir nenhuma categoria vinculada.',
                footer: '<a href="{{route('categoria.index')}}"><i data-feather="external-link"></i>ir para Categorias</a>'
            })
            return;
        }

        Swal.fire({
            title: 'Deseja realmente excluir?',
            text: "Você não poderá reverter isso!",
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
                    url: "{{ route('departamento.delete') }}",
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
                    text: 'Exclusão não realizada :)',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                })
            }
        })
    }
</script>
