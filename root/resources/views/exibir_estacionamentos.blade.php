@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Estacionamentos</li>
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
            <h3 class="card-title">Estacionamentos</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <a class="btn btn-primary btn-sm" href="/admin/estacionamentos/adicionar">
                <i class="fas fa-car-side"></i> <b>+</b>
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
                        <th style="width: 20%">
                            Nome
                        </th>
                        <th style="width: 25%">
                            Endereço
                        </th>
                        <th style="width: 5%">
                            Latitude
                        </th>
                        <th style="width: 5%">
                            Longitude
                        </th>
                        <th style="width: 2%">
                            Vagas
                        </th>
                        <th style="width: 37%">
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
                                Spasso Sabores
                            </a>
                            <br />
                            <small>
                                Cadastrado em 01/01/2019
                            </small>
                        </td>
                        <td>
                            <a>
                                Rua tal, Bairro BlaBlaBla, N°
                            </a>
                        </td>
                        <td>
                            <a>
                            -22.432932
                            </a>
                        </td>
                        <td>
                            <a>
                            -46.782457
                            </a>
                        </td>
                        <td>
                            <a>
                            150
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-warning btn-sm" href="/admin/estacionamentos/detalhes">
                                <i class="fas fa-eye">
                                </i>
                            </a>
                            <a class="btn btn-info btn-sm" href="/admin/estacionamentos/alterar">
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
