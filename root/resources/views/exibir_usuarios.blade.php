@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Usuários</li>
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
            <h3 class="card-title">Usuários</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <a class="btn btn-primary btn-sm" href="/admin/usuarios/adicionar">
                    <i class="fas fa-user-plus">
                    </i>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            ID
                        </th>
                        <th style="width: 25%">
                            Nome
                        </th>
                        <th style="width: 24%">
                            Email
                        </th>
                        <th style="width: 15%">
                            N° de Favoritos
                        </th>
                        <th style="width: 35%">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            #
                        </td>
                        <td>
                            <a>
                                Fulano de Tal da Silva
                            </a>
                            <br />
                            <small>
                                Cadastrado em 01/01/2019
                            </small>
                        </td>
                        <td>
                            <a>
                                Fulano_deTal@gmail.com
                            </a>
                        </td>
                        <td>
                            <a>
                                1
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-warning btn-sm" href="/admin/usuarios/detalhes">
                                <i class="fas fa-eye">
                                </i>
                            </a>
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
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
@endsection
