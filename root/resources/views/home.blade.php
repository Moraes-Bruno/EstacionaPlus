<<html lang="pt-br">

    <head>

        <link rel="stylesheet" href="../css/estacionamento.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EstacionaMais</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/estacionamento.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script>
            function initMap() {
                const posicaoInicial = {
                    lat: -22.434050,
                    lng: -46.828170
                };
                const opcoesMapa = {
                    zoom: 15,
                    center: posicaoInicial
                };
                const mapa = new google.maps.Map(document.getElementById('map'), opcoesMapa);
                const estacionamentos = <?php echo json_encode($estacionamentos); ?>;
                estacionamentos.forEach(estacionamento => {
                    const marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(estacionamento.latitude),
                            lng: parseFloat(estacionamento.longitude)
                        },
                        map: mapa,
                        title: estacionamento.nome
                    });
                    marker.addListener('click', () => {
                        exibirModal(estacionamento);
                        fazerRequisicao(estacionamento);
                    });
                });

                var intervaloAtualizacao;

                // Função para atualizar o modal
                function atualizarModal(estacionamento, dadosVagas) {
                    // Atualize dinamicamente o conteúdo do modal com base nos dados recebidos
                    document.getElementById('modal-titulo').textContent = estacionamento.nome;
                    document.getElementById('modal-vagas').textContent = 'Total de Vagas: ' + estacionamento.totalVagas;

                    // Atualize a tabela de vagas
                    atualizarTabelaVagas(dadosVagas);
                    qtdVagaDisponivel(dadosVagas);

                }

                function qtdVagaDisponivel(dadosVagas) {
                    var disponivel = 0;

                    for (var i = 0; i < 12; i++) {
                        for (var j = 0; j < 24; j++) {
                            var index = i + ',' + j;
                            var vaga = dadosVagas[index];
                            if (vaga.Status == 0 && vaga.Tipo != "Vazio") {
                                disponivel += 1;
                            } else if (vaga.Status == 1 && vaga.Tipo != "Vazio") {
                                disponivel  >= 0? -1 : disponivel = 0
                            }
                        }
                    }

                    document.getElementById('modal-vagas_disponiveis').textContent = 'Vagas Disponíveis: ' + disponivel;
                }


                // Função para atualizar a tabela de vagas
                function atualizarTabelaVagas(dadosVagas) {
                    // Atualize dinamicamente a tabela de vagas com base nos dados recebidos
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
                            var lado = esquerda || direita;
                            var w = i - 1;
                            var indexEspacoAcima = w + ',' + j;
                            var espacoAcima = dadosVagas[indexEspacoAcima];
                            var ElementoAnteriorVazio = espacoAcima == null || espacoAcima.Tipo == "Vazio" ? "AnteriorVazio" : "";
                            var icone;

                            switch (tipoVaga) {
                                case "Idoso":
                                    icone = '<svg xmlns="http://www.w3.org/2000/svg" height="1.2rem" viewBox="0 0 512 512"><path d="M272 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm-8 187.3l47.4 57.1c11.3 13.6 31.5 15.5 45.1 4.2s15.5-31.5 4.2-45.1l-73.7-88.9c-18.2-22-45.3-34.7-73.9-34.7H177.1c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L120 256.9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352h16V480c0 17.7 14.3 32 32 32s32-14.3 32-32V235.3zM352 376c0-4.4 3.6-8 8-8s8 3.6 8 8V488c0 13.3 10.7 24 24 24s24-10.7 24-24V376c0-30.9-25.1-56-56-56s-56 25.1-56 56v8c0 13.3 10.7 24 24 24s24-10.7 24-24v-8z"/></svg>';
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

                            if (vaga.Tipo !== "Vazio") {
                                if (vaga.Tipo == "Objeto") {
                                    tabelaHTML += '<div class="objeto"></div>';
                                } else if (status == "ocupada" && proximoElementoNaoVazio) {
                                    tabelaHTML += '<div class="vaga-container ' + status + '">';
                                    tabelaHTML += '<div class="imgsCarros"><img src="../img/car-upsidedown.png" alt=""></div>';
                                } else if (status == "ocupada") {
                                    tabelaHTML += '<div class="vaga-container ' + status + '">';
                                    tabelaHTML += '<div class="imgsCarros"><img src="../img/car.png" alt=""></div>';
                                } else if (status == "livre") {
                                    tabelaHTML += '<div class="vaga-container ' + status + '">';
                                    tabelaHTML += '<div class="d-flex align-items-center justify-content-center" style="padding-top:10px;">' + icone + '</div>';
                                }
                            } else {
                                tabelaHTML += '<div class="vazio col"></div>';
                            }

                            tabelaHTML += '</div>';
                            tabelaHTML += '</td>';


                            //console.log(vaga);
                        }

                        tabelaHTML += '</tr>';
                    }

                    tabelaHTML += '</table>';


                    // Insira a tabela atualizada no elemento desejado
                    document.getElementById('tabela-vagas').innerHTML = tabelaHTML;
                }

                // Função para fazer a requisição AJAX e atualizar o modal
                function fazerRequisicao(estacionamento) {
                    try {
                        if (estacionamento && estacionamento.nome) {
                            var nome = estacionamento.nome;
                            $.ajax({
                                url: '/rota-status' + nome,
                                method: 'GET',
                                dataType: 'json',
                                success: function(dados) {
                                    //console.log('Dados carregados com sucesso:', dados);
                                    atualizarModal(estacionamento, dados.vagas);
                                },
                                error: function(erro) {
                                    console.error('Erro ao carregar dados:', erro);
                                }
                            });
                        } else {
                            throw new Error('Estacionamento ou nome de estacionamento não definido.');
                        }
                    } catch (erro) {
                        console.error('Ocorreu um erro:', erro.message);
                    }
                }


                // Lidera o evento de fechamento do modal para limpar o intervalo
                $('#meuModal').on('hidden.bs.modal', function() {
                    clearInterval(intervaloAtualizacao);
                });

                function exibirModal(estacionamento) {
                    document.getElementById('modal-titulo').textContent = estacionamento.nome;
                    document.getElementById('modal-vagas').textContent = 'Total de Vagas: ' + estacionamento.totalVagas;
                    document.getElementById('modal-vagas_disponiveis').textContent = 'Vagas Disponíveis: '
                    document.getElementById('modal-endereco').textContent = 'Endereço: ' + estacionamento.endereco;
                    // Dados das vagas obtidos do controlador (exemplo)
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
                            var lado = esquerda || direita;
                            var w = i - 1;
                            var indexEspacoAcima = w + ',' + j;
                            var espacoAcima = dadosVagas[indexEspacoAcima];
                            var ElementoAnteriorVazio = espacoAcima == null || espacoAcima.Tipo == "Vazio" ? "AnteriorVazio" :
                                "";
                            var icone;
                            switch (tipoVaga) {
                                case "Idoso":
                                    icone =
                                        '<svg xmlns="http://www.w3.org/2000/svg" height="1.2rem" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M272 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm-8 187.3l47.4 57.1c11.3 13.6 31.5 15.5 45.1 4.2s15.5-31.5 4.2-45.1l-73.7-88.9c-18.2-22-45.3-34.7-73.9-34.7H177.1c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L120 256.9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352h16V480c0 17.7 14.3 32 32 32s32-14.3 32-32V235.3zM352 376c0-4.4 3.6-8 8-8s8 3.6 8 8V488c0 13.3 10.7 24 24 24s24-10.7 24-24V376c0-30.9-25.1-56-56-56s-56 25.1-56 56v8c0 13.3 10.7 24 24 24s24-10.7 24-24v-8z"/></svg>';
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

                            if (vaga.Tipo !== "Vazio") {
                                if (vaga.Tipo == "Objeto") {
                                    tabelaHTML += '<div class="objeto"></div>';
                                } else if (status == "ocupada" && proximoElementoNaoVazio) {
                                    tabelaHTML += '<div class="vaga-container ' + status + '">';
                                    tabelaHTML += '<div class="imgsCarros"><img src="../img/car-upsidedown.png" alt=""></div>';
                                } else if (status == "ocupada") {
                                    tabelaHTML += '<div class="vaga-container ' + status + '">';
                                    tabelaHTML += '<div class="imgsCarros"><img src="../img/car.png" alt=""></div>';
                                } else if (status == "livre") {
                                    tabelaHTML += '<div class="vaga-container ' + status + '">';
                                    tabelaHTML += '<div class="d-flex align-items-center justify-content-center" style="padding-top:10px;">' + icone + '</div>';
                                }
                            } else {
                                tabelaHTML += '<div class="vazio col"></div>';
                            }

                            tabelaHTML += '</div>';
                            tabelaHTML += '</td>';
                        }

                        tabelaHTML += '</tr>';
                    }

                    tabelaHTML += '</table>';
                    // Insere a tabela no elemento desejado
                    document.getElementById('tabela-vagas').innerHTML = tabelaHTML;
                    $('#meuModal').modal('show');

                    //Para alterar o tempo entre cada requisição,altere o valor presente nesta função|1000=1segundo
                    var intervaloAtualizacao = setInterval(function() {
                        fazerRequisicao(estacionamento);
                    }, 5000);

                    $('#meuModal').on('hidden.bs.modal', function() {
                        clearInterval(intervaloAtualizacao);
                    });

                }

            }
        </script>


    </head>

    <body class="pt-4">
        @if(session()->has('user_id'))
        @include('navbarLogged')
        @else
        @include('navbar')
        @endif
        <!--The div element for the map -->
        <div id="map"></div>
        <!-- Adicione o modal ao seu HTML -->
        <div class="modal" id="meuModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content quadro">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-titulo"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modal-vagas"></p>
                        <p id="modal-vagas_disponiveis"></p>
                        <p id="modal-endereco"></p>
                        <div id="tabela-vagas"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtI-_4umSKFC-kkL4yNoUTRfBI-Qo0NDM&callback=initMap&v=weekly" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

    </html>