@extends('layouts/contentLayoutMaster')

@section('title', 'Administradores')

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
            <div class="row ">

                <div class=" col-md-3">
                    <div class="d-grid">
                        <a class="btn btn-outline-primary waves-effect p-1" data-bs-toggle="modal"
                            data-bs-target="#modals-slide-in"> Novo</a>
                    </div>
                </div>

                <div class="col-md-9 col-12">
                    <form method="POST" action="{{ route('user.search') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <button class="btn btn-outline-primary" type="button">
                                <i data-feather="search"></i>
                            </button>
                            <input type="text" class="form-control form-control-lg" name="search" id="search"
                                value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                                placeholder="Digite o Nome ou E-mail" aria-label="Amount" />
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
                                        <th class="bg-primary text-white rounded-start">Nome</th>
                                        <th class="bg-primary text-white">E-mail</th>
                                        <th class="bg-primary text-white rounded-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="d-flex gap-1 col-actions">

                                                        <form action="{{ route('user.show', ['user' => $user]) }}"
                                                            method="GET">
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                <i data-feather='eye'></i></button>
                                                        </form>

                                                        <form action="{{ route('user.edit', ['user' => $user]) }}"
                                                            method="GET">
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                <i data-feather='edit'></i></button>
                                                        </form>

                                                        <form action="{{ route('user.delete', ['user' => $user]) }}"
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
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Basic table -->
        </div>
    </div>
    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-lg">
            <form class="add-new-record modal-content pt-0" method="POST" action="{{ route('user.store') }}"
                enctype="multipart/form-data">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Usúario</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="name" placeholder="Nome" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Digite seu e-mail"
                            required />
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Senha</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                tabindex="2" required />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirmar senha</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                tabindex="3" required />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary data-submit me-1">Enviar</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
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
