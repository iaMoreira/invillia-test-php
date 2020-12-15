<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container my-5">
                <h2>Cadastro automático de pessoas</h2>
                <form method="POST" action="{{url('/people')}}" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Coloque aqui um email para saber quando o upload estiver terminado">
                    </div>
                    
                    <div class="form-group my-2">
                        <input name="file" type="file" class="form-control" id="customFile">
                    </div>
            
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Cadastro</button>
                    </div>
                </form>    
            </div>
            <div class="container my-5">
                <h2>Cadastro de pedidos</h2>
                <form method="POST" action="{{url('/orders')}}" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Coloque aqui um email para saber quando o upload estiver terminado" >
                    </div>
                    
                    <div class="form-group my-2">
                        <input name="file" type="file" class="form-control" id="customFile">
                    </div>
            
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Cadastro</button>
                    </div>
                </form>    
            </div>
        </div>
    </body>
</html>
