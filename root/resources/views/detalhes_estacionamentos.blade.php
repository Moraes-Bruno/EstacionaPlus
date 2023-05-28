@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/estacionamentos">Estacionamentos</a></li>
                <li class="breadcrumb-item active">Detalhes</li>
            </ol>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<?php
$id = $_GET['estacionamento'];

require app_path('/Classes/Estacionamentos.php');

$e = new Estacionamento;

$estacionamento = $e->listar_especifico($id);
?>
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
                    <h4><?= $estacionamento->nome ?></h4>
                    <div class="post">
                        <h5>Endereço: <b><?= $estacionamento->endereco ?></b></h5>
                        <h5>Latitude: <b><?= $estacionamento->lat ?></b></h5>
                        <h5>Longitude: <b><?= $estacionamento->lng ?></b></h5>
                        <h5>Total de vagas: <b><?= $estacionamento->vagas ?></b></h5>
                        <h5>Inclinação das vagas: "<b><?= $estacionamento->tipo ?></b>"</h5>
                        <h5>Total de vagas Horizontalmente: <b><?= $estacionamento->totalX ?></b></h5>
                        <h5>Total de vagas Verticalmente: <b><?= $estacionamento->totalY ?></b></h5>
                    </div>
                </div>
            </div>
            <div class="btn-group" role="group" aria-label="Ações">
                <a class="btn btn-info btn-sm mx-1" href="/admin/estacionamentos/alterar?estacionamento=<?= $id ?>">
                    <i class="fas fa-pencil-alt"></i>
                    Editar
                </a>
                <form action="{{ route('estacionamento.excluir') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id" value="<?= $id ?>">
                    <button class="btn btn-danger btn-sm mx-1" type="submit">
                        <i class="fas fa-trash"></i>
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

@endsection
