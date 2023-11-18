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
    </div>
</section>
@include('home/top_reviews')
@include('home/popular_questions')
@include('home/original')
@include('home/possibilities')
@include('home/delivery')
@include('home/guarantees')
@include('fragments/contacts')
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
@vite(['resources/js/main.js'])
</body>
