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
        <div class="card-body" style="height:800px;">
            <div class="row">
                <div class="col-12">
                    <h4>Spasso Sabores</h4>
                    <div class="post">
                        <h5>Endereço: <b>Rua Tal, Bairro BlaBLaBla, N° 13546</b></h5>
                        <h5>Latitude: <b>-22.432932</b></h5>
                        <h5>Longitude: <b>-46.782457</b></h5>
                        <h5>Total de vagas: <b>150</b></h5>
                    </div>
                </div>
            </div>
            <div id="estacionamento" class="container">
                <div class="row">
                    <div class="vagacima col ladoEsquerdo"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col ladoDireito"></div>
                </div>
                <div class="row pb-5">
                    <div class="vaga col ladoEsquerdo"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col ladoDireito"></div>
                </div>
                <div class="row pt-5">
                    <div class="vagacima col ladoEsquerdo"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col"></div>
                    <div class="vagacima col ladoDireito"></div>
                </div>
                <div class="row">
                    <div class="vaga col ladoEsquerdo"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col"></div>
                    <div class="vaga col ladoDireito"></div>
                </div>
            </div>
            <div class="text-center mt-5 mb-3 float-right">
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
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

@endsection
