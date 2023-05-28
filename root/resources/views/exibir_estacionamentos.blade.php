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
                    <?php
                    require app_path('/Classes/Estacionamentos.php');

                    $estacionamento = new Estacionamento;

                    $estacionamentos = $estacionamento->listar();
                    foreach ($estacionamentos as $key => $estacionamento) { ?>
                        <tr>
                            <td>
                                <a>
                                    <?= $estacionamento['titulo'] ?>
                                </a>
                            </td>
                            <td>
                                <a>
                                    <?= $estacionamento['endereco'] ?>
                                </a>
                            </td>
                            <td>
                                <a>
                                    <?= $estacionamento['latitude'] ?>
                                </a>
                            </td>
                            <td>
                                <a>
                                    <?= $estacionamento['longitude'] ?>
                                </a>
                            </td>
                            <td>
                                <a>
                                    <?= $estacionamento['vagas'] ?>
                                </a>
                            </td>
                            <td class="project-actions text-right">
                                <div class="btn-group" role="group" aria-label="Ações">
                                    <a class="btn btn-warning btn-sm mx-1" href="/admin/estacionamentos/detalhes?estacionamento=<?= $estacionamento['id'] ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm mx-1" href="/admin/estacionamentos/alterar?estacionamento=<?= $estacionamento['id'] ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                        Editar
                                    </a>
                                    <form action="{{ route('estacionamento.excluir') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="<?= $estacionamento['id'] ?>">
                                        <button class="btn btn-danger btn-sm mx-1" type="submit">
                                            <i class="fas fa-trash"></i>
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
@endsection
