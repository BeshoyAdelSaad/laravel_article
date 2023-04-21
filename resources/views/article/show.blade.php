<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/mycss.css')}}">
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
            <h1 class="col-12">Show Article</h1>
        </div>
        
      </div>

    <div class="container my-5 p-5 shadow border">
    <div class="row">
        <h2 class="col-12 text-center">{{ $article->title }}</h2>
           
        <div class="container">
            @foreach ($images as $image)
                <div class="mySlides">
                    {{-- <div class="numbertext">1 / 6</div> --}}
                    <img height="300" width="300" src="{{asset('Articles/images/' . $image->image)}}" alt="Article image" style="width:100%">
                </div>
            @endforeach
            
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

            <div class="row">
                @foreach ($images as $image)
                    <div class="column">
                    <img class="demo cursor" src="{{asset('Articles/images/' . $image->image)}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
                    </div>
                @endforeach
            </div>
        </div>
        <p class="">{{ $article->description }}</p>
    </div>
</div>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("demo");
    let captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>

    <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>