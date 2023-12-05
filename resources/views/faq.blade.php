@include('fragments/head', ['title' => 'Вопрос-ответ'])
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
                <span class="breadcrumbs__link active">Вопрос-ответ</span>
            </li>
        </ul>
        <h1 class="static__title title">Вопрос-ответ</h1>
        <div class="static__text">
            <ul class="static__faq">
                <li>
                    <h2 class="static__subtitle">Как оформить заказ на доставку цветов?</h2>
                    <p>
                        Для оформления заказа выберите букет и нажмите на кнопку "Заказать" или "Оформить заказ".
                        Заполните информацию об отправителе и получателе, если получатель другое лицо, и выберите
                        желаемый
                        способ оплаты.
                    </p>
                </li>
                <li>
                    <h2 class="static__subtitle">Как оплатить заказ?</h2>
                    <p>
                        Оплатить заказ можно с помощью Банковской карты, Apple Pay, Google Pay, Наличными курьеру. Для
                        юр. лиц предусмотрена оплата по безналичному расчету - для этого оставьте заявку на <a
                                href="mailto:hello@herbalia.ru">hello@herbalia.ru</a>
                    </p>
                </li>
                <li>
                    <h2 class="static__subtitle">Сколько стоит доставка</h2>
                    <p>
                        Доставка бесплатная в пределах черты города, Белореченск - это до Белореченского района, в
                        каждом городе свои зоны доставки. Автоматический расчёт стоимости доставки временно недоступен.
                        Стоимость может быть рассчитана по запросу или после оформления вами заказа.
                    </p>
                </li>
                <li>
                    <h2 class="static__subtitle">Как быстро вы доставите букет?</h2>
                    <p>
                        У каждого букета указано минимальное время доставки. Минимальный интервал доставки 2 часа.
                        Доставка точно к часу не возможна, но вы всегда можете уточнить желаемый диапазон времени
                        доставки, мы постараемся всё сделать для вашего комфорта.
                    </p>
                </li>
                <li>
                    <h2 class="static__subtitle">Как мне узнать, что букет доставлен?</h2>
                    <p>
                        Когда букет будет доставлен, мы пришлем вам SMS сообщение на номер телефона, указанный при
                        оформлении заказа, и письмо на Email.
                    </p>
                </li>
                <li>
                    <h2 class="static__subtitle">Доставите ли вы букет, если я не знаю адрес?</h2>
                    <p>
                        Да, если вы укажите номер телефона получателя в заказе. Курьер сам согласует с ним наиболее
                        удобное время и адрес доставки.
                    </p>
                </li>
                <li>
                    <h2 class="static__subtitle">Есть ли доставка в другой город?</h2>
                    <p>
                        Актуальный список городов доставки представлен в блоке при выборе города. Мы активно развиваемся
                        и открываем представительства в новых городах. Следите за нашими обновлениями.
                    </p>
                </li>
                <li>
                    <h2 class="static__subtitle">Возможна ли анонимная доставка?</h2>
                    <p>
                        Пока в разработке, брат
                    </p>
                </li>
            </ul>
        </div>
    </div>
</section>
@include('fragments/footer')
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
</body>