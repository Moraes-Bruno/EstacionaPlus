<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>EstacionaMais</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">




</head>

<body class="pt-5 bg-light">
  <div class="container mt-5">

    <h1 class="text-center">Login</h1>
    <form class="w-50 m-auto" action="{{ route('admin.adminLogin')}}" method="post">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email">
        @error('email')
        <span>{{$message}}</span>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Senha</label>
        <input type="password" class="form-control mb-2 d-inline" name="senha" id="senha">
        <i class="bi bi-eye-slash " style="margin-left: -30px; cursor: pointer;" id="mostrarSenha"></i>
        @error('senha')
        <span>{{$message}}</span>
        @enderror
      </div>
      <div class="d-flex flex-row justify-content-between">
        <a href="./" class="btn btn-secondary">Cancelar</a>
        <input type="submit" value="Login" class="btn btn-success ">
      </div>
    </form>
    @error('error')
    <span>{{$message}}</span>
    @enderror

  </div>




  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{ URL::asset('js/togglePassWd.js') }}"></script>
</body>

</html>