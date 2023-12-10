@include('fragments/head', ['title' => 'Редактирование пользователя'])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin">
    <div class="container container--admin">
        <div class="admin__wrapper">
            <h1 class="admin__title">Редактирование пользователя</h1>
            <form id="updateForm" action="{{ route('admin.users.update', ['user' => $user]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="admin-edit__list">
                    <div class="admin-edit__item">
                        <label for="login">Логин</label>
                        <span class="error" id="loginCheckError">Логин уже используется</span>
                        <span class="error" id="loginError">Логин не должен иметь запрещенные символы</span>
                        <span class="error" id="loginLengthError">Минимальное количество символов - 5</span>
                        <span class="error" id="loginMaxError">Максимальное количество символов - 60</span>
                        <input class="input" type="text" id="login" name="login" value="{{$user->login}}" required>
                    </div>
                    <div class="admin-edit__item">
                        <label for="name">Имя</label>
                        <span class="error" id="nameError">Имя не должно содержать запрещенные символы</span>
                        <span class="error" id="nameMinError">Мин. количество символов - 2</span>
                        <span class="error" id="nameMaxError">Макс. количество символов - 50</span>
                        <input class="input" type="text" id="name" name="name" value="{{$user->name}}" required>
                    </div>
                    <div class="admin-edit__item">
                        <label for="email">Почта</label>
                        <span class="error" id="emailCheckError">Почта уже используется</span>
                        <span class="error" id="emailErrorParameters">Почта не соответствует параметрам</span>
                        <span class="error" id="emailLengthError">Макс. количество символов - 80</span>
                        <input class="input" type="email" id="email" name="email" value="{{$user->email}}" required>
                    </div>
                    <div class="admin-edit__item">
                        <label for="role">Роль</label>
                        <select class="select" id="role" name="role">
                            <option value="USER" {{ $user->role === 'USER' ? 'selected' : '' }}>Пользователь</option>
                            <option value="ADMIN" {{ $user->role === 'ADMIN' ? 'selected' : '' }}>Администратор</option>
                        </select>
                    </div>
                </div>
                <button class="modal__btn" type="submit" id="updateButton">Обновить</button>
            </form>
        </div>
    </div>
</section>
</body>
@vite(['resources/js/components/custom-select.js'])
@vite(['resources/js/user/edit.js?type=module'])
@vite(['resources/js/user.js?type=module'])
