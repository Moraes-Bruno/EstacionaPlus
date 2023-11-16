<?php

use App\Models\Usuário;
use App\Models\Estacionamento;

$user_id = session('user_id');
$user = Usuário::where('email', $user_id)->first();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meu Perfil</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="bg-light pt-4">
    @include('navbarLogged')

    <main class="container mt-5">

        <h1 class="text-center">Meu Perfil</h1>
        <form class="w-50 m-auto" action="{{ route('usuario.alterarUser') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="emailHelp" value="<?php echo $user->nome; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $user->email; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Senha</label>
                <input type="password" class="form-control mb-2 d-inline" name="senha" id="senha" value="<?php echo $user->senha; ?>">
                <i class="bi bi-eye-slash " style="margin-left: -30px; cursor: pointer;" id="mostrarSenha"></i>
            </div>
            <input type="submit" value="Alterar" class="btn btn-success w-100 mt-2">
        </form>
        <h2 class="text-center mt-4 mb-4">Favoritos</h2>

        <div class="accordion mt-2 w-50 m-auto mb-4" id="accordionExample">
            <?php $contador = 1; ?>
            @if ($user->favoritos != null)
            @foreach ($user->favoritos as $contador => $favorito)
            <div class="accordion-item mt-2">
                <h2 class="accordion-header" id="heading{{ $contador }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $contador }}" aria-expanded="true" aria-controls="collapse{{ $contador }}">
                        <h6>{{ $favorito }}</h6>
                    </button>
                </h2>
                <div id="collapse{{ $contador }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $contador }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php $dados = Estacionamento::where('nome', $favorito)->first(); ?>
                        <p id="nomeE_{{ $contador }}" class="d-none">{{ $dados->nome }}</p>
                        <p>Quantidade de vagas: {{ $dados->totalVagas }}</p>
                        <p>Endereço: {{ $dados->endereco }}</p>
                        <button class="btn btn-primary w-100" name="remover" data-nome="{{ $dados->nome }}">Remover</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p class="text-muted text-center">Não possui Favoritos</p>
            @endif
        </div>


    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/togglePassWd.js') }}"></script>

    <script>
        $(function() {
            $('button[name="remover"]').on('click', function() {
                var nome = $(this).data('nome');
                $.ajax({
                    url: "{{ route('usuario.removerFavorito') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        nome: nome
                    },
                    dataType: 'json',
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>

</body>

</html>