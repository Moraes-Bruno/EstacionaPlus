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
                <a class="btn btn-primary btn-sm" href="{{ route('estacionamento.form')}}">
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
                    @foreach ($estacionamentos as $estacionamento)
                    <tr>
                        <td>
                            <a>
                                {{ $estacionamento->nome }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ $estacionamento->endereco }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ $estacionamento->latitude }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ $estacionamento->longitude }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ $estacionamento->vagas }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <div class="btn-group" role="group" aria-label="Ações">
                                <a class="btn btn-warning btn-sm mx-1" href="{{ route('estacionamento.detalhes', $estacionamento->_id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-info btn-sm mx-1" href="{{ route('estacionamento.form', $estacionamento->_id) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Editar
                                </a>
                                <a class="btn btn-danger btn-sm mx-1" href="{{ route('estacionamento.excluir', $estacionamento->_id) }}" onclick="return confirm('Tem certeza que deseja excluir esse estacionamento?')">
                                <i class="fas fa-trash"></i>
                                        Excluir
                                </a>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
@endsection
