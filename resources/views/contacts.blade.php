@include('fragments/head', ['title' => 'Контактная информация'])
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
                <span class="breadcrumbs__link active">Контакты</span>
            </li>
        </ul>
        <h1 class="static__title title">Контакты</h1>
        <div class="static__text">
            <p>
                <b>Поддержка:</b> по телефону с 10-00 до 22-00 - ежедневно. По email и пабликам в социальных сетях
                - круглосуточно.
            </p>
            <p>
                Бесплатная линия для абонентов России: <a href="tel:+79506257650">8 (950) 625 76-50</a>
            </p>
            <p>
                Вопросы по заказам: <a href="mailto:hello@herbalia.ru">hello@herbalia.ru</a>
            </p>
            <p>
                <b>Реквизиты:</b>
            </p>
            <ul class="static__empty">
                <li>
                    Общество с ограниченной ответственностью «Хербалиа»
                </li>
                <li>
                    Почтовый адрес: 197110 Россия, Белореченск, ул. Ленина, д.68, офис 12
                </li>
                <li>
                    Юридический адрес: 197110 Россия, Белореченск, ул. Ленина, д.68, офис 12
                </li>
                <li>
                    ИНН 7810424635, КПП 781301001, ОГРН 1167847068663
                </li>
                <li>
                    Расчётный счёт 40702 810 8100 0000 2537 в АО "Тинькофф Банк", БИК 044525974, Корр счёт 30101 810 1452 5000 0974
                </li>
            </ul>
        </div>
    </div>
</section>
@include('fragments/modals_header')
@include('fragments/footer')
@vite(['resources/js/app.js'])
</body>