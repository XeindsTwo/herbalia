<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Bloomify - ваш лучший выбор для заказа и доставки свежих цветов. Уникальные букеты и подарки для любого случая">
    <title>Herbalia | Контроль качества</title>
    <link rel="icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
    <link rel="shortcut icon" href="{{asset('static/images/icons/favicon.svg')}}"
          type="images/x-icon"> @vite(['resources/scss/style.scss']) </head>
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="control indent">
    <div class="container">
        <h1 class="control__title title">Контроль качества</h1>
        <img class="control__img" src="{{asset('static/images/control.svg')}}" width="260" height="85"
             alt="контроль качества">
        <div class="control__content">
            <p>
                Мы благодарим каждого клиента за высокую оценку нашей работы и оказываемых услуг. Мы также благодарны
                вам за замечания, рекомендации и предложения. Мы верим, что главной особенностью и ценностью культуры
                UFLOR является именно общий созидательный характер, где каждый участник команды и каждый клиент может
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
@include('fragments/modals_header')
@vite(['resources/js/app.js'])
</body>
