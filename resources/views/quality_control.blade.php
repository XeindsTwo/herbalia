@include('fragments/head', ['title' => 'Контроль качества'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="control indent indent--breadcrumbs">
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
                <span class="breadcrumbs__link active">Контроль качества</span>
            </li>
        </ul>
        <h1 class="control__title title">Контроль качества</h1>
        <img class="control__img" src="{{asset('static/images/control.svg')}}" width="260" height="85"
             alt="контроль качества">
        <div class="control__content">
            <p>
                Мы благодарим каждого клиента за высокую оценку нашей работы и оказываемых услуг. Мы также благодарны
                вам за замечания, рекомендации и предложения. Мы верим, что главной особенностью и ценностью культуры
                Herbalia является именно общий созидательный характер, где каждый участник команды и каждый клиент может
                оказать благоприятное влияние на развитие компании и её продуктов, и получить истинное удовлетворение от
                этого.
            </p>
            <p>
                Для нас важно: свежесть цветка, соответствие представленному дизайну на фотографии, своевременная
                доставка, оперативные и ценные консультации, эффективные решения в случае возникновения отклонений от
                стандартов. И мы стремимся делать это безукоризненно каждый день.
            </p>
            <p>
                В случае, если Вы обнаружили нарушение или у вас есть замечания, просим сообщить нам об этом максимально
                оперативно и вы можете быть уверены в оперативном персональном решении вашего вопроса. Напишите нам в
                онлайн-чат или любой мессенджер, предоставив информацию:
            </p>
            <ol>
                <li>Номер заказа</li>
                <li>Опишите ситуацию</li>
                <li>Приложите фотографии (если это касается внешнего вида цветов)</li>
                <li>Можете также указать ваши пожелания</li>
            </ol>
            <p>
                Благодарим за доверие и возможность сделать этот день особенным для Вас!
            </p>
            <p>Команда Herbalia!</p>
        </div>
    </div>
</section>
@include('fragments/contacts')
@include('fragments/footer')
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
</body>
