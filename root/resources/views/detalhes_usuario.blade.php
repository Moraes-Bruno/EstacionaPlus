@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/usuarios">Usuários</a></li>
                <li class="breadcrumb-item active">Detalhes</li>
            </ol>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informações Gerais</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12">
                            <h4>{{ $dados->nome }}</h4>
                            <div class="post">
                                <a href="#">{{ $dados->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4 order-1 order-md-2">
                    <h4>Favoritos</h4>
                    <ul class="list-unstyled">

                        @if($dados->favoritos!=NULL)
                        @foreach ( $dados->favoritos as $favorito)
                        <li>
                            <a href="" class="btn-link text-secondary"> <small><i class="fas fa-heart">
                                    </i></small> {{ $favorito }} </a>
                        </li>
                        @endforeach
                        @else
                        <p class="text-muted">Esse usuário não possui favoritos.</p>
                        @endif
                    </ul>
                    <div class="btn-group" role="group" aria-label="Ações">
                        <a class="btn btn-info btn-sm mx-1" href="{{ route('usuario.form', $dados->_id) }}">
                            <i class="fas fa-pencil-alt"></i>
                            Editar
                        </a>
                        <a class="btn btn-danger btn-sm mx-1" href="{{ route('usuario.excluir', $dados->_id) }}" onclick="return confirm('Tem certeza que deseja excluir esse usuário?')">
                            <i class="fas fa-trash"></i>
                            Excluir
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

@endsection
