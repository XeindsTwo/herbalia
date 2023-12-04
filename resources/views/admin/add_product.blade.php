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
            <h1 class="admin__title admin__title--bottom">Создание товара</h1>
            @csrf
            <div class="admin-add__content">
                <ul class="admin-add__items">
                    <li class="admin-add__row">
                        <label class="label" for="name">Название товара</label>
                        <input class="input" id="name" name="name" type="text" required placeholder="Введите название">
                    </li>
                    <li class="admin-add__row">
                        <label class="label" for="price">Цена (в ₽)</label>
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
                        Максимальное количество фото - 5
                    </span>
                    <input type="file" name="photos[]" id="fileInput" multiple style="display: none;"
                           accept="image/png, image/webp, image/jpeg, image/jpg">
                    <label class="custom-file__upload" for="fileInput">
                        Загрузить
                    </label>
                    <ul class="custom-file__items" id="uploadedImages"></ul>
                </div>
                <div class="form-group">
                    <label class="label" for="description">Описание товара</label>
                    <textarea class="input input--textarea" name="description" id="description" required></textarea>
                </div>
            </div>
            <button type="submit" id="submitButton">Отправить</button>
        </form>
    </div>
</section>
@vite(['resources/js/products/add-product.js?type=module'])
@vite(['resources/js/components/custom-select.js'])
</body>