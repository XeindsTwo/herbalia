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
                        <input class="input" type="text" id="login" name="login" value="{{$user->login}}" required>
                    </div>
                    <div class="admin-edit__item">
                        <label for="name">Имя</label>
                        <input class="input" type="text" id="name" name="name" value="{{$user->name}}" required>
                    </div>
                    <div class="admin-edit__item">
                        <label for="email">Email</label>
                        <input class="input" type="email" id="email" name="email" value="{{$user->email}}" required>
                    </div>
                    <div class="admin-edit__item">
                        <label for="role">Роль</label>
                        <select id="role" name="role">
                            <option value="ADMIN" {{ $user->role === 'ADMIN' ? 'selected' : '' }}>Администратор</option>
                            <option value="USER" {{ $user->role === 'USER' ? 'selected' : '' }}>Пользователь</option>
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
@vite(['resources/js/user.js?type=module'])