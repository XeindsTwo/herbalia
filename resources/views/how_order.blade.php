@include('fragments/head', ['title' => 'Как заказать цветы и подарки'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="static indent indent--breadcrumbs indent--footer">
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
                <span class="breadcrumbs__link active">Как заказать</span>
            </li>
        </ul>
        <h1 class="static__title title">Как заказать</h1>
        <div class="static__text">
            <p>
                Мы стараемся сделать всё, чтобы покупки на Herbalia были простыми и приятными.
            </p>
            <ol>
                <li>
                    Вы можете выбрать наиболее соответствующий букет или обратиться за помощью к нашим консультантам в
                    чат или на почту;
                </li>
                <li>
                    Добавьте букет в заказ, в корзине также есть возможность выбрать шоколад и другие дополнительные
                    подарки;
                </li>
                <li>
                    Укажите свои контактные данные при оформлении заказа - они нужны, чтобы информировать вас о статусе
                    заказа и отправить чек оплаты;
                </li>
                <li>
                    Если вы дарите кому-то, то укажите известные вам данные получателя. Если вы не знаете адреса и
                    удобного времени доставки, оставьте эти поля пустыми и мы сами уточним их у получателя в день
                    доставки;
                </li>
            </ol>
            <p>
                Так просто сделать кого-то счастливым! Букет уже в пути и будет точно в нужное время. Улыбнитесь ;)
            </p>
            <br>
            <p>
                <b>Для юридических лиц:</b>
            </p>
            <p>
                Если вы представляете компанию и хотели бы оплатить заказ с расчётного счёта организации, мы поможем вам
                оформить документы и сделать заказ с несколькими букетами. Обратитесь по любому из контактов или
                напишите на <a href="mailto:hello@herbalia.ru">hello@herbalia.ru</a>
            </p>
        </div>
    </div>
</section>
@include('fragments/footer')
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
</body>