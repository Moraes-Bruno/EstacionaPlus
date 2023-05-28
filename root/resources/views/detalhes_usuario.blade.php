@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/usuarios">Usuários</a></li>
                <li class="breadcrumb-item active">Detalhes</li>
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
                            <h4><?= $usuario->nome ?></h4>
                            <div class="post">
                                <a href="#"><?= $usuario->email ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4 order-1 order-md-2">
                    <h4>Favoritos</h4>
                    <ul class="list-unstyled">
                        <?php $fav = $usuario->favoritos;
                        foreach ($fav as $favorito) { ?>
                            <li>
                                <a href="" class="btn-link text-secondary"> <small><i class="fas fa-heart">
                                        </i></small> <?= $favorito ?> </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="btn-group" role="group" aria-label="Ações">
                        <a class="btn btn-info btn-sm mx-1" href="/admin/usuarios/alterar?usuario=<?= $id ?>">
                            <i class="fas fa-pencil-alt"></i>
                            Editar
                        </a>
                        <form action="{{ route('usuario.excluir') }}" method="post">
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
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

@endsection
