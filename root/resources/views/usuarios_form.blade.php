@extends('admin')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid mb-2">
        <div class="float-right">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/usuarios">Usuários</a></li>
                <li class="breadcrumb-item active">Formulário</li>
            </ol>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<section class="content">
    @if(isset($dados))
    <form action="{{ route('usuario.alterar', $dados->_id) }}" method="post">
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
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{ $dados->email }}">
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="text" id="senha" name="senha" class="form-control" value="{{ $dados->senha }}">
                </div>
                <div class="form-group">
                    <p>Favoritos:</p>
                    @foreach ($estacionamentos as $estacionamento)
                    <input type="checkbox" name="favoritos[]" value="{{ $estacionamento->nome }}" @if($dados->favoritos!=NULL)@foreach ($dados->favoritos as $favorito) @if(str_contains($favorito, $estacionamento->nome)) checked @endif @endforeach @endif>
                    <label for="favoritos">{{ $estacionamento->nome }}</label>
                    @endforeach
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
    <form action="{{ route('usuario.inserir') }}" method="post">
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
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" class="form-control">
                </div>
                <div class="form-group">
                    <p>Favoritos:</p>
                    @foreach ($estacionamentos as $estacionamento)
                    <input type="checkbox" name="favoritos[]" value="{{ $estacionamento->nome }}">
                    <label for="favoritos">{{ $estacionamento->nome }}</label>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
            <!-- /.card -->
        </div>
        <div class="row">
            <div class="col-12">
                <a href="./" class="btn btn-secondary">Cancelar</a>
                <input type="submit" value="Cadastrar" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    @endif
</section>
@endsection
