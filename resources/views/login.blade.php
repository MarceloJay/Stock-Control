<!DOCTYPE html>
@extends('headers.header')

@section('content')
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>StockControl</title>
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
    <!-- Adicione o link para o arquivo CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      .page {
        /* background-color:rgb(31 41 55 / 0.5) */
      }
    </style>
  </head>
  <body class="page">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Entrar</h2>
              <!-- <form> -->
              <form class='form-horizontal form-label-left' action="/api/auth/login" method="POST">
                {{ csrf_field() }}  
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" class="form-control" id="username" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                    <a href="#">Esqueceu sua senha</a>
                    <a href="#">Registre-se</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="login">Login</button>
            </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Adicione o link para o arquivo JS do Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
@endsection

@section('scripts')
<script>
    // $(document).ready(function() {
    //     $('#login').click(function(e) {
    //         e.preventDefault();
            
    //         var username = $('#username').val();
    //         var password = $('#password').val();
            
    //         var csrfToken = $('meta[name="csrf-token"]').attr('content'); 
            
    //         $.ajax({
    //             type: 'POST',
    //             dataType: 'json',
    //             url: '/api/auth/login',
    //             data: {
    //                 '_token': csrfToken, 
    //                 'email': username,
    //                 'password': password
    //             },
    //             success: function(response) {
    //                 console.log(response);

    //             },
    //             error: function(jqXHR, textStatus, errorThrown) {
    //                 console.log('Webhook test failed:', errorThrown);
    //             }
    //         });
    //     });
    // });

</script>
@endsection