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
                            <h4>Fulano de Tal da Silva</h4>
                            <div class="post">
                                <a href="#">Fulano_deTal@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4 order-1 order-md-2">
                    <h4>Favoritos</h4>
                    <ul class="list-unstyled">
                        <li>
                            <a href="" class="btn-link text-secondary"> <small><i class="fas fa-heart">
                                    </i></small> Spasso Sabores</a>
                        </li>
                    </ul>
                    <div class="text-center mt-5 mb-3 float-right">
                        <a class="btn btn-info btn-sm" href="/admin/usuarios/alterar">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Editar
                        </a>
                        <a class="btn btn-danger btn-sm" href="#">
                            <i class="fas fa-trash">
                            </i>
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
