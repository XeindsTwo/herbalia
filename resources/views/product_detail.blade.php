@include('fragments/head', ['title' => isset($product) ? 'Букет "' . $product->name . '"' : 'Доставка цветов Herbalia'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="product-detail indent">
    <div class="container">
        <div class="product-detail__inner">
            <ul class="product-detail__images">
                @foreach($product->images as $image)
                    <li>
                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}">
                    </li>
                @endforeach
            </ul>
            <div class="product-detail__content">
                <h1 class="product-detail__title">{{ isset($product) ? 'Букет "' . $product->name . '"' : '' }}</h1>
                <span class="product-detail__article">Артикул: {{ $product->article }}</span>
                <span class="product-detail__price">{{ number_format($product->price, 0, '.', ' ') . ' ₽' }}</span>
                <button class="product-detail__order">Оформить заказ</button>
            </div>
        </div>
    </div>
</section>
</body>