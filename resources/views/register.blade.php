@include('fragments/head', ['title' => 'Страница авторизации'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="auth indent">
    <div class="container">
        <div class="auth__content">
            <h2 class="auth__title title">Регистрация</h2>
            <form method="POST" action="{{route('register')}}">
                @csrf
                <ul class="auth__list">
                    <li class="auth__item">
                        <label class="label" for="name">Имя</label>
                        <span class="error" id="nameMinError">Мин. количество символов - 2</span>
                        <span class="error" id="nameMaxError">Макс. количество символов - 255</span>
                        <span class="error" id="nameError">Имя не должно содержать запрещенные символы</span>
                        <input class="input" id="name" type="text" name="name" placeholder="Введите ваше имя"
                               value="{{ old('name') }}">
                    </li>
                    <li class="auth__item">
                        <label class="label" for="email">Email</label>
                        <span class="error" id="emailError">Почта уже используется</span>
                        <span class="error" id="emailErrorParameters">
                            Почта не соответствует параметрам
                        </span>
                        <input class="input" id="email" type="email" name="email" placeholder="Введите ваш email"
                               value="{{ old('email') }}">
                    </li>
                    <li class="auth__item">
                        <label class="label" for="password">Пароль</label>
                        <span class="error" id="passwordError">Пароль не может иметь кириллицу</span>
                        <span class="error" id="passwordMinError">Мин. количество символов - 8</span>
                        <input class="input" id="password" type="password" placeholder="Введите пароль" name="password">
                    </li>
                    <li class="auth__item">
                        <label class="label" for="password_confirmation">Подтверждение пароля</label>
                        <span class="error" id="passwordConfirmError">Пароли не совпадают</span>
                        <input class="input" id="password_confirmation" type="password" placeholder="Подтвердите пароль"
                               name="password_confirmation">
                    </li>
                </ul>
                <button class="auth__btn" type="submit">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@vite(['resources/js/app.js'])
@vite(['resources/js/register.js'])
</body>