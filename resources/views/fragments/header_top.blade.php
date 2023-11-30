<div class="header__top">
    <div class="container">
        <div class="header__top-inner">
            <a class="logo" href="/">
                <img class="logo" width="133" height="31" src="{{asset('static/images/icons/logo.svg')}}"
                     alt="логотип">
            </a>
            <div class="header__city">
                <span class="header__city-title">Город доставки</span>
                <button class="header__city-btn" type="button">
                    Белореченск
                </button>
            </div>
            <div class="header__info">
                <span class="header__info-title">Ежедневно с 10:00 до 22:00</span>
                <a class="header__info-phone" href="tel:+795062576050">8 (950) 625-76-50</a>
                <a class="header__info-link" href="{{ route('contacts') }}">Еще контакты</a>
            </div>
            <a class="header__control" href="{{ route('control') }}">Контроль качества</a>
            <div class="header__actions">
                <div class="header__actions-top">
                    <button class="header__btn header__btn--help" id="helpBtn" type="button">Помощь</button>
                    @if(Auth::check())
                        <a class="header__auth" href="{{route('contacts')}}">Личный кабинет</a>
                    @else
                        <a class="header__auth" href="{{route('login')}}" id="auth_btn" type="button">Войти</a>
                    @endif
                    <nav class="header__nav" aria-label="Основная навигация">
                        <ul class="header__list">
                            <li class="header__item">
                                <a href="{{ route('about') }}"
                                   class="header__nav-link {{ request()->is('about*') ? 'header__nav-link--active' : '' }}">
                                    О компании
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('contacts') }}"
                                   class="header__nav-link {{ request()->is('contacts*') ? 'header__nav-link--active' : '' }}">
                                    Контакты
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('payment') }}"
                                   class="header__nav-link {{ request()->is('payment*') ? 'header__nav-link--active' : '' }}">
                                    Оплата
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('delivery') }}"
                                   class="header__nav-link {{ request()->is('delivery*') ? 'header__nav-link--active' : '' }}">
                                    Доставка
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('flower-care') }}"
                                   class="header__nav-link {{ request()->is('flower-care*') ? 'header__nav-link--active' : '' }}">
                                    Уход за цветами
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('guarantee') }}"
                                   class="header__nav-link {{ request()->is('guarantee*') ? 'header__nav-link--active' : '' }}">
                                    Гарантии
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('howOrder') }}"
                                   class="header__nav-link {{ request()->is('how_order*') ? 'header__nav-link--active' : '' }}">
                                    Как заказать
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('faq') }}"
                                   class="header__nav-link {{ request()->is('faq*') ? 'header__nav-link--active' : '' }}">
                                    Вопросы-ответы
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('corporate') }}"
                                   class="header__nav-link {{ request()->is('corporate*') ? 'header__nav-link--active' : '' }}">
                                    Корпоративным клиентам
                                </a>
                            </li>
                            <li class="header__item">
                                <a href="{{ route('agreement') }}"
                                   class="header__nav-link {{ request()->is('agreement*') ? 'header__nav-link--active' : '' }}">
                                    Пользовательское соглашение
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <ul class="header__actions-list">
                    <li>
                        <button class="header__actions-link" type="button" id="search_btn">
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.2 19.4C15.281 19.4 19.4 15.281 19.4 10.2C19.4 5.11898 15.281 1 10.2 1C5.11898 1 1 5.11898 1 10.2C1 15.281 5.11898 19.4 10.2 19.4Z"
                                      stroke="white" stroke-width="1.5"/>
                                <path d="M10.2016 5.59961C8.98157 5.59961 7.81154 6.08425 6.94887 6.94692C6.0862 7.80958 5.60156 8.97961 5.60156 10.1996M24.0016 23.9996L19.4016 19.3996"
                                      stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </button>
                    </li>
                    <li>
                        <button class="header__actions-link" type="button" id="favorite_btn">
                            <svg width="29" height="25" viewBox="0 0 29 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.19997 14.0455L13.2246 23.4589C13.5706 23.7832 13.7436 23.9461 13.9454 23.9865C14.0373 24.0045 14.1318 24.0045 14.2237 23.9865C14.4284 23.9461 14.6 23.7847 14.9446 23.4589L24.9692 14.0469C26.3308 12.7689 27.1665 11.029 27.3128 9.16758C27.4592 7.30617 26.9058 5.4571 25.7607 3.98203L25.3137 3.40693C22.4764 -0.248319 16.7814 0.364253 14.7874 4.54127C14.724 4.67364 14.6244 4.78538 14.5002 4.8636C14.3759 4.94182 14.2321 4.98332 14.0853 4.98332C13.9385 4.98332 13.7946 4.94182 13.6704 4.8636C13.5462 4.78538 13.4466 4.67364 13.3832 4.54127C11.3892 0.364253 5.69423 -0.249761 2.85683 3.40693L2.40989 3.98347C1.26564 5.45834 0.712665 7.30678 0.85904 9.16752C1.00542 11.0283 1.84062 12.7676 3.20142 14.0455H3.19997Z"
                                      stroke="white" stroke-width="1.4"/>
                            </svg>
                            <span class="header__actions-counter">1</span>
                        </button>
                    </li>
                    <li>
                        <button class="header__actions-link" type="button" id="basket_btn">
                            <svg width="23" height="25" viewBox="0 0 23 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.17578 7.38867V6.11093C6.17578 4.75543 6.72098 3.45544 7.69145 2.49696C8.66192 1.53847 9.97815 1 11.3506 1C12.723 1 14.0393 1.53847 15.0098 2.49696C15.9802 3.45544 16.5254 4.75543 16.5254 6.11093V7.38867M15.2317 15.0551V12.4996M7.46949 15.0551V12.4996"
                                      stroke="white" stroke-width="1.4" stroke-linecap="round"/>
                                <path d="M1 12.4996C1 10.0898 1 8.88618 1.75811 8.13742C2.51622 7.38867 3.73489 7.38867 6.17482 7.38867H16.5245C18.9644 7.38867 20.1831 7.38867 20.9412 8.13742C21.6993 8.88618 21.6993 10.0898 21.6993 12.4996V13.7773C21.6993 18.5957 21.6993 21.0055 20.1831 22.5017C18.6681 23.9992 16.2282 23.9992 11.3496 23.9992C6.47108 23.9992 4.03115 23.9992 2.51622 22.5017C1 21.0055 1 18.5957 1 13.7773V12.4996Z"
                                      stroke="white" stroke-width="1.4"/>
                            </svg>
                            <span class="header__actions-counter active">10</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>