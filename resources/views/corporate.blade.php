@include('fragments/head', ['title' => 'Корпоративным клиентам'])
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
                <span class="breadcrumbs__link active">Корпоративным клиентам</span>
            </li>
        </ul>
        <h1 class="static__title title">Корпоративным клиентам</h1>
        <div class="static__text">
            <p>
                Мы готовы предложить лучший сервис флористических услуг для организаций, которые хотят оформить заказ
                цветов сотрудникам онлайн.
            </p>
            <p>
                <b>Наш сервис вам необходим, если вы желаете:</b>
            </p>
            <ul class="static__dots">
                <li>
                    Поздравить с цветами сотрудников компании;
                </li>
                <li>
                    Поздравить или выразить благодарность в виде цветов партнёрам;
                </li>
                <li>
                    Оформить цветами мероприятия или конференц-зал;
                </li>
                <li>
                    Оформить цветами фойе, ресепшен или столы в ресторанах.
                </li>
            </ul>
            <br>
            <p>Мы с удовольствием подойдём к вашим задачам индивидуально и предложим решение.</p>
            <p>Сервис Herbalia открыт для сотрудничества с Российскими организациями и нерезидентами.</p>
            <p>Мы принимаем оплату в валютах: RUB, USD, EUR.</p>
            <br>
            <h2 class="static__subtitle">Как это работает?</h2>
            <ol>
                <li>
                    Вы можете выбрать букет из нашего каталога и оформить заказ самостоятельно. Счёт на оплату будет
                    сформирован автоматически.
                </li>
                <li>
                    Если у вас индивидуальный заказ или вы хотите автоматизировать процесс выбора букета и доставки по
                    определённым дням, напишите нам на <a href="mailto:business@herbalia.ru">business@herbalia.ru</a> -
                    наши менеджеры учтут ваши пожелания.
                </li>
                <li>
                    Возможные формы оплаты: по счёту (авансовый платёж или платёж с отсрочкой), оплата с депозита,
                    наличными или банковской картой на сайте (возможно оплата картой онлайн до или после выполнения
                    заказа).
                </li>
            </ol>
        </div>
    </div>
</section>
@include('fragments/footer')
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
</body>