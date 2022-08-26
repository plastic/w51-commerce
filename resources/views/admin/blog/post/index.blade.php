@extends('layouts/contentLayoutMaster')

@section('title', 'Posts')

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

                <div class="col-12">
                    <form method="POST" action="{{ route('blog.search') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <button class="btn btn-outline-primary" type="button">
                                <i data-feather="search"></i>
                            </button>
                            <input type="text" class="form-control form-control-lg" name="search" id="search"
                                value="{{ isset($search) ? $search : '' }}"
                                placeholder="Digite o título ou categoria" />
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
                                        <th class="bg-primary"></th>
                                        <th class="bg-primary text-white">Título</th>
                                        <th class="bg-primary text-white">Categoria</th>
                                        <th class="bg-primary text-white">Data de Cadastro</th>
                                        <th class="bg-primary text-white text-center">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr class="table-line">
                                            <td>{{ $post->id_blog_post }}</td>
                                            <td class="text-center">
                                                @if($post->tx_imagem != null)
                                                <img  src="{{url('imagens/blog/'.$post->tx_imagem)}}" width="70" height="30">
                                                @else
                                                -
                                                 @endif
                                            </td>
                                            <td>{{ $post->tx_titulo }}</td>
                                            <td>{{ $post->categoria->tx_blog_categoria }}</td>

                                            <td>{{ date('d/m/Y H:i', strtotime($post->dh_cadastro))}}</td>


                                            <td class="text-center">
                                                @if($post->st_publicado == 'ATIVO')
                                                    <div class="avatar avatar-status bg-light-success"><span class="avatar-content" title="Sim">
                                                        <i data-feather='check-circle'></i>
                                                    </span></div>
                                                @else
                                                    <div class="avatar avatar-status bg-light-danger"><span class="avatar-content" title="Não">
                                                        <i data-feather='x-octagon'></i>
                                                    </span></div>
                                                @endif

                                            </td>


                                            <td class="actions">
                                                <div class="row">
                                                    <div class="d-flex gap-1 col-actions">

                                                        <form action="{{ route('blog.post.show', ['post' => $post]) }}"
                                                            method="GET">
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                <i data-feather='eye'></i></button>
                                                        </form>

                                                        <form action="{{ route('blog.post.edit', ['post' => $post]) }}"
                                                            method="GET">
                                                            <button type="submit"
                                                                class="btn btn-icon rounded-circle btn-outline-primary waves-effect">
                                                                <i data-feather='edit'></i></button>
                                                        </form>

                                                        <form action="{{ route('blog.post.delete', ['post' => $post]) }}"
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
                                {{ $posts->links() }}
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
