@include('fragments/head', ['title' => $currentCategory ? $currentCategory->name : ''])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin">
    <div class="container">
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
                <ul class="admin-products__list">
                    @foreach($products as $product)
                        <li class="admin-products__card">
                            @foreach($product->images as $image)
                                @if($loop->first)
                                    <img class="admin-products__img" src="{{asset('storage/' . $image->path)}}"
                                         height="360" alt="{{$product->name}}">
                                @endif
                            @endforeach
                            <h3 class="admin-products__title">{{$product->name}}</h3>
                            <p class="admin-products__article">Артикул - {{$product->article}}</p>
                            <p class="admin-products__price">Цена:
                                {{ number_format($product->price, 0, '.', ' ') }} ₽
                            </p>
                            <p>{{$product->description}}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
@vite(['resources/js/products/products.js?type=module'])
</body>