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
                        <ul class="admin-products__list">
                            @foreach($categoryProducts[$category->id] as $product)
                                <li class="admin-products__card">
                                    @foreach($product->images as $image)
                                        @if($loop->first)
                                            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                                <img class="admin-products__img"
                                                     src="{{asset('storage/' . $image->path)}}" height="360"
                                                     alt="{{$product->name}}">
                                            </a>
                                        @endif
                                    @endforeach
                                    <h3 class="admin-products__title">{{$product->name}}</h3>
                                    <p class="admin-products__article">Артикул - {{$product->article}}</p>
                                    <p class="admin-products__price">Цена:
                                        {{ number_format($product->price, 0, '.', ' ') }} ₽
                                    </p>
                                    <p>{{$product->description}}</p>
                                </li>
                            @endforeach
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