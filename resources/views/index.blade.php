@include('fragments/head', ['title' => 'Доставка цветов | Купить букет цветов с доставкой в Белореченск'])
<body class="body">
<header class="header header--main">
    @include('fragments/header_top')
    <div class="header__content">
        <h1 class="header__title">
            Загляните в Herbalia <br>
            Таинственный мир цветов
        </h1>
        <a class="header__link" href="/catalog">Перейти в каталог</a>
    </div>
</header>
<section class="products indent">
    <div class="container">
        <div class="products__header">
            <h2 class="products__title title">Доставка цветов в любую точку</h2>
            <ul class="products__benefits" aria-label="Наши преимущества">
                <li class="products__benefits-item">Срочная доставка. Бесплатно</li>
                <li class="products__benefits-item">Гарантия свежести</li>
                <li class="products__benefits-item">Фото букета перед доставкой</li>
                <li class="products__benefits-item">Бесплатная открытка</li>
            </ul>
        </div>
        <ul class="products__items">
            @foreach($categories as $category)
                @if(!$categoryProducts[$category->id]->isEmpty())
                    <li class="products-row__header">
                        <h3 class="products-row__title">
                            {{ $category->name }}
                        </h3>
                        <span class="products-row__extra-wrapper">
                        <span class="products-row__subtitle">{{ $category->subtitle }}</span>
                    <span class="products-row__extra">
                        <span class="products__row-header__extra-item products__row-header__extra-item--type-price">
                            от {{number_format($categoryProducts[$category->id]->min('price'), 0, '.', ' ')}} ₽
                        </span>
                        <span class="products__row-header__extra-item products__row-header__extra-item--type-count">
                            {{$categoryProducts[$category->id]->count()}} шт
                        </span>
                    </span>
                    </span>
                        <ul class="products__list">
                            @foreach($categoryProducts as $category => $products)
                                @php
                                    $limitedProducts = $products->take(7);
                                @endphp
                                @foreach($limitedProducts as $product)
                                    <li class="products__card">
                                        @foreach($product->images as $image)
                                            @if($loop->first)
                                                <a class="products__link"
                                                   href="{{ route('product.show', ['id' => $product->id]) }}">
                                                    <img class="products__img"
                                                         src="{{asset('storage/' . $image->path)}}" height="360"
                                                         alt="{{$product->name}}">
                                                </a>
                                            @endif
                                        @endforeach
                                        <div class="products__head">
                                            <a class="products__name"
                                               href="{{ route('product.show', ['id' => $product->id]) }}">{{$product->name}}</a>
                                            <button class="products__like" type="button">
                                                <svg width="20" height="19" viewBox="0 0 29 25" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.19997 14.0455L13.2246 23.4589C13.5706 23.7832 13.7436 23.9461 13.9454 23.9865C14.0373 24.0045 14.1318 24.0045 14.2237 23.9865C14.4284 23.9461 14.6 23.7847 14.9446 23.4589L24.9692 14.0469C26.3308 12.7689 27.1665 11.029 27.3128 9.16758C27.4592 7.30617 26.9058 5.4571 25.7607 3.98203L25.3137 3.40693C22.4764 -0.248319 16.7814 0.364253 14.7874 4.54127C14.724 4.67364 14.6244 4.78538 14.5002 4.8636C14.3759 4.94182 14.2321 4.98332 14.0853 4.98332C13.9385 4.98332 13.7946 4.94182 13.6704 4.8636C13.5462 4.78538 13.4466 4.67364 13.3832 4.54127C11.3892 0.364253 5.69423 -0.249761 2.85683 3.40693L2.40989 3.98347C1.26564 5.45834 0.712665 7.30678 0.85904 9.16752C1.00542 11.0283 1.84062 12.7676 3.20142 14.0455H3.19997Z"
                                                          stroke="#161616" stroke-width="2"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <p class="products__delivery">
                                            Бесплатная доставка <span>с 10:00 до 23:00</span>
                                        </p>
                                        <span class="products__price">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                                        <button class="products__order" type="button">Заказать</button>
                                    </li>
                                @endforeach
                            @endforeach
                            <a class="products__more" href="{{ route('contacts')}}">
                                <div class="products__circle">
                                    <svg width="45" height="34" viewBox="0 0 18 15" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 7.5H17M17 7.5L11 1M17 7.5L11 14" stroke="#3d1522" stroke-width="1.2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                Показать больше
                            </a>
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</section>
@include('home/top_reviews')
@include('home/popular_questions')
@include('home/original')
@include('home/possibilities')
@include('home/delivery')
@include('home/guarantees')
@include('fragments/contacts')
@include('fragments/footer')
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
@vite(['resources/js/main.js'])
</body>