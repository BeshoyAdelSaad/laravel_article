<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav>
       
       @if (Route::has('login'))
       <div class="nav justify-content-end">
           <a href="/" class="btn btn-light m-2">Home</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-light m-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light m-2">Log in</a>
                    
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-light m-2">Register</a>
                @endif
                @endauth
        </div>
        @endif
    </nav>

      <div class="container">

        <div class="row text-center">
            <h1 class="col-12 p-3">Create Article</h1>
        </div>
        
        <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title" class="form-label">Article Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title...">
            </div>
            <div>
                <label for="description" class="form-label">Article Description</label>
                <input type="text" class="form-control" name="description" placeholder="Description...">
            </div>
                <div>
                <label for="description" class="form-label">Article photo</label>
                <input type="text" class="form-control" name="description" placeholder="Description...">
            </div>
        </form>


    

    <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>