<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APP_BASE</title>

    <link rel="stylesheet" href="/css/app.css" >
    <link rel="stylesheet" href="/css/base.css" >
    <link rel="stylesheet" href="/css/index.css" >
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="div_logo">
        <img src={{asset('/images/austra.jpg')}} alt="" class="background_login">  
    </div>
    <div class="box-login">

        <div class="messages mt_4">
            @if (session('message'))
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
            @endif

            @if(session('message-error'))
                <div class="alert alert-danger text-center">
                    {{ session('message-error') }}
                </div>
            @endif
        </div>
    
        <form class = "form-signin login-container" method = "POST" action = "{{ url('login') }}">
            {{ csrf_field() }}

            <h1 class = "form-signin-heading text-center mb_2" >ACESSO</h1>
            <br>
                <label for = "cpf" class = "sr-only">CPF</label>
                <input type = "text" id = "cpf" name = "cpf" class = "form-control" placeholder = "CPF" required autofocus/>
            <br/>
                <label for = "senha" class = "sr-only">Senha </label>
                <input type = "password" id = "senha" name = "senha" class = "form-control" placeholder = "Senha" required />
            <br/>
                <label for="tipo" class="sr-only">Tipo do usuário</label>
                <select name="tipo" class="form-control hidden">
                    <option value="Usuario">Usuario</option>
                </select>
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar" />
            
        </form>
    </div>
</body>
</html>

