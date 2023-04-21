<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <title>Home</title>
</head>
<body style="background-color: #eef3f2">
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
            <h1 class="col-12 p-3">Articles</h1>
        </div>
        <div class="row justify-content-center">
            <a href="{{route('article.create')}}" class="btn btn-primary w-auto">Create article</a>
        </div>

        <hr>
        @foreach ($articles as $article)
            <div class="row shadow-sm bg-white rounded p-3 mb-4 position-relative">

                <div class="  col h2 m-auto text-center">{{ $article->title}}</div>
                    
                <div class="col shadow-sm text-center bg-light"><img src="{{asset('Articles/images/'. $article->article_image)}}" width="300" height="100" alt="Main article picture"></div>

                <div class="col position-relative ">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <form action="{{route('article.destroy', $article->id)}}" method="POST">
                            <a href="{{route('article.edit', $article->id)}}" class="btn btn-primary m-2">Edit</a>
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger m-2" value="Delete">
                        </form>
                    </div>
                </div>
                <a href="{{route('article.show', $article->id)}}" class="position-absolute bottom-0 start-0 text-secondary my-2">View article details...</a>
            </div>
        @endforeach

    </div>
    <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>