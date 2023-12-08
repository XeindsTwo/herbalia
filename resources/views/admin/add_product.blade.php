@include('fragments/head', ['title' => 'Создание товара'])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin">
    <div class="container container--admin">
        <form class="admin-add__form" action="{{route('admin.products.store')}}" method="POST"
              enctype="multipart/form-data">
            <input type="hidden" name="selected_photos" id="selectedPhotos">
            <input type="hidden" name="composition" id="hiddenComposition">
            <h1 class="admin__title admin__title--bottom">Создание товара</h1>
            @csrf
            <div class="admin-add__content">
                <ul class="admin-add__items">
                    <li class="admin-add__row">
                        <label class="label" for="name">Название товара</label>
                        <span class="error" id="errorName">Макс. количество символов - 240</span>
                        <input class="input" id="name" name="name" type="text" required placeholder="Введите название">
                    </li>
                    <li class="admin-add__row">
                        <label class="label" for="price">Цена (в ₽)</label>
                        <span class="error" id="errorMinPrice">Мин. цена товара - 1 700₽</span>
                        <span class="error" id="errorMaxPrice">Макс. цена товара - 1 000 000₽</span>
                        <input class="input" id="price" name="price" type="number" required placeholder="Введите цену">
                    </li>
                    <li class="admin-add__row">
                        <label class="label" for="photo">Выберите категорию</label>
                        <select class="select" name="category_id" id="category_id">
                            @foreach($categories as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
                <div class="admin-add__files">
                    <label class="label" for="photo">Фотографии товара</label>
                    <span class="error error__files" id="photosError">
                        Ваш файл имеет неверный формат. Пожалуйста, выберите изображение в формате PNG, WebP, JPEG или JPG.
                    </span>
                    <span class="error error__files" id="photosLimitMinError">
                        Минимальное количество фото - 1
                    </span>
                    <span class="error error__files" id="photosLimitMaxError">
                        Максимальное количество фото - 4
                    </span>
                    <input type="file" name="photos[]" id="fileInput" multiple style="display: none;"
                           accept="image/png, image/webp, image/jpeg, image/jpg">
                    <label class="custom-file__upload" for="fileInput">
                        Загрузить
                    </label>
                    <ul class="custom-file__items" id="uploadedImages"></ul>
                </div>
                <div class="admin-add__composition">
                    <button class="admin-add__plus" type="button">+ Добавить элемент</button>
                    <ul class="admin-add__composition-list" id="compositionContainer">
                        <li class="admin-add__row" id="firstRow">
                            <div class="admin-add__errors">
                                <span class="error">Макс. количество символов - 240</span>
                                <span class="error">Мин. число - 1</span>
                                <span class="error">Макс. число - 1000</span>
                            </div>
                            <div class="admin-add__row-content">
                                <div class="admin-add__column">
                                    <label for="elementName_1">Название</label>
                                    <input class="input" type="text" id="elementName_1" placeholder="Элемент состава"
                                           required>
                                </div>
                                <div class="admin-add__column admin-add__column--quantity">
                                    <label for="elementQuantity_1">Кол-во</label>
                                    <input class="admin-add__quantity input" type="number" id="elementQuantity_1"
                                           value="1" required placeholder="Кол-во">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="modal__btn" type="submit" id="submitButton">Создать товар</button>
        </form>
    </div>
</section>
@vite(['resources/js/products/add-product.js?type=module'])
@vite(['resources/js/components/custom-select.js'])
</body>