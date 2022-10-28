<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">


  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>انتخاب فصل</title>
</head>
<body>
   <!-- sectionOne -->
   <section class="section-one mt-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 container  ">
      <div class="container-fluid">
        <div class="row w-100">
          <div class="signin-users">
            <a class="nav-link login-users navbar-links mx-1 text-black " aria-current="page" href="#"> <img src="./images/users.png"
                height="25px" class="mx-1" alt=""> ورود کاربران</a>
          </div>

          <div class="header-brand">
            <span>K@r@n B@La</span>
          </div>
        </div>

      </div>
    </nav>
  </section>
  <!-- end sectionOne -->
  <!-- sectionTWO -->
  <section>
    <div class="container section-two mt-3 mb-5">
      <div class="row ">
        <div class="col-xl-12 p-3">
          <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <!-- Slider item 1 -->
              @foreach($books->chunk(3) as $book)
              <div class="carousel-item @if($loop->first) active @endif" data-bs-interval="10000">
                <div class="row col-12 justify-content-center">
                  @foreach($book as $item)
                    <a href="@if(in_array(session()->get('operation'), ['generalTest', 'bookExercises'])){{ route('overview.' . session()->get('operation'), $item->id) }}@elseif(session()->get('operation') == 'appendices'){{ route('appendices.chooseAppendicesItem', $item->id) }}@else{{ route('book', $item->id) }}@endif" class="col-3  m-1 rounded p-4 slider-item">
                        <img src="{{ asset($item->image) }}" class="d-block w-100" alt="...">
                    </a>
                  @endforeach
                </div>
              </div>
              @endforeach
            </div>
            <button class="carousel-control-prev prev-btn" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next next-btn" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-next-icon text-dark" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- end sectionTWO -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
