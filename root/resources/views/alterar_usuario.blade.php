@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Usuários</a></li>
                <li class="breadcrumb-item active">Alterar</li>
            </ol>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<?php
$id = $_GET['usuario'];

require app_path('/Classes/Usuario.php');

$u = new Usuario;

$usuario = $u->listar_especifico($id);
?>
<section class="content">
    <form action="{{ route('usuario.alterar') }}" method="post">
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
                    <input type="text" id="nome" name="nome" class="form-control" value="<?= $usuario->nome ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?= $usuario->email ?>">
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="text" id="senha" name="senha" class="form-control" value="<?= $usuario->senha ?>">
                </div>
                <div class="form-group">
                    <p>Favoritos:</p>
                    <?php
                    require app_path('/Classes/Estacionamentos.php');

                    $estacionamento = new Estacionamento;

                    $estacionamentos = $estacionamento->listar();
                    foreach ($estacionamentos as $key => $estacionamento) {
                        $titulo = $estacionamento['titulo'];

                    ?>
                        <input type="checkbox" name="favoritos[]" value="<?= $estacionamento['titulo'] ?>" <?php foreach ($usuario->favoritos as $favorito) {
                                                                                                                if (str_contains($favorito, $estacionamento['titulo'])) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                        <label for="favoritos"><?= $estacionamento['titulo'] ?></label>
                    <?php } ?>
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
