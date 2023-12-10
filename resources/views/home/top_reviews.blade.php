<section class="top-reviews indent">
    <div class="container">
        <div class="top-reviews__inner">
            <img class="top-reviews__img" width="450" src="{{asset('static/images/reviews.svg')}}"
                 alt="herbalia отзывы">
            <div class="top-reviews__content">
                <h2 class="top-reviews__title block-title">Что говорят о нас клиенты?</h2>
                <div class="top-reviews__swiper swiper">
                    <div class="swiper-wrapper">
                        @foreach($approvedReviews as $review)
                            <div class="top-reviews__slide swiper-slide">
                                <p class="top-reviews__text">
                                    “{{$review->comment}}”
                                </p>
                                <span class="top-reviews__name">{{$review->name}}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="top-reviews__navigation">
                    <div class="top-reviews__control">
                        <button class="top-reviews__btn top-reviews__btn--prev" type="button"></button>
                        <span class="top-reviews__digital"></span>
                        <div class="top-reviews__pagination"></div>
                        <button class="top-reviews__btn top-reviews__btn--next" type="button"></button>
                    </div>
                    <a class="popular-questions__link" href="">
                        Показать больше
                        <span class="popular-questions__circle">
                        <img src="{{asset('static/images/icons/arrow-circle.svg')}}" alt="arrow" width="16" height="13">
                    </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>