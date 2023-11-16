@include('fragments/head', ['title' => 'Гарантийные обязательства'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="static indent indent--breadcrumbs">
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
                <span class="breadcrumbs__link active">Гарантии</span>
            </li>
        </ul>
        <h1 class="static__title title">Гарантии</h1>
        <div class="static__text">
            <p>
                Мы гарантируем комфортное обслуживание каждый день.
            </p>
            <ul class="static__dots">
                <li>
                    Доставка ежедневно с 10:00 до 23:00, от 2-х часов с момента оплаты заказа
                </li>
                <li>
                    Соответствуем 152 ФЗ - Ваши персональные данные под защитой
                </li>
                <li>
                    Соответствуем 54 ФЗ - Печатаем чеки онлайн и отправляем на ваш email
                </li>
                <li>
                    Защита клиента. В случае несоответствия букета или согласованных условий - бесплатная доставка или
                    возврат денежных средств
                </li>
            </ul>
            <p class="static__indent">
                <b>Приятные бонусы:</b>
            </p>
            <ul class="static__dots">
                <li>
                    Бесплатная открытка к каждому заказу
                </li>
                <li>
                    Большой выбор стильных композиций для любого случая
                </li>
                <li>
                    Учитываем ваши индивидуальные пожелания
                </li>
                <li>
                    Начисляем бонусы с каждого доставленного заказа
                </li>
                <li>
                    Поддержка и консультации удобным для вас способом
                </li>
            </ul>
            <p>
                Наши клиенты - это наши друзья. Мы непрерывно пользуемся собственным сервисом в режиме "тайного
                покупателя", чтобы быть уверенными, что каждый клиент сможет доверить нам организацию доставки подарка
                как близкому человеку, так и деловому партнёру, получив гарантированное удовлетворение от всего
                процесса.
            </p>
        </div>
    </div>
</section>
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
</body>