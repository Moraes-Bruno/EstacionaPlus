<!DOCTYPE html>
<!--
 @license
 Copyright 2019 Google LLC. All Rights Reserved.
 SPDX-License-Identifier: Apache-2.0
-->
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstacionaMais</title>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
                document.getElementById('lat').value = latitude;
                document.getElementById('lng').value = longitude;

                // Define as coordenadas do marcador
                marcador.setPosition(event.latLng);
            });
        }
    </script>
</head>

<body>
    <!--The div element for the map -->

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 h-100">
                    <div id="map" class="w-100" style="height: 400px;"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="../php/insere_estacionamento.php" method="POST" class="w-50 d-flex flex-column m-auto">


                    <h3>Localização</h3>

                    <label for="lat">Latitude</label>
                    <input type="text" name="lat" id="lat">

                    <label for="lng">Longitude</label>
                    <input type="text" name="lng" id="lng">



                    <h3>Dados Local</h3>
                    <label for="nome">Nome do Local</label>
                    <input type="text" name="nome" id="nome">
                    <label for="vagas">Quantidade de Vagas</label>
                    <input type="text" name="vagas" id="vagas">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco">
                    <input type="submit" value="Cadastrar" class="btn btn-primary mt-3">

                </form>
            </div>

        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtI-_4umSKFC-kkL4yNoUTRfBI-Qo0NDM&callback=initMap&v=weekly" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>