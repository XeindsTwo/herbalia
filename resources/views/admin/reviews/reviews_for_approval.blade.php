@php use Carbon\Carbon; @endphp
@include('fragments/head', ['title' => 'Управление отзывами'])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin admin-reviews">
    <div class="container container--admin">
        <div class="admin__wrapper">
            <h1 class="admin__title">Управление не одобренными отзывами</h1>
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
            <ul class="admin-reviews__list">
                @foreach($reviewsForApproval as $review)
                    <li class="admin-reviews__item reviews__item" data-review-id="{{$review->id}}">
                        <div class="admin-reviews__control">
                            <button class="admin-reviews__btn approve-btn" data-review-id="{{$review->id}}">Одобрить
                            </button>
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
</body>