@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="./">Estacionamentos</a></li>
                <li class="breadcrumb-item active">Alterar</li>
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
<section class="content">
    <form action="{{ route('estacionamento.alterar') }}" method="post">
        @csrf
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Informações Gerais</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="<?= $estacionamento->nome ?>">
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" value="<?= $estacionamento->endereco ?>">
                </div>
                <div class="form-group row">
                    <div class="col-5">
                        <label for="lat">Latitude:</label>
                        <input type="text" id="lat" name="lat" class="form-control" value="<?= $estacionamento->lat ?>">
                    </div>
                    <div class="col-5">
                        <label for="lng">Longitude:</label>
                        <input type="text" id="lng" name="lng" class="form-control" value="<?= $estacionamento->lng ?>">
                    </div>
                    <div class="col-2">
                        <label for="totalVagas">Total de Vagas:</label>
                        <input type="number" id="totalVagas" name="totalVagas" class="form-control" value="<?= $estacionamento->vagas ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <b>
                            <p>Tipo de vagas:</p>
                        </b>
                        <label for="normal">
                            <div style="width:50px;height:80px;border-top: 5px solid  grey;border-left: 5px solid  grey; border-right: 5px solid  grey;"></div>
                        </label>
                        <input type="radio" class="mx-2" id="normal" value="normal" name="tipo" <?php if ($estacionamento->tipo == 'normal') {
                                                                                        echo 'checked';
                                                                                    } ?>>
                        <label for="torto">
                            <div style="width:50px;height:80px;border-top: 5px solid  grey;border-left: 5px solid  grey; border-right: 5px solid  grey;transform: skew(14deg);"></div>
                        </label>
                        <input class="mx-2" type="radio" id="torto" value="torto" name="tipo" <?php if ($estacionamento->tipo == 'torto') {
                                                                                    echo 'checked';
                                                                                } ?>>
                    </div>
                    <div class="col-4">
                        <label for="totalX">Total de Vagas Horizontalmente:</label>
                        <input type="number" id="totalX" name="totalX" class="form-control" value="<?= $estacionamento->totalX ?>">
                    </div>
                    <div class="col-4">
                        <label for="totalY">Total de Vagas Verticalmente:</label>
                        <input type="number" id="totalY" name="totalY" class="form-control" value="<?= $estacionamento->totalY ?>">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <!-- /.card -->
        </div>
        <div class="row">
            <div class="col-12">
                <a href="./" class="btn btn-secondary">Cancelar</a>
                <input type="submit" value="Salvar" class="btn btn-warning float-right">
            </div>
        </div>
    </form>
</section>
@endsection
