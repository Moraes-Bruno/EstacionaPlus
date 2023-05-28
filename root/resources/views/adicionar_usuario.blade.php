@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Usuários</a></li>
                <li class="breadcrumb-item active">Adicionar</li>
            </ol>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<section class="content">
    <form action="{{ route('usuario.inserir') }}" method="post">
        @csrf
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Informações Gerais</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" class="form-control">
                </div>
                <div class="form-group">
                    <p>Favoritos:</p>
                    <?php
                    require app_path('/Classes/Estacionamentos.php');

                    $estacionamento = new Estacionamento;

                    $estacionamentos = $estacionamento->listar();
                    foreach ($estacionamentos as $key => $estacionamento) { ?>
                        <input type="checkbox" name="favoritos[]" value="<?= $estacionamento['titulo'] ?>">
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
                <input type="submit" value="Cadastrar" class="btn btn-success float-right">
            </div>
        </div>
    </form>
</section>
@endsection
