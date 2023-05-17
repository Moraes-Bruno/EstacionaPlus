function initMap() {
    // Posição inicial do mapa
    const posicaoInicial = { lat: -22.434050, lng: -46.828170 };

    // Opções do mapa
    const opcoesMapa = {
      zoom: 15,
      center: posicaoInicial
    };

    // Criação do mapa
    const mapa = new google.maps.Map(document.getElementById('map'), opcoesMapa);

    // Marcadores de localização
    const localizacoes = [
      {
        posicao: { lat: -22.439251, lng: -46.810000 },
        titulo: 'Estacionamento 1',
        vagas: "Total de Vagas: "+30,
        vagas_disponiveis:"Vagas Disponiveis: "+10,
      },
      {
        posicao: { lat: -22.432932, lng: -46.834286 },
        titulo: 'Localização 2',
        descricao: 'Descrição do local 2'
      },
      {
        posicao: { lat: -22.438000, lng: -46.825000 },
        titulo: 'Localização 3',
        descricao: 'Descrição do local 3'
      }, {
        posicao: { lat: -22.435000, lng: -46.821000 },
        titulo: 'Localização 4',
        descricao: 'Descrição do local 4'
      }
      // Adicione mais localizações, se necessário
    ];

    // Adicionar marcadores e eventos de clique
    localizacoes.forEach(localizacao => {
      const marcador = new google.maps.Marker({
        position: localizacao.posicao,
        map: mapa,
        title: localizacao.titulo
    
      });

      marcador.addListener('click', () => {
        exibirModal(localizacao);
      });
    });

    // Função para exibir o modal com as informações do local
    function exibirModal(localizacao) {
      document.getElementById('modal-titulo').textContent = localizacao.titulo;
      document.getElementById('modal-vagas').textContent = localizacao.vagas;
      document.getElementById('modal-vagas_disponiveis').textContent = localizacao.vagas_disponiveis;
      $('#meuModal').modal('show');
    }
  }