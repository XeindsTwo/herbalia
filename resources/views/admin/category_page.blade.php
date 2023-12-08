@include('fragments/head', ['title' => $currentCategory ? $currentCategory->name : ''])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin">
    <div class="container container--admin">
        <div class="admin__wrapper">
            <h1 class="admin__title">Управление категорией</h1>
            <ul class="admin__breadcrumbs breadcrumbs">
                <li class="breadcrumbs__item">
                    <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{route('admin.products.index')}}">
                        <span>Управление товарами</span>
                    </a>
                </li>
                <li class="breadcrumbs__item">
                    <span class="breadcrumbs__link active">{{$currentCategory->name}}</span>
                </li>
            </ul>
            <ul class="admin-products__buttons">
                @foreach($categories as $category)
                    <li class="admin-products__item">
                        <a class="admin-products__link @if($category->id === $currentCategory->id)admin-products__link--active @endif"
                           href="{{route('admin.products.category', ['category_id' => $category->id])}}">{{$category->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
            @if(!$products->isEmpty())
                <a class="admin__btn admin__btn--categories" href="{{route('admin.products.create')}}">
                    Добавить товар
                </a>
                <form class="admin-products__search"
                      action="{{ route('admin.products.category.search', ['category_id' => $currentCategory->id]) }}"
                      method="GET"
                      id="productSearchForm"
                      data-search-url="{{ route('admin.products.category.search', ['category_id' => $currentCategory->id]) }}">
                    <input type="text" name="query" placeholder="Введите данные из имени или описания товара">
                </form>
            @endif
            @if($products->isEmpty())
                <div class="admin-products__empty">
                    <img class="admin-products__decor" src="{{asset('static/images/icons/flowers.svg')}}" width="120"
                         alt="декор">
                    <span class="admin-products__title">В категории пока пусто ¯\_(ツ)_/¯</span>
                    <p class="admin-products__text">Товары еще не были созданы, но вы можете создать их</p>
                    <a class="admin-products__btn admin__btn admin__btn--categories"
                       href="{{route('admin.products.create')}}">Добавить товар</a>
                </div>
            @else
                <ul class="admin-products__list" id="productsListContainer">
                    @foreach($products as $product)
                        <li class="admin-products__card" data-product-id="{{$product->id}}">
                            <div class="admin-products__head">
                                <div class="admin-products__actions">
                                    <a class="admin-products__action admin-products__action--view"
                                       href="{{route('product.show', ['id' => $product->id])}}" target="_blank">
                                    </a>
                                    <button class="admin-products__action admin-products__action--delete"
                                            data-product-id="{{$product->id}}"></button>
                                </div>
                                @foreach($product->images as $image)
                                    @if($loop->first)
                                        <img class="admin-products__img" src="{{ asset('storage/' . $image->path) }}"
                                             height="360" alt="{{$product->name}}" data-image-path="{{$image->path}}">
                                    @endif
                                @endforeach
                            </div>
                            <p class="admin-products__price">
                                Цена: {{ number_format($product->price, 0, '.', ' ') }} ₽
                            </p>
                            <h3 class="admin-products__title">{{$product->name}}</h3>
                            <p class="admin-products__article">Артикул - {{$product->article}}</p>
                            <p>Описание: <br>{{$product->description}}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
<div class="modal" id="modalDeleteProduct">
    <button class="modal__close" id="modalCloseDeleteProduct" type="button"></button>
    <h3 class="modal__title">Удаление товара</h3>
    <p class="modal__text">
        Вы действительно хотите удалить товар <span id="nameDeleteProduct"></span>? Удаление будет
        невозможно отменить, все привязанные фотографии к товару будут удалены
    </p>
    <div class="modal__buttons">
        <button class="modal__btn modal__btn--cancel" id="cancelDeleteProduct" type="button">Отменить</button>
        <button class="modal__btn modal__btn--confirm" id="confirmDeleteProduct" type="submit">Да, удалить</button>
    </div>
</div>
@vite(['resources/js/products/products.js?type=module'])
</body>