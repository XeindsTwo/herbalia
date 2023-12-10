@include('fragments/head', ['title' => 'Написать отзыв'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="reviews static indent indent--breadcrumbs indent--footer">
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
                <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{route('reviews')}}">
                    <span>
                        Отзывы
                    </span>
                </a>
            </li>
            <li class="breadcrumbs__item">
                <span class="breadcrumbs__link active">Написать отзыв</span>
            </li>
        </ul>
        <h1 class="static__title title">Написать отзыв</h1>
        <form class="reviews-form" action="" method="POST">
            @csrf
            <div class="reviews-form__items">
                <div class="reviews-form__item">
                    <label class="label" for="name">Имя:</label>
                    <span class="error" id="nameError">Имя не должно содержать запрещенные символы</span>
                    <span class="error" id="nameMinError">Мин. количество символов - 2</span>
                    <span class="error" id="nameMaxError">Макс. количество символов - 50</span>
                    <input class="input" type="text" id="name" value="{{old('name') ?? auth()->user()->name}}"
                           name="name">
                </div>
                <div class="reviews-form__item">
                    <label class="label" for="email">Почта:</label>
                    <span class="error" id="emailCheckError">Почта уже используется</span>
                    <span class="error" id="emailErrorParameters">Почта не соответствует параметрам</span>
                    <span class="error" id="emailLengthError">Макс. количество символов - 80</span>
                    <input class="input" type="email" id="email" value="{{old('email') ?? auth()->user()->email}}"
                           name="email">
                </div>
            </div>
            <div class="reviews-form__rating">
                <span>Вы остались довольны сервисом?</span>
                <label class="label" for="rating">Оценка:</label>
                <input type="radio" id="rating1" name="rating" value="1">
                <label class="reviews-form__emoji" for="rating1">😞</label>
                <input type="radio" id="rating2" name="rating" value="2">
                <label class="reviews-form__emoji" for="rating2">😐</label>
                <input type="radio" id="rating3" name="rating" value="3">
                <label class="reviews-form__emoji" for="rating3">😊</label>
                <input type="radio" id="rating4" name="rating" value="4">
                <label class="reviews-form__emoji" for="rating4">😄</label>
                <input type="radio" id="rating5" name="rating" value="5" checked>
                <label class="reviews-form__emoji" for="rating5">😁</label>
            </div>
            <div class="reviews-form__comment">
                <label class="label" for="comment">Ваш отзыв:</label>
                <textarea class="reviews-form__textarea input input--textarea" id="comment" name="comment"
                          required></textarea>
            </div>
            <div class="reviews-form__accept">
                <button class="reviews-form__btn" type="submit">Отправить</button>
                <p class="reviews-form__link">
                    Нажимая кнопку «Отправить», я соглашаюсь с
                    <a href="{{asset(route('agreement'))}}" target="_blank">Политикой публикации отзывов</a>
                </p>
            </div>
        </form>
    </div>
</section>
<div class="modal" id="modalComplete">
    <h3 class="modal__title reviews__title">Отзыв отправлен на проверку</h3>
    <div class="modal__content">
        <p>
            Ваш отзыв был успешно отправлен на проверку модераторам магазинам
        </p>
        <a class="modal__btn modal__btn--complete" href="{{route('reviews')}}">Принято</a>
    </div>
</div>
@include('fragments/footer')
@vite(['resources/js/reviews/add-review.js?type=module'])
@vite(['resources/js/app.js'])
</body>