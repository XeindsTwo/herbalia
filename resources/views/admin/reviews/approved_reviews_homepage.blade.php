@php use Carbon\Carbon; @endphp
@include('fragments/head', ['title' => 'Отображение отзывов на главной'])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin admin-reviews">
    <div class="container container--admin">
        <div class="admin__wrapper">
            <h1 class="admin__title">Управление отображением отзывов</h1>
            <ul class="admin-reviews__buttons">
                <li>
                    <a class="admin-reviews__link {{ request()->routeIs('admin.reviews.index') ? 'admin-reviews__link--active' : '' }}"
                       href="{{route('admin.reviews.index')}}">
                        Не одобренные отзывы
                    </a>
                </li>
                <li>
                    <a class="admin-reviews__link {{ request()->routeIs('admin.reviews.approved') ? 'admin-reviews__link--active' : '' }}"
                       href="{{route('admin.reviews.approved')}}">
                        Одобренные отзывы
                    </a>
                </li>
                <li>
                    <a class="admin-reviews__link {{ request()->routeIs('admin.reviews.home') ? 'admin-reviews__link--active' : '' }}"
                       href="{{route('admin.reviews.home')}}">
                        Отображение на главной
                    </a>
                </li>
            </ul>
            @if($approvedReviews->isEmpty())
                <p>Тут пока еще нет одобренных отзывов</p>
            @else
                <div class="admin-warning admin-warning--long">
                <span class="admin-warning__icon">
                    <img width="26" height="26" src="{{asset('static/images/icons/info.svg')}}" alt="предупреждение">
                </span>
                    <div>
                        <span class="admin-warning__title">Прочтите это</span>
                        Эта страница позволит через чекбоксы отобразить отзывы на главной странице (в секции).
                        Достаточно нажать рядом на квадратик чтоб он закрасился и сохранить изменения.
                        После этого изменения вступят в силу, и отзывы будут отображаться
                        <br>
                        <br>
                        Максимальное количество отображаемых отзывов - 12!
                    </div>
                </div>
                <div class="admin-reviews__content">
                    <ul class="admin-reviews__list admin-reviews__list--sticky">
                        @foreach($approvedReviews  as $review)
                            <li class="admin-reviews__item reviews__item" data-review-id="{{$review->id}}">
                                <label class="auth__checkbox custom-checkbox">
                                    <input class="custom-checkbox__input review-checkbox" type="checkbox" name="" value=""
                                           data-review-id="{{$review->id}}" @if($review->display_on_homepage) checked @endif>
                                    <span class="checkmark"></span>
                                    Отобразить на главной
                                </label>
                                <div class="admin-reviews__control">
                                    <button class="admin-reviews__btn delete-btn"
                                            data-review-id="{{$review->id}}" data-review-name="{{$review->name}}">
                                        Удалить
                                    </button>
                                </div>
                                <time class="reviews__date">
                                    {{ Carbon::parse($review->created_at)->locale('ru')->isoFormat('D MMMM YYYY г.') }}
                                </time>
                                <span class="reviews__name">{{$review->name}}</span>
                                <p class="reviews__text">{{$review->comment}}</p>
                                <span class="reviews__rate">
                            Оценка: {{ $review->rating }}
                                    @if ($review->rating == 5)
                                        😁
                                    @elseif ($review->rating == 4)
                                        😄
                                    @elseif ($review->rating == 3)
                                        😊
                                    @elseif ($review->rating == 2)
                                        😐
                                    @else
                                        😞
                                    @endif
                        </span>
                            </li>
                        @endforeach
                    </ul>
                    <button class="admin-reviews__save modal__btn">Сохранить изменения</button>
                </div>
            @endif
        </div>
    </div>
</section>
<div class="modal" id="modalDeleteReview">
    <button class="modal__close" id="modalCloseDeleteReview" type="button"></button>
    <h3 class="modal__title">Удаление отзыва</h3>
    <p class="modal__text">
        Вы действительно хотите удалить отзыв от <span id="reviewUserName"></span>? Удаление отменить будет невозможно
    </p>
    <div class="modal__buttons">
        <button class="modal__btn modal__btn--cancel" id="cancelDeleteReview" type="button">Отменить</button>
        <button class="modal__btn modal__btn--confirm" id="confirmDeleteReview" type="submit">Да, удалить</button>
    </div>
</div>
@vite(['resources/js/reviews/manage.js?type=module'])
@vite(['resources/js/reviews/display-reviews-home.js'])
</body>