@include('fragments/head', ['title' => 'Как сохранить букет'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="care indent indent--breadcrumbs">
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
                <span class="breadcrumbs__link active">Уход за цветами</span>
            </li>
        </ul>
        <h1 class="care__title title">Уход за цветами</h1>
        <p class="care__subtext">Наши рекомендации по уходу за цветами в домашних условиях</p>
        <ul class="care__list">
            <li class="care__item">
                <button class="care__btn care__btn--active" type="button" data-tab-index="0">Букет</button>
            </li>
            <li class="care__item">
                <button class="care__btn" type="button" data-tab-index="1">В коробке и корзине</button>
            </li>
            <li class="care__item">
                <button class="care__btn" type="button" data-tab-index="2">Сухоцветы</button>
            </li>
        </ul>
        <div class="care__tab" data-tab-index="0">
            <span class="care__tab-name">Букет</span>
            <ul class="care__tab-list">
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/bouquet/1.svg')}}" alt="Уход за букетом">
                    <p>
                        Налейте в чистую вазу <br> прохладную воду
                    </p>
                </li>
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/bouquet/2.svg')}}" alt="Уход за букетом">
                    <p>
                        Цветы подрежьте под углом 45% <br> и сразу поставьте в вазу
                    </p>
                </li>
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/bouquet/3.svg')}}" alt="Уход за букетом">
                    <p>
                        Меняйте воду ежедневно. <br> Подрезайте раз в два дня
                    </p>
                </li>
            </ul>
            <ol class="care__transfer">
                <li>
                    Букеты, упакованные в гелевый состав, рекомендуется оставлять в нём не более 4 часов.
                </li>
                <li>
                    Перед установкой в вазу их нужно очистить от геля и подрезать
                </li>
            </ol>
        </div>
        <div class="care__tab" data-tab-index="1">
            <span class="care__tab-name">В коробке и корзине</span>
            <ul class="care__tab-list">
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/box/1.svg')}}" alt="Уход за букетом">
                    <p>
                        Композиции на оазисе (флор. губке) являются неразборными
                    </p>
                </li>
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/box/2.svg')}}" alt="Уход за букетом">
                    <p>
                        Ежедневно подливайте прохладную воду на флористическую губку
                    </p>
                </li>
            </ul>
        </div>
        <div class="care__tab" data-tab-index="2">
            <span class="care__tab-name">Сухоцветы</span>
            <ul class="care__tab-list">
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/dried_flowers/1.svg')}}" alt="Уход за сухоцветами">
                    <p>
                        Не ставьте композицию в воду: цветы являются стабилизированными и не требуют воды
                    </p>
                </li>
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/dried_flowers/2.svg')}}" alt="Уход за букетом">
                    <p>
                        Не увлажняйте воздух рядом с букетом: сухоцветы не любят лишнюю влагу
                    </p>
                </li>
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/dried_flowers/3.svg')}}" alt="Уход за букетом">
                    <p>
                        Не ставьте композицию на открытое солнце: некоторые растения могут выгорать
                    </p>
                </li>
                <li class="care__tab-item">
                    <img src="{{asset('static/images/icons/care/dried_flowers/4.svg')}}" alt="Уход за букетом">
                    <p>
                        Чтобы убрать пыль, используйте широкую мягкую кисть
                    </p>
                </li>
            </ul>
            <ol class="care__transfer">
                <li>
                    Сухоцветные композиции сохраняются очень долго: от 5 до 10 лет.
                </li>
                <li>
                    Наслаждайтесь красотой, вдыхайте аромат трав!
                </li>
            </ol>
        </div>
        <div class="care__important">
            <h2 class="care__important-title">Это тоже важно</h2>
            <ul class="care__conditions">
                <li class="care__conditions-item care__important-item--winter">
                    <img src="{{asset('static/images/icons/care/winter.svg')}}" alt="уход за цветами">
                    <p>
                        Зимой букету с улицы нужно дать согреться 10 минут в упаковке или 5 минут без неё (не больше). И
                        только потом ставьте в воду, иначе увянут.
                    </p>
                </li>
                <li class="care__conditions-item care__conditions-item--fruits">
                    <img src="{{asset('static/images/icons/care/fruits.svg')}}" alt="уход за цветами">
                    <p>
                        Не ставьте цветы рядом с фруктами. Они выделяют этилен, а цветы его не любят.
                    </p>
                </li>
                <li class="care__conditions-item care__conditions-item--harm">
                    <img src="{{asset('static/images/icons/care/conditions.svg')}}" alt="уход за цветами">
                    <p>
                        Цвет не любят жару, сквозняк или холод, а также прямого солнца. Поэтому не ставьте букет у
                        батареи, под кондиционером или на подоконнике.
                    </p>
                </li>
            </ul>
        </div>
    </div>
</section>
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
@vite(['resources/js/tabs.js'])
</body>