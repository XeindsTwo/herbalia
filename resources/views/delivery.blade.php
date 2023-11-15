<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Bloomify - ваш лучший выбор для заказа и доставки свежих цветов. Уникальные букеты и подарки для любого случая">
    <title>Herbalia | Доставка</title>
    <link rel="icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
    <link rel="shortcut icon" href="{{asset('static/images/icons/favicon.svg')}}"
          type="images/x-icon"> @vite(['resources/scss/style.scss']) </head>
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="static indent">
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
                <span class="breadcrumbs__link active">Доставка</span>
            </li>
        </ul>
        <h1 class="static__title title">Доставка</h1>
        <div class="static__text">
            <p>
                Доставка по городу Белореченск — осуществляется бесплатно.
            </p>
            <p>
                Цена доставки за пределы (отмечено на карте) устанавливается в зависимости от расстояния. Вы можете
                проверить свой адрес доставки и узнать примерную стоимость ниже, указав адрес доставки.
            </p>
            <p>
                Крайнее ближайшее время доставки указано в каждой композиции и зависит от сложности букета.
            </p>
            <p>
                Доставка осуществляется в 2 (двух) часовых интервалах с 10:00 до 23:00.
            </p>
            <p>
                Предзаказ на текущий день до 19:00 по местному времени города доставки.
            </p>
            <p>
                Ожидание получателя букета курьером до 15 минут. Повторная доставка осуществляется с доплатой за выезд
                курьера.
            </p>
            <p>
                Поскольку цветы являются скоропортящимся продуктом, через 24 часа с момента несостоявшейся доставки
                получателю, заказ оплачивается повторно или вывозится самостоятельно. При отказе от повторной доставки,
                оплата не возвращается, и взимается в полном объёме ввиду компенсации затрат по данному заказу.
            </p>
            <p>
                Мы можем:
            </p>
            <ul class="static__dots">
                <li>
                    Доставить букет без адреса и времени
                </li>
                <li>
                    Доставить в любое учреждение: гостиница, больница и др.
                </li>
                <li>
                    Приложить к цветам ваш подарок
                </li>
                <li>
                    Согласовать иные индивидуальные условия сюрприза
                </li>
            </ul>
        </div>
    </div>
</section>
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
</body>