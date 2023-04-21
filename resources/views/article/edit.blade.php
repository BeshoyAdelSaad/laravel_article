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
            <h1 class="col-12">Create Article</h1>
        </div>
        
        <form action="{{route('article.update', $article->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Article Title</label>
                <input type="text" class="form-control" name="title" value="{{$article->title}}" placeholder="Title...">
                @error('title')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Article Description</label>
                <input type="text" class="form-control" name="description" value="{{$article->description}}" placeholder="Description...">
                @error('description')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="article_image" class="form-label">Article image</label>
                <input type="file" class="form-control" name="article_image" placeholder="Article photo...">
                @error('article_image')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" multiple class="form-control" name="images[]">
                @error('images')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <p>You can choose more than one photo!</p>
            </div>
            <div class="">
                <input type="submit" class="btn btn-primary my-3" value="Update">
            </div>
        </form>


    

    <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>