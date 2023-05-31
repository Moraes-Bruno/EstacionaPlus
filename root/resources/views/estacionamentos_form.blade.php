@extends('admin')

@section('js')
<script>
    function initMap() {
        // Posição inicial do mapa
        const posicaoInicial = {
            lat: -22.434050,
            lng: -46.828170
        };

        // Opções do mapa
        const opcoesMapa = {
            zoom: 15,
            center: posicaoInicial
        };

        // Criação do mapa
        const mapa = new google.maps.Map(document.getElementById('map'), opcoesMapa);

        const marcador = new google.maps.Marker({
            map: mapa, // O mapa onde o marcador será exibido
            draggable: true, // Permite arrastar o marcador
        });

        // Evento de clique no mapa
        google.maps.event.addListener(mapa, 'click', function(event) {
            // Obtém as coordenadas do local onde foi clicado
            const latitude = event.latLng.lat();
            const longitude = event.latLng.lng();

            // Atualiza os campos de latitude e longitude
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

            // Define as coordenadas do marcador
            marcador.setPosition(event.latLng);
        });
    }
</script>
@endsection
@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="./">Estacionamentos</a></li>
                <li class="breadcrumb-item active">Adicionar</li>
            </ol>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<section class="content m-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 h-100">
                <div id="map" class="w-100" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    @if(isset($dados))
    <form action="{{ route('estacionamento.alterar', $dados->_id) }}" method="post">
        @csrf
        @method('PUT')
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
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="{{ $dados->nome }}">
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" value="{{ $dados->endereco }}">
                </div>
                <div class="form-group row">
                    <div class="col-5">
                        <label for="latitude">Latitude:</label>
                        <input type="text" id="latitude" name="latitude" class="form-control" value="{{ $dados->latitude }}">
                    </div>
                    <div class="col-5">
                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" class="form-control" value="{{ $dados->longitude }}">
                    </div>
                    <div class="col-2">
                        <label for="vagas">Total de Vagas:</label>
                        <input type="number" id="vagas" name="vagas" class="form-control" value="{{ $dados->vagas }}">
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
                        <input type="radio" class="mx-2" id="normal" value="normal" name="tipo" @if($dados->tipo == 'normal') checked @endif>
                        <label for="torto">
                            <div style="width:50px;height:80px;border-top: 5px solid  grey;border-left: 5px solid  grey; border-right: 5px solid  grey;transform: skew(14deg);"></div>
                        </label>
                        <input class="mx-2" type="radio" id="torto" value="torto" name="tipo" @if($dados->tipo == 'torto') checked @endif>
                    </div>
                    <div class="col-4">
                        <label for="totalX">Total de Vagas Horizontalmente:</label>
                        <input type="number" id="totalX" name="totalX" class="form-control" value="{{ $dados->totalX }}">
                    </div>
                    <div class="col-4">
                        <label for="totalY">Total de Vagas Verticalmente:</label>
                        <input type="number" id="totalY" name="totalY" class="form-control" value="{{ $dados->totalY }}">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <!-- /.card -->
        </div>
        <div class="row">
            <div class="col-12">
                <a href="../" class="btn btn-secondary">Cancelar</a>
                <input type="submit" value="Salvar" class="btn btn-warning float-right">
            </div>
        </div>
    </form>
    @else
    <form action="{{ route('estacionamento.inserir') }}" method="post">
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
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" class="form-control">
                </div>
                <div class="form-group row">
                    <div class="col-5">
                        <label for="latitude">latitudeitude:</label>
                        <input type="text" id="latitude" name="latitude" class="form-control">
                    </div>
                    <div class="col-5">
                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" class="form-control">
                    </div>
                    <div class="col-2">
                        <label for="vagas">Total de Vagas:</label>
                        <input type="number" id="vagas" name="vagas" class="form-control">
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
                        <input type="radio" value="normal" class="mx-2" id="normal" name="tipo">
                        <label for="torto">
                            <div style="width:50px;height:80px;border-top: 5px solid  grey;border-left: 5px solid  grey; border-right: 5px solid  grey;transform: skew(14deg);"></div>
                        </label>
                        <input class="mx-2" value="torto" type="radio" id="torto" name="tipo">
                    </div>
                    <div class="col-4">
                        <label for="totalX">Total de Vagas Horizontalmente:</label>
                        <input type="number" id="totalX" name="totalX" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="totalY">Total de Vagas Verticalmente:</label>
                        <input type="number" id="totalY" name="totalY" class="form-control">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <!-- /.card -->
        </div>
        <div class="row">
            <div class="col-12">
                <a href="../" class="btn btn-secondary">Cancelar</a>
                <input type="submit" value="Salvar" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    @endif
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtI-_4umSKFC-kkL4yNoUTRfBI-Qo0NDM&callback=initMap&v=weekly" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</section>
@endsection
