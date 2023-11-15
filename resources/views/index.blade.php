<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Bloomify - ваш лучший выбор для заказа и доставки свежих цветов. Уникальные букеты и подарки для любого случая">
    <title>Herbalia</title>
    <link rel="icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
    <link rel="shortcut icon" href="{{asset('static/images/icons/favicon.svg')}}"
          type="images/x-icon"> @vite(['resources/scss/style.scss']) </head>
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

@include('fragments/contacts')
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
</body>
