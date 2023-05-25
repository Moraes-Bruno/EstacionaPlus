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
  
  vagas.forEach(function(vaga) {
    var dados = {
      titulo: vaga.nome,
      vagas: "Total de Vagas: " + vaga.vagas,
      vagas_disponiveis: "Vagas Disponiveis: " + vaga.vagas_disponiveis,
      posicao: {lat: vaga.lat, lng: vaga.lng}
  };

  localizacoes.push(dados);
  });

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

