<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.rtl.min.css')}}">


    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <title>انتخاب موضوع</title>
</head>
<body>
<!-- sectionOne -->
<section class="section-one mt-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 container  ">
        <div class="container-fluid">
            <div class="row w-100">
                <div class="signin-users">
                    <a class="nav-link login-users navbar-links mx-1 text-black " aria-current="page"
                       href="{{route('login')}}"> <img
                            src="{{asset('site/images/users.png')}}"
                            height="25px" class="mx-1" alt=""> ورود کاربران</a>
                </div>

                <div class="header-brand">
                    <span></span>
                </div>
            </div>

        </div>
    </nav>
</section>
<!-- end sectionOne -->
<!-- sectionTWO -->
<section class="mt-5">
    <div class="container bg-light p-5 category">
        <div class="accordion category-section" id="accordionPanelsStayOpenExample">
            @if($withoutPartTopics->count() == 0 and ($books->count() == 0 or \App\Topic::whereIn('book_id', $books->pluck('id')->toArray())->get()->count() == 0 ))
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-h0">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-c0" aria-expanded="true"
                                aria-controls="panelsStayOpen-c0">
                            {{ 'برای این فصل بخشی تعریف نشده است' }}
                        </button>
                    </h2>
                </div>
            @else
                @foreach($books as $book)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-h{{ $loop->iteration }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-c{{ $loop->iteration }}" aria-expanded="true"
                                    aria-controls="panelsStayOpen-c{{ $loop->iteration }}">
                                {{ $book->part }}
                            </button>
                        </h2>
                        @if($book->topics->count() > 0)
                            <div id="panelsStayOpen-c{{ $loop->iteration }}"
                                 class="accordion-collapse show"
                                 aria-labelledby="panelsStayOpen-h{{ $loop->iteration }}">
                                <ul class="subcategory">
                                    @foreach($book->topics as $topic)
                                        <li>
                                            <a href="{{ session()->has('operation') ? session()->get('operation') == 'test' ? route('exam',$topic->id) : route('overview.' . session()->get('operation'), $topic->id) :  route('overview.book', $topic->id) }}" class="text-decoration-none">{{ $topic->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endforeach
                @if($withoutPartTopics->count() > 0)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-h{{ $books->count() }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-c{{ $books->count() }}" aria-expanded="true"
                                    aria-controls="panelsStayOpen-c{{ $books->count() }}">
                            </button>
                        </h2>
                            <div id="panelsStayOpen-c{{ $books->count() }}"
                                 class="accordion-collapse show"
                                 aria-labelledby="panelsStayOpen-h{{ $books->count() }}">
                                <ul class="subcategory">
                                    @foreach($withoutPartTopics as $topic)
                                        <li>
                                            <a href="{{ session()->has('operation') ? session()->get('operation') == 'test' ? route('exam',$topic->id) : route('overview.' . session()->get('operation'), $topic->id) :  route('overview.book', $topic->id) }}" class="text-decoration-none>{{ $topic->title }}"></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                @endif
            @endif
        </div>
    </div>


</section>
<!-- end sectionTWO -->
<script src="{{asset('site/js/bootstrap.min.js')}}"></script>


</body>

</html>
