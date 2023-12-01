@include('fragments/head', ['title' => 'Управление категориями'])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin">
    <div class="container">
        <h1 class="admin__title">Управление категориями</h1>
        <button class="admin-category__btn" id="addBtnCategory" type="button">Добавить категорию</button>
        @if($categories->isEmpty())
            <p class="admin-category__info">Категорий еще нет, но вы можете создать их</p>
        @else
            <span class="admin-category__info">Ваши категории:</span>
            <ul class="admin-category__list">
                @foreach($categories as $category)
                    <li class="admin-category__item">
                        <div class="admin-category__content">
                            <h3 class="admin-category__name">{{ $category->name }}</h3>
                            @if($category->subtitle)
                                <p class="admin-category__text">{{ $category->subtitle }}</p>
                            @endif
                        </div>
                        <div class="admin-category__actions">
                            <button class="admin-category__action admin-category__delete"
                                    data-category-id="{{$category->id}}"></button>
                            <button class="admin-category__action admin-category__edit"
                                    data-category-id="{{$category->id}}"
                                    data-category-name="{{$category->name}}"
                                    data-category-subtitle="{{$category->subtitle}}">
                            </button>
                        </div>
                    </li>
                @endforeach
                @endif
            </ul>
    </div>
</section>
<div class="modal" id="modalAddCategory" data-modal="modalAddCategory">
    <button class="modal__close" id="modalCloseAddCategory" type="button"></button>
    <h3 class="modal__title" id="modalTitle">Создание категории</h3>
    <form action="{{ route('admin.categories.store') }}" id="categoryForm" method="POST">
        <span class="error" id="nameUniqueError">Имя должно быть уникальным</span>
        <span class="error" id="nameMaxError">Максимальное количество символов - 250</span>
        @csrf
        <ul class="modal__list">
            <li class="modal__item">
                <label class="label" for="name">Название категории</label>
                <input class="input" type="text" id="name" name="name" required>
            </li>
            <li class="modal__item">
                <label class="label" for="subtitle">Подзаголовок (необязательно)</label>
                <input class="input" type="text" id="subtitle" name="subtitle">
            </li>
        </ul>
        <button class="modal__btn" type="submit">Создать категорию</button>
    </form>
</div>
<div class="modal" id="modalEditCategory" data-modal="modalEditCategory">
    <button class="modal__close" id="modalCloseEditCategory" type="button"></button>
    <h3 class="modal__title" id="modalTitle">Редактирование категории</h3>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        <span class="error" id="nameUniqueError">Имя должно быть уникальным</span>
        <span class="error" id="nameMaxError">Максимальное количество символов - 250</span>
        @csrf
        <ul class="modal__list">
            <li class="modal__item">
                <label class="label" for="name">Название категории</label>
                <input class="input" type="text" id="name" name="name" required>
            </li>
            <li class="modal__item">
                <label class="label" for="subtitle">Подзаголовок (необязательно)</label>
                <input class="input" type="text" id="subtitle" name="subtitle">
            </li>
        </ul>
        <button class="modal__btn" type="button" id="editBtn">Сохранить изменения</button>
    </form>
</div>
<div class="modal" id="modalDeleteCategory" data-modal="modalDeleteCategory">
    <button class="modal__close" id="modalCloseDeleteCategory" type="button"></button>
    <h3 class="modal__title">Удаление категории</h3>
    <p class="modal__text">
        Вы действительно хотите удалить категорию <span></span>? Ее удаление приведет к удалению
        всех товаров, принадлежащих к этой категории
    </p>
    <div class="modal__buttons">
        <button class="modal__btn modal__btn--cancel" id="cancelDeleteCategory" type="button">Отменить</button>
        <button class="modal__btn modal__btn--confirm" id="confirmDeleteCategory" type="submit">Да, удалить</button>
    </div>
</div>
@vite(['resources/js/categories.js?type=module'])
</body>