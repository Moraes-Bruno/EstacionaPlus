@extends('admin')

@section('js')
<script>
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
    const estacionamento = <?php echo json_encode($dados); ?>;
    var dadosVagas = estacionamento.vagas
    // Cria a tabela de vagas
    var tabelaHTML = '<table>';
    for (var i = 0; i < 12; i++) {
        tabelaHTML += '<tr>';
        for (var j = 0; j < 24; j++) {
            var index = i + ',' + j;
            var vaga = dadosVagas[index];
            var tipoVaga = vaga ? vaga.Tipo : 'Vazio';
            var status = vaga.Status == 1 ? 'ocupada' : 'livre';
            var x = i + 1;
            var indexEspacoAbaixo = x + ',' + j;
            var espacoAbaixo = dadosVagas[indexEspacoAbaixo];
            var tipoEspacoAbaixo = espacoAbaixo ? espacoAbaixo.Tipo : null;
            var proximoElementoNaoVazio = tipoEspacoAbaixo && tipoEspacoAbaixo !== "Vazio";
            var z = j - 1;
            var indexEspacoLadoEsquerdo = i + ',' + z;
            var espacoLadoEsquerdo = dadosVagas[indexEspacoLadoEsquerdo];
            var esquerda = espacoLadoEsquerdo && espacoLadoEsquerdo.Tipo !== "Vazio" ? "" : 'ladoEsquerdo';
            var y = j + 1;
            var indexEspacoLadoDireito = i + ',' + y;
            var espacoLadoDireito = dadosVagas[indexEspacoLadoDireito];
            var direita = espacoLadoDireito && espacoLadoDireito.Tipo !== "Vazio" ? "" : 'ladoDireito';
            var lado = esquerda && direita ? esquerda + ' ' + direita : esquerda || direita;
            var w = i - 1;
            var indexEspacoAcima = w + ',' + j;
            var espacoAcima = dadosVagas[indexEspacoAcima];
            var ElementoAnteriorVazio = espacoAcima == null || espacoAcima.Tipo == "Vazio" ? "AnteriorVazio" : "";
            var icone;
            switch (tipoVaga) {
                case "Idoso":
                    icone = '<svg xmlns="http://www.w3.org/2000/svg" height="1.2rem" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M272 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm-8 187.3l47.4 57.1c11.3 13.6 31.5 15.5 45.1 4.2s15.5-31.5 4.2-45.1l-73.7-88.9c-18.2-22-45.3-34.7-73.9-34.7H177.1c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L120 256.9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352h16V480c0 17.7 14.3 32 32 32s32-14.3 32-32V235.3zM352 376c0-4.4 3.6-8 8-8s8 3.6 8 8V488c0 13.3 10.7 24 24 24s24-10.7 24-24V376c0-30.9-25.1-56-56-56s-56 25.1-56 56v8c0 13.3 10.7 24 24 24s24-10.7 24-24v-8z"/></svg>';
                    break;
                case "Deficiente":
                    icone = '<i class="fas fa-solid fa-wheelchair"></i>';
                    break;
                case "Autista":
                    icone = '<i class="fas fa-solid fa-ribbon"></i>';
                    break;
                default:
                    icone = '';
            }
            tabelaHTML += '<td class="' + tipoVaga.toLowerCase() + '">';
            tabelaHTML += '<div style="display: flex; justify-content: center;">';
            tabelaHTML += vaga.Tipo !== "Vazio" ? (vaga.Tipo == "Objeto" ? '<div class="objeto" style="display: flex;justify-content: center;align-items: center;"></div>' : (proximoElementoNaoVazio ? '<div class="vagacima ' + status + ' ' + lado + '" style="display: flex;justify-content: center;align-items: center;"> ' + icone + ' </div>' : '<div class="vaga ' + status + ' ' + lado + ' ' + ElementoAnteriorVazio + '" style="display: flex;justify-content: center;align-items: center;"> ' + icone + ' </div>')) : '<div class="vazio col"></div>';
            tabelaHTML += '</div>';
            tabelaHTML += '</td>';
        }
        tabelaHTML += '</tr>';
    }
    tabelaHTML += '</table>';
    // Insere a tabela no elemento desejado
    document.getElementById('tabela-vagas').innerHTML = tabelaHTML;
</script>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/estacionamento.css') }}">
@endsection
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
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h4>{{ $dados->nome }}</h4>
                    <div>
                        <h5>Endereço: <b>{{ $dados->endereco }}</b></h5>
                        <h5>Latitude: <b>{{ $dados->latitude }}</b></h5>
                        <h5>Longitude: <b>{{ $dados->longitude }}</b></h5>
                        <h5>Total de vagas: <b>{{ $dados->totalVagas }}</b></h5>
                    </div>
                    <div id="tabela-vagas"></div>
                </div>
            </div>
            <div class="btn-group" role="group" aria-label="Ações">
                <a class="btn btn-info btn-sm mx-1" href="{{ route('estacionamento.form', $dados->_id) }}">
                    <i class="fas fa-pencil-alt"></i>
                    Editar
                </a>
                <a class="btn btn-danger btn-sm mx-1" href="{{ route('estacionamento.excluir', $dados->_id) }}" onclick="return confirm('Tem certeza que deseja excluir esse estacionamento?')">
                    <i class="fas fa-trash"></i>
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
