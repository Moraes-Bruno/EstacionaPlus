@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/estacionamentos">Estacionamentos</a></li>
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
                <div class="col-12">
                    <h4>{{ $dados->nome }}</h4>
                    <div class="post">
                        <h5>Endereço: <b>{{ $dados->endereco }}</b></h5>
                        <h5>Latitude: <b>{{ $dados->latitude }}</b></h5>
                        <h5>Longitude: <b>{{ $dados->longitude }}</b></h5>
                        <h5>Total de vagas: <b>{{ $dados->totalVagas }}</b></h5>
                        <h5>Inclinação das vagas: "<b>{{ $dados->tipo }}</b>"</h5>
                        <h5>Total de vagas Horizontalmente: <b>{{ $dados->totalX }}</b></h5>
                        <h5>Total de vagas Verticalmente: <b>{{ $dados->totalY }}</b></h5>
                    </div>
                </div>
            </div>
            <div class="btn-group" role="group" aria-label="Ações">
                <a class="btn btn-info btn-sm mx-1" href="{{ route('estacionamento.form', $dados->_id) }}">
                    <i class="fas fa-pencil-alt"></i>
                    Editar
                </a>
                <a class="btn btn-danger btn-sm mx-1" href="{{ route('estacionamento.excluir', $dados->_id) }}" onclick="return confirm('Tem certeza que deseja excluir esse estacionamento?')">
                    <i class="fas fa-trash"></i>
                    Excluir
                </a>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

@endsection
