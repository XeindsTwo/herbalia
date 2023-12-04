@include('fragments/head', ['title' => 'Управление категориями'])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin">
    <div class="container container--admin">
        <div class="admin__wrapper">
            <h1 class="admin__title">Управление категориями</h1>
            <button class="admin__btn" id="addBtnCategory" type="button">Добавить категорию</button>
            @if($categories->isEmpty())
                <p class="admin-category__info">Категорий еще нет, но вы можете создать их</p>
            @else
                <div class="admin-warning">
                <span class="admin-warning__icon">
                    <img width="26" height="26" src="{{asset('static/images/icons/info.svg')}}" alt="предупреждение">
                </span>
                    <div>
                        <span class="admin-warning__title">Прочтите это</span>
                        Если вы хотите изменить порядок элементов, то просто перетаскивайте их.
                        Изменения вступят в силу сразу после одного перетаскивания
                    </div>
                </div>
                <span class="admin-category__info">Ваши категории:</span>
                <ul class="admin-category__list" id="sortableList">
                    @foreach($categories as $category)
                        <li class="admin-category__item" data-category-id="{{$category->id}}">
                            <div class="admin-category__content">
                                <span class="admin-category__index">Номер в порядке - {{$category->order_index}}</span>
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
    </div>
</section>
<div class="modal" id="modalAddCategory" data-modal="modalAddCategory">
    <button class="modal__close" id="modalCloseAddCategory" type="button"></button>
    <h3 class="modal__title" id="modalTitle">Создание категории</h3>
    <form action="{{ route('admin.categories.store') }}" id="categoryForm" method="POST">
        @csrf
        <ul class="modal__list">
            <li class="modal__item">
                <label class="label" for="name">Название категории</label>
                <span class="error" id="nameUniqueError">Имя должно быть уникальным</span>
                <span class="error" id="nameMaxError">Максимальное количество символов в имени - 250</span>
                <input class="input" type="text" id="name" name="name" required>
            </li>
            <li class="modal__item">
                <label class="label" for="subtitle">Подзаголовок (необязательно)</label>
                <span class="error" id="subtitleMaxError">Максимальное количество символов в подзаголовке - 250</span>
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
        <span class="error" id="nameUniqueErrorEdit">Имя должно быть уникальным</span>
        <span class="error" id="nameMaxErrorEdit">Максимальное количество символов - 250</span>
        @csrf
        <ul class="modal__list">
            <li class="modal__item">
                <label class="label" for="nameEdit">Название категории</label>
                <input class="input" type="text" id="nameEdit" name="nameEdit" required>
            </li>
            <li class="modal__item">
                <label class="label" for="subtitleEdit">Подзаголовок (необязательно)</label>
                <span class="error"
                      id="subtitleMaxErrorEdit">Максимальное количество символов в подзаголовке - 250</span>
                <input class="input" type="text" id="subtitleEdit" name="subtitleEdit">
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
@vite(['resources/js/categories/categories.js?type=module'])
@vite(['resources/js/categories/dragging-categories.js'])
</body>