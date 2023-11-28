@include('fragments/head', ['title' => 'Страница авторизации'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="auth indent">
    <div class="container">
        <div class="auth__content auth__content--small">
            <h2 class="auth__title title">Авторизация</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <span class="error" id="authError">Неверно введена почта или пароль</span>
                <ul class="auth__list auth__list--grid">
                    <li class="auth__item">
                        <label class="label" for="email">Email</label>
                        <input class="input" id="email" type="text" name="email" placeholder="Введите email"
                               value="{{ old('login') }}" required>
                    </li>
                    <li class="auth__item">
                        <label class="label" for="password">Пароль</label>
                        <input class="input" id="password" type="password" placeholder="Введите пароль" name="password"
                               required>
                    </li>
                </ul>
                <button class="auth__btn" type="submit">Войти</button>
            </form>
        </div>
    </div>
</section>
@vite(['resources/js/app.js'])
</body>