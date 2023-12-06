@include('fragments/head', ['title' => 'Управление товарами'])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin">
    <div class="container container--admin">
        <div class="admin__wrapper">
            <h1 class="admin__title">Управление товарами</h1>
            <div class="admin-warning admin-warning--green">
                <span class="admin-warning__icon">
                    <img width="26" height="26" src="{{asset('static/images/icons/check-circle.svg')}}"
                         alt="предупреждение">
                </span>
                <div>
                    Чтобы управлять товарами - выберите одну из категорий для дальнейшей работы
                </div>
            </div>
            @if($categories->isEmpty())
                <div class="admin-products__empty">
                    <img class="admin-products__decor" src="{{asset('static/images/icons/flowers.svg')}}" width="120"
                         alt="декор">
                    <span class="admin-products__title">В управлении пока пусто ¯\_(ツ)_/¯</span>
                    <p class="admin-products__text">Категорий еще нет, но вы можете создать их</p>
                    <a class="admin-products__btn admin__btn admin__btn--categories"
                       href="{{route('admin.categories.index')}}">Добавить категорию</a>
                </div>
            @endif
            <ul class="admin-products__buttons">
                @foreach($categories as $category)
                    <li class="admin-products__item">
                        <a class="admin-products__link"
                           href="{{route('admin.products.category', ['category_id' => $category->id])}}">{{$category->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
</body>