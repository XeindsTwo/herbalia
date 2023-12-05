@include('fragments/head', ['title' => isset($product) ? 'Букет "' . $product->name . '"' : 'Доставка цветов Herbalia'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="product-detail">
    <div class="container">
        <ul class="product-detail__breadcrumbs breadcrumbs">
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{route('index')}}">
                    <span>Доставка цветов в Белореченск</span>
                </a>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__link">{{$currentCategory->name}}</span>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__link active">{{$product->name}}</span>
            </li>
        </ul>
        <div class="product-detail__inner">
            <div class="product-detail__gallery">
                <div class="product-detail__images swiper">
                    <ul class="swiper-wrapper">
                        @foreach($product->images as $image)
                            <li class="product-detail__slide swiper-slide">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}">
                            </li>
                        @endforeach
                    </ul>
                    <div class="product-detail__navigation">
                        <button class="product-detail__navigation-btn product-detail__navigation-btn--prev">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.231884 0.225098C-0.0772947 0.528317 -0.0772947 1.02105 0.231884 1.32427L10.1063 10.9894L0.231884 20.6734C-0.0772947 20.9766 -0.0772947 21.4694 0.231884 21.7726C0.541063 22.0758 1.04348 22.0758 1.35266 21.7726L11.7681 11.5579C11.9227 11.4063 12 11.2168 12 11.0083C12 10.8188 11.9227 10.6103 11.7681 10.4587L1.35266 0.244051C1.04348 -0.0781193 0.541063 -0.0781205 0.231884 0.225098V0.225098Z"
                                      fill="#4B4B4B"/>
                            </svg>
                        </button>
                        <button class="product-detail__navigation-btn product-detail__navigation-btn--next">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.231884 0.225098C-0.0772947 0.528317 -0.0772947 1.02105 0.231884 1.32427L10.1063 10.9894L0.231884 20.6734C-0.0772947 20.9766 -0.0772947 21.4694 0.231884 21.7726C0.541063 22.0758 1.04348 22.0758 1.35266 21.7726L11.7681 11.5579C11.9227 11.4063 12 11.2168 12 11.0083C12 10.8188 11.9227 10.6103 11.7681 10.4587L1.35266 0.244051C1.04348 -0.0781193 0.541063 -0.0781205 0.231884 0.225098V0.225098Z"
                                      fill="#4B4B4B"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="product-detail__thumbs swiper-thumbs">
                    <div class="product-detail__thumbs-swiper swiper-wrapper">
                        @foreach($product->images as $image)
                            <div class="product-detail__thumb swiper-slide">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="product-detail__content">
                <h1 class="product-detail__title">{{ isset($product) ? 'Букет "' . $product->name . '"' : '' }}</h1>
                <div class="product-detail__undertitle">
                    <span class="product-detail__article">Артикул: {{ $product->article }}</span>
                    <a class="product-detail__collection" href="">Коллекция 152</a>
                </div>
                <div class="product-detail__top">
                    <span class="product-detail__in">Ближайшая доставка через 2 часа</span>
                    <div class="product-detail__time">с 10:00 до 23:00</div>
                </div>
                <div class="product-detail__business">
                    <div class="product-detail__price">
                        <span class="product-detail__value">{{ number_format($product->price, 0, '.', ' ') . ' ₽' }}</span>
                        <div class="product-detail__delivery">
                            Цена с доставкой
                            <span class="product-detail__tooltip">
                                <button class="product-detail__btn">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                         xmlns="http://www.w3.org/2000/svg"><path
                                                d="M8.66797 11.8667V8.66666M8.66797 5.46666H8.67597M16.668 8.66666C16.668 13.0849 13.0862 16.6667 8.66797 16.6667C4.24969 16.6667 0.667969 13.0849 0.667969 8.66666C0.667969 4.24838 4.24969 0.666656 8.66797 0.666656C13.0862 0.666656 16.668 4.24838 16.668 8.66666Z"
                                                stroke="#F67280" stroke-width="1.3" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </span>
                        </div>
                        <div class="product-detail__bonus">Вы получите 96 баллов</div>
                    </div>
                    <button class="product-detail__order">Оформить заказ</button>
                </div>
                <button class="product-detail__like" type="button" id="favorite_btn">
                    <svg width="29" height="25" viewBox="0 0 29 25" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.19997 14.0455L13.2246 23.4589C13.5706 23.7832 13.7436 23.9461 13.9454 23.9865C14.0373 24.0045 14.1318 24.0045 14.2237 23.9865C14.4284 23.9461 14.6 23.7847 14.9446 23.4589L24.9692 14.0469C26.3308 12.7689 27.1665 11.029 27.3128 9.16758C27.4592 7.30617 26.9058 5.4571 25.7607 3.98203L25.3137 3.40693C22.4764 -0.248319 16.7814 0.364253 14.7874 4.54127C14.724 4.67364 14.6244 4.78538 14.5002 4.8636C14.3759 4.94182 14.2321 4.98332 14.0853 4.98332C13.9385 4.98332 13.7946 4.94182 13.6704 4.8636C13.5462 4.78538 13.4466 4.67364 13.3832 4.54127C11.3892 0.364253 5.69423 -0.249761 2.85683 3.40693L2.40989 3.98347C1.26564 5.45834 0.712665 7.30678 0.85904 9.16752C1.00542 11.0283 1.84062 12.7676 3.20142 14.0455H3.19997Z"
                              stroke="#161616" stroke-width="1.4"/>
                    </svg>
                    В любимчики
                </button>
            </div>
        </div>
    </div>
</section>
@include('fragments/contacts')
@include('fragments/footer')
@vite(['resources/js/app.js'])
@vite(['resources/js/product-detail.js'])
</body>