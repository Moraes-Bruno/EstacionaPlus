<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< HEAD
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Estaciona+</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../css/aos/aos.css" rel="stylesheet">
  <link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
  <link href="../css/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../css/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../css/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../css/remixicon/remixicon.css" rel="stylesheet">
  <link href="../css/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../css/style.css" rel="stylesheet">

=======
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstacionaMais</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/estacionamento.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

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
                });
            });

            function exibirModal(estacionamento) {
                document.getElementById('modal-titulo').textContent = estacionamento.nome;
                document.getElementById('modal-vagas').textContent = 'Total de Vagas: ' + estacionamento.totalVagas;
                document.getElementById('modal-vagas_disponiveis').textContent = 'Vagas Disponíveis: ' + estacionamento.totalVagas;
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
                        var ElementoAnteriorVazio = espacoAcima == null || espacoAcima.Tipo == "Vazio"? "AnteriorVazio": "";

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

                $('#meuModal').modal('show');
            }
        }
    </script>


>>>>>>> f9b25285a7d81f780d31f5a639ce8cb02b312a5e
</head>

<body>

<<<<<<< HEAD
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">Estaciona<span>+</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="../img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Sobre</a></li>
        <!--  <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li> -->
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class=" botoes d-flex flex-row justify-content-between">
        <a href="cadUsuario" class="btn btn-outline-danger text-light">Cadastro</a>
        <a href="login" class="btn btn-outline-success text-light">Login</a>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
          <h1>Estaciona<span class="text-success">+</span></h1>
        </div>
      </div>

      <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
        <div class="col-xl-2 col-md-4 w-25">
          <div class="icon-box">
            <i class="bi bi-pin-map"></i>
            <h3><a href="home">Ver Estacionamentos</a></h3>
          </div>
        </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="../img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
            <h3>Sobre nós.</h3>
            <p class="fst-italic">
                <p>Olá! Somos um grupo de quatro estudantes apaixonados por tecnologia e inovação. Nosso time é composto por Ana Clara, Bruno de Moraes, Pedro Vinicius e Vinícius Henrique, e todos nós estudamos na Fatec Itapira - "Dr. Ogari de Castro Pacheco".</p>

                <p>Durante nosso percurso acadêmico, tivemos a oportunidade de trabalhar em diversos projetos desafiadores, mas o Projeto Integrador (PI) foi um marco em nossa jornada. Decidimos criar um site para o PI, que aborda um tema de grande relevância: um sistema de estacionamento inteligente.</P>

                <p>Nosso objetivo com esse projeto é desenvolver soluções para os desafios enfrentados nos estacionamentos, buscando melhorar a eficiência e a experiência dos usuários. O estacionamento inteligente utiliza tecnologias como sensore e algoritmos avançados para otimizar o processo de estacionamento, reduzir o tempo de busca por vagas e evitar congestionamentos.</P>

                <p>Estamos comprometidos em fornecer um conteúdo de qualidade, embasado em pesquisas e estudos atualizados. Também estamos abertos a receber feedback e sugestões, pois acreditamos que a colaboração é fundamental para o aprimoramento contínuo do nosso projeto.</P>

                <p>Agradecemos a todos que visitam nosso site e esperamos que encontrem informações úteis e inspiradoras. Junte-se a nós nessa jornada em busca de soluções inteligentes para os desafios do estacionamento!</P>

                <p>Atenciosamente,</P>

                <p>Ana Clara, Bruno de Moraes, Pedro Vinicius e Vinícius Henrique</P>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Time</h2>
          <p>Nosso Time</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="../img/team/team-1.jpg" class="img-fluid" alt="">
                <div class="social">
              
                <a href="https://github.com/AnaFMel"><i class="bi bi-github"></i></a>
                  <a href="https://instagram.com/anaaaaa_melo?igshid=MzNlNGNkZWQ4Mg=="><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/anaclara-f-melo"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Ana Clara</h4>
                <span>Full-Stack</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="../img/team/team-2.jpg" class="img-fluid" alt="">
                <div class="social">
                  
                <a href="https://github.com/Moraes-Bruno"><i class="bi bi-github"></i></a>
                  <a href="https://www.instagram.com/moraes___bruno/"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/bruno-moraes-9b2383231"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Bruno Silva</h4>
                <span>Back-end</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="../img/team/team-3.jpg" class="img-fluid" alt="">
                <div class="social">
                
                <a href="https://github.com/pedrocruzz"><i class="bi bi-github"></i></a>
                  <a href="https://instagram.com/_pedrocruz_?igshid=MzNlNGNkZWQ4Mg=="><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/pedrocruzz"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Pedro Vinicius</h4>
                <span>Full-Stack</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="../img/team/team-4.jpg" class="img-fluid" alt="">
                <div class="social">
              
                  <a href="https://github.com/viniciusmattoss"><i class="bi bi-github"></i></a>
                  <a href="https://www.instagram.com/vinicius_h_l_mattos/"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Vinícius Mattos</h4>
                <span>Front-end|UI & UX Designer</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Estaciona<span>+</span></h3>
              <div class="social-links mt-3">
                <a href="https://github.com/Moraes-Bruno/EstacionaPlus" class="github"><i class="bi bi-github"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Links uteis</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Sobre nós</a></li>
            </ul>
          </div>

        </div>
      </div>
=======
    @include('navbar');

    <!--The div element for the map -->
    <div id="map"></div>

    <!--
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises
      with https://www.npmjs.com/package/@googlemaps/js-api-loader.
      -->
    <!-- Adicione o modal ao seu HTML -->
    <div class="modal " id="meuModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content quadro">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-titulo"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modal-vagas"></p>
                    <p id="modal-vagas_disponiveis"></p>
                    <p id="modal-endereco"></p>
                    <div id="tabela-vagas"></div>
                    <div id="estacionamento">
                    </div>
                </div>
            </div>
        </div>
>>>>>>> f9b25285a7d81f780d31f5a639ce8cb02b312a5e
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Estaciona+</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../js/purecounter/purecounter_vanilla.js"></script>
  <script src="../js/aos/aos.js"></script>
  <script src="../js/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../js/glightbox/js/glightbox.min.js"></script>
  <script src="../js/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../js/swiper/swiper-bundle.min.js"></script>
  <script src="../js/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../js/main.js"></script>

<<<<<<< HEAD
=======
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtI-_4umSKFC-kkL4yNoUTRfBI-Qo0NDM&callback=initMap&v=weekly" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
>>>>>>> f9b25285a7d81f780d31f5a639ce8cb02b312a5e
</body>

</html>