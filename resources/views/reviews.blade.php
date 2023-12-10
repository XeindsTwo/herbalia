@php use Carbon\Carbon; @endphp
@include('fragments/head', ['title' => 'Отзывы клиентов интернет магазина Herbalia'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="reviews static indent indent--breadcrumbs indent--footer">
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{route('index')}}">
                    <span>
                        Доставка цветов в Белореченск
                    </span>
                </a>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__link active">Отзывы</span>
            </li>
        </ul>
        <div class="reviews__top">
            <h1 class="static__title title">Отзывы</h1>
            <button class="reviews__rules" id="btnRules">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.5 24H13.5C12.673 24 12 23.327 12 22.5V17.5C12 16.673 12.673 16 13.5 16H14.5C15.327 16 16 16.673 16 17.5V22.5C16 23.327 15.327 24 14.5 24ZM13.5 17C13.225 17 13 17.224 13 17.5V22.5C13 22.776 13.225 23 13.5 23H14.5C14.775 23 15 22.776 15 22.5V17.5C15 17.224 14.775 17 14.5 17H13.5Z"
                          fill="#959C9B"/>
                    <path d="M21 24H20.24C17.537 24 15.955 23.326 15.252 22.924C15.012 22.787 14.929 22.482 15.065 22.242C15.203 22 15.509 21.919 15.748 22.056C16.245 22.34 17.677 23 20.24 23H21C21.703 23 22.339 22.481 22.447 21.819C22.449 21.804 22.452 21.789 22.456 21.775C22.518 21.475 22.986 18.688 23 18.401C23 17.633 22.367 17 21.59 17H18.84C18.655 17 18.486 16.898 18.399 16.735C18.312 16.572 18.322 16.375 18.425 16.221C18.427 16.218 18.81 15.616 18.81 14.629C18.81 13.631 18.41 13.269 18.14 13.269C18.047 13.281 17.941 13.424 17.941 14.169C17.941 15.72 16.398 16.85 15.735 17.263C15.504 17.408 15.193 17.338 15.047 17.103C14.901 16.869 14.972 16.56 15.206 16.414C15.613 16.16 16.941 15.248 16.941 14.168C16.941 13.551 16.941 12.268 18.14 12.268C18.945 12.268 19.81 13.006 19.81 14.628C19.81 15.181 19.715 15.645 19.603 15.998H21.59C22.919 15.998 24 17.079 24 18.408C24 18.44 23.876 20.949 23.39 21.971L23.434 21.978C23.246 23.132 22.199 24 21 24ZM16.5 9.75C16.224 9.75 16 9.526 16 9.25V5H2.5C1.121 5 0 3.878 0 2.5C0 1.122 1.121 0 2.5 0H14.5C14.776 0 15 0.224 15 0.5V4H16.5C16.776 4 17 4.224 17 4.5V9.25C17 9.527 16.776 9.75 16.5 9.75ZM2.5 1C1.673 1 1 1.673 1 2.5C1 3.327 1.673 4 2.5 4H14V1H2.5Z"
                          fill="#959C9B"/>
                    <path d="M9.5 22H2.5C1.121 22 0 20.878 0 19.5V2.5C0 2.224 0.224 2 0.5 2C0.776 2 1 2.224 1 2.5V19.5C1 20.327 1.673 21 2.5 21H9.5C9.776 21 10 21.224 10 21.5C10 21.776 9.776 22 9.5 22Z"
                          fill="#959C9B"/>
                </svg>
                Правила публикации отзывов
            </button>
        </div>
        <div class="reviews__rating">
            <img class="reviews__img" src="{{asset('static/images/reviews-right.svg')}}"
                 alt="декор отзывы">
            <div class="reviews__rating-points">
                <p class="reviews__amount">{{$averageRating}}</p>
                <h6 class="reviews__label">Наш рейтинг</h6>
            </div>
            <img class="reviews__img reviews__img--right" src="{{asset('static/images/reviews-right.svg')}}"
                 alt="декор отзывы">
        </div>
        <div class="reviews__actions">
            @auth
                <a class="reviews__actions-link" href="{{route('reviews-form')}}">Написать отзыв</a>
                <a class="reviews__actions-link" href="">Предложить улучшения</a>
            @endauth
            @guest
                <p class="reviews__actions-text">
                    Вы не можете оставлять отзыв
                    <br>
                    Чтоб сделать это - <a href="{{route('login')}}">войдите</a> или <a href="{{route('register')}}">зарегистрируйтесь</a>
                </p>
            @endguest
        </div>
        <div class="reviews__inner @if(count($reviews) === 0)reviews__inner--empty @endif">
            @if(count($reviews) === 0)
                <p>Пока отзывов нет ¯\_(ツ)_/¯</p>
            @else
                <div class="reviews__left">
                <span class="reviews__quantity">
                    @if(count($reviews) === 0)
                        Пока нет отзывов
                    @elseif(count($reviews) === 1)
                        Всего 1 отзыв
                    @elseif((count($reviews) % 10 === 2 || count($reviews) % 10 === 3 || count($reviews) % 10 === 4) && (count($reviews) < 10 || count($reviews) > 20))
                        Всего {{ count($reviews) }} отзыва
                    @else
                        Всего {{ count($reviews) }} отзывов
                    @endif
                </span>
                </div>
                <div class="reviews__content">
                    <ul class="reviews__list">
                        @foreach($reviews as $review)
                            <li class="reviews__item">
                                <time class="reviews__date">
                                    {{Carbon::parse($review->created_at)->locale('ru')->isoFormat('D MMMM YYYY г.')}}
                                </time>
                                <span class="reviews__name">{{$review->name}}</span>
                                <p class="reviews__text">{{$review->comment}}</p>
                                <span class="reviews__rate">
                                    Оценка: {{ $review->rating }}
                                    @if ($review->rating == 5)
                                        😁
                                    @elseif ($review->rating == 4)
                                        😄
                                    @elseif ($review->rating == 3)
                                        😊
                                    @elseif ($review->rating == 2)
                                        😐
                                    @else
                                        😞
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
<div class="modal modal--reviews" id="modalRules">
    <button class="modal__close" id="modalCloseRules" type="button"></button>
    <h3 class="modal__title reviews__title">Правила публикации отзывов</h3>
    <div class="modal__content">
        <p>
            Мы всегда рады вашим отзывам и предложениям по улучшению.
            <br>
            Вместе мы делаем отличный, удобный и надёжный сервис для Всех!
        </p>
        <p>
            Ниже мы хотели бы отметить основные правила публикации отзывов:
            <br>
            1. Отзывы от наших клиентов (дарителей и получателей);
            <br>
            2. Объективные плюсы и минусы;
            <br>
            3. По выполненным заказам;
        </p>
        <p>
            Если у вас рекламация, то мы рассчитываем на объективность с обоих сторон.
        </p>
        <p>
            Помните, что лучше сразу написать нам или позвонить.
            <br>
            И мы оперативно решим любую возникшую проблему.
        </p>
    </div>
</div>
@include('fragments/footer')
@vite(['resources/js/reviews/main.js?type=module'])
@vite(['resources/js/app.js'])
</body>