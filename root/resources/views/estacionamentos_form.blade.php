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
    // layout-estacionamento.js
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            var checkbox = $(this);
            var isChecked = checkbox.is(":checked");
            var td = checkbox.closest('td');

            if (isChecked) {
                changeVagaType(checkbox, td);
            } else {
                clearVagaType(checkbox, td);
            }
        });
    });

    function changeVagaType(checkbox, td) {
        var vagaTypes = ["Normal", "Deficiente", "Idoso", "Autista", "Objeto"];
        var currentType = checkbox.val();
        var currentIndex = vagaTypes.indexOf(currentType);
        var nextIndex = (currentIndex + 1) % vagaTypes.length;
        var nextType = vagaTypes[nextIndex];

        checkbox.closest('td').find('input[id^="tipo"]').val(nextType);
        td.removeClass(vagaTypes.join(' ')).addClass(nextType.toLowerCase());

        if (currentType === "Objeto") {
            td.removeClass().data('vagaType', '');
            checkbox.closest('td').find('input[id^="tipo"]').val('Vazio');
        } else {
            td.data('vagaType', nextType);
        }
    }

    function clearVagaType(checkbox, td) {
        var vagaTypes = ["Normal", "Deficiente", "Idoso", "Autista", "Objeto"];

        checkbox.val("");
        td.removeClass(vagaTypes.join(' '));

        var prevType = td.data('vagaType');
        if (prevType) {
            td.addClass(prevType.toLowerCase());
            checkbox.val(prevType);
        }
    }
</script>
@endsection
@section('css')
<style>
    .normal {
        background-color: #88A0A8;
        color: white;
        /* Cor para vaga normal */
    }

    .deficiente {
        background-color: #546A76;
        color: white;
        /* Cor para vaga de deficiente */
    }

    .idoso {
        background-color: #334751;
        color: white;
        /* Cor para vaga de idoso */
    }

    .autista {
        background-color: #B4656F;
        color: white;
        /* Cor para vaga de autista */
    }

    .objeto {
        background-color: #302b33;
        color: white;
        /* Cor para vaga com objeto */
    }

    .vazio {
        background-color: white;
        /* Cor para vaga vazia */
    }
</style>
@endsection
@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/estacionamentos">Estacionamentos</a></li>
                <li class="breadcrumb-item active">Formulário</li>
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
                        <label for="totalVagas">Total de Vagas:</label>
                        <input type="number" id="totalVagas" name="totalVagas" class="form-control" value="{{ $dados->totalVagas }}">
                    </div>
                </div>
                <b>
                    <p>Modifique abaixo o layout do seu estacionamento:</p>
                </b>
                <div class="row lead">
                    <span class=" badge col m-1 normal">Vaga Normal</span>
                    <span class=" badge col m-1 deficiente">Vaga para Deficientes</span>
                    <span class=" badge col m-1 idoso">Vaga para Idosos</span>
                    <span class=" badge col m-1 autista">Vaga para Autistas</span>
                    <span class=" badge col m-1 objeto">Objeto Qualquer</span>
                    <span class=" badge border border-secondary col m-1 vazio">Espaço Vazio</span>
                </div>
                <?php
                // Inicializa a matriz vazia
                $matrix = array_fill(0, 12, array_fill(0, 24, null));

                // Preenche a matriz com os elementos da array de vagas
                foreach ($dados->vagas as $key => $vaga) {
                    $posicao = explode(",", $key);
                    $i = $posicao[0];
                    $j = $posicao[1];
                    $matrix[$i][$j] = $vaga;
                }
                ?>
                <table class="table table-bordered">
                    @for ($i = 0; $i < 12; $i++) <tr>
                        @for ($j = 0; $j < 24; $j++) <?php $index = "$i,$j"; ?> <td class="<?php echo strtolower($matrix[$i][$j]['Tipo']) ?>">
                            <div style="display: flex; justify-content: center;">
                                <label for="vagas[]"></label>
                                <input type="checkbox" id="vaga{{ $index }}" name="vagas[]" value="{{ $index }}" @if($matrix[$i][$j]['Tipo'] !="Vazio" && $matrix[$i][$j]['Tipo'] != null) checked @endif>
                            </div>
                            <input type="hidden" name="vagas[{{ $index }}][Posição]" id="posicao" value="{{ $index }}">
                            <input type="hidden" name="vagas[{{ $index }}][Tipo]" id="tipo" value="{{ $matrix[$i][$j]['Tipo'] }}">
                            <input type="hidden" name="vagas[{{ $index }}][Status]" id="status" value="{{ $matrix[$i][$j]['Status'] }}">
                            </td>

                            @endfor
                            </tr>
                            @endfor
                </table>
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
                        <label for="latitude">Latitude:</label>
                        <input type="text" id="latitude" name="latitude" class="form-control">
                    </div>
                    <div class="col-5">
                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" class="form-control">
                    </div>
                    <div class="col-2">
                        <label for="totalVagas">Total de Vagas:</label>
                        <input type="number" id="totalVagas" name="totalVagas" class="form-control">
                    </div>
                </div>
                <b>
                    <p>Insira abaixo o layout do seu estacionamento:</p>
                </b>
                <div class="row lead">
                    <span class=" badge col m-1 normal">Vaga Normal</span>
                    <span class=" badge col m-1 deficiente">Vaga para Deficientes</span>
                    <span class=" badge col m-1 idoso">Vaga para Idosos</span>
                    <span class=" badge col m-1 autista">Vaga para Autistas</span>
                    <span class=" badge col m-1 objeto">Objeto Qualquer</span>
                    <span class=" badge border border-secondary col m-1 vazio">Espaço Vazio</span>
                </div>
                <table class="table table-bordered">
                    @for ($i = 0; $i < 12; $i++) <tr>
                        @for ($j = 0; $j < 24; $j++) <?php $index = "$i,$j"; ?> <td>
                            <div style="display: flex; justify-content: center;">
                                <input type="checkbox" id="vaga{{ $index }}" name="vagas[]" value="{{ $index }}">
                            </div>
                            <input type="hidden" name="tipoVaga{{ $index }}" id="tipoVaga{{ $index }}" value="Vazio">
                            </td>
                            @endfor
                            </tr>
                            @endfor
                </table>
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