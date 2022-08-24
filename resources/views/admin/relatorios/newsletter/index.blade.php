@extends('layouts/contentLayoutMaster')

@section('title', 'Newsletter')

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
            <div class="row align-items-center">

                <div class="col-md-9 col-12">
                    <form method="POST" action="{{ route('newsletter.search') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <button class="btn btn-outline-primary" type="button">
                                <i data-feather="search"></i>
                            </button>
                            <input type="text" class="form-control form-control-lg" name="search" id="search"
                                value="{{ isset($search) ? $search : '' }}"
                                placeholder="Digite o Nome ou E-mail" aria-label="Amount" />
                            <button class="btn btn-outline-primary" type="submit">Buscar</button>
                        </div>
                    </form>
                </div>

                <div class=" col-md-3">
                    <div class="d-flex justify-content-end">
                        <a class="nav-link" href="{{route('newsletter.export', ['search' => isset($search) ? $search : ''] ) }}">
                            <div class="btn-export">
                                <button class="btn btn-primary ag-grid-export-btn d-flex align-items-center">
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
                                        <th class="bg-primary text-white">Página</th>
                                        <th class="bg-primary text-white">Nome</th>
                                        <th class="bg-primary text-white">E-mail</th>
                                        <th class="bg-primary text-white">Data de Cadastro</th>
                                        <th class="bg-primary text-white text-center">Status</th>
                                        <th class="bg-primary text-white text-center">Optin
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="O usuário recebeu o e-mail e ativou o cadastro"><i data-feather='alert-circle' ></i></a>
                                        </th>
                                        <th class="bg-primary text-white rounded-end text-center">Sync
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Registro sincronziado com o sistema"><i data-feather='alert-circle' ></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newsletter as $lead)
                                        <tr>
                                            <td>{{ $lead->id }}</td>
                                            <td>{{ $lead->tx_pagina }}</td>
                                            <td>{{ $lead->name }}</td>
                                            <td><a href="mailto:{{ $lead->email }}" class="text-dark">{{ $lead->email }}</a></td>
                                            <td>{{ date('d/m/Y H:i', strtotime($lead->dh_cadastro));}}</td>
                                            <td class="text-center">
                                                <form action="{{ route('newsletter.active', ['id' => $lead->id, 'status' => $lead->st_ativo, 'page' => isset($_GET['page']) ? $_GET['page'] : '']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn" title="Clique para mudar o status">
                                                @if( $lead->st_ativo == 'ATIVO')
                                                    <span class="badge rounded-pill badge-light-success" text-capitalized=""> {{ ucfirst(strtolower($lead->st_ativo)) }}</span>
                                                @elseif( $lead->st_ativo == 'INATIVO')
                                                    <span class="badge rounded-pill badge-light-warning" text-capitalized=""> {{ ucfirst(strtolower($lead->st_ativo)) }}</span>
                                                @else
                                                    <span class="badge rounded-pill badge-light-secondary" text-capitalized=""> {{ ucfirst(strtolower($lead->st_ativo)) }}</span>
                                                @endif

                                                </button></form>

                                            </td>
                                            <td class="text-center">
                                                @if($lead->dh_validacao_email == null || $lead->dh_validacao_email == '0000-00-00 00:00:00')
                                                    <div class="avatar avatar-status bg-light-danger"><span class="avatar-content" title="Inativo">
                                                        <i data-feather='x-octagon'></i>
                                                    </span></div>
                                                @else
                                                    <div class="avatar avatar-status bg-light-success"><span class="avatar-content" title="Ativado {{ date('d/m/Y H:i', strtotime($lead->dh_validacao_email));}}">
                                                        <i data-feather='check-circle'></i>
                                                    </span></div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($lead->sincronizado)
                                                    <div class="avatar avatar-status bg-light-success"><span class="avatar-content" title="Sim">
                                                        <i data-feather='check-circle'></i>
                                                    </span></div>
                                                @else
                                                    <div class="avatar avatar-status bg-light-danger"><span class="avatar-content" title="Não">
                                                        <i data-feather='x-octagon'></i>
                                                    </span></div>
                                                @endif

                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- PAGINATION --}}
                            <div class="row justify-content-center mx-0 px-0">
                                {{ $newsletter->links() }}
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
