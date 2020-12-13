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
                    <div class="custom-file">
                        <input name="file" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastro</button>
                </form>    
            </div>
            <div class="container my-5">
                <h2>Cadastro de pedidos</h2>
                <form method="POST" action="{{url('/orders')}}" enctype='multipart/form-data'>
                    @csrf
                    <div class="custom-file">
                        <input name="file" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastro</button>
                </form>    
            </div>
        </div>
    </body>
</html>
