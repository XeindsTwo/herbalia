@include('fragments/head', ['title' => 'Создание товара'])
<body class="body">
<header class="admin__header">
    @include('fragments/header_admin')
</header>
<section class="admin">
    <div class="container">
        <div class="admin__wrapper">
            <h1 class="admin__title">Создание товара</h1>
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="label" for="name">Название товара</label>
                    <input class="input" id="name" name="name" type="text" required>
                </div>
                <div class="form-group">
                    <label class="label" for="price">Цена (в ₽)</label>
                    <input class="input" id="price" name="price" type="number" required>
                </div>
                <div class="form-group">
                    <label class="label" for="description">Описание товара</label>
                    <textarea class="input input--textarea" name="description" id="description" required></textarea>
                </div>
                <div class="form-group">
                    <label class="label" for="photo">Фотография</label>
                    <input type="file" name="photos[]" multiple>
                </div>
                <div class="form-group">
                    <label class="label" for="photo">Выберите категорию</label>
                    <select name="category_id" id="category_id">
                        @foreach($categories as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
</section>
{{--
@vite(['resources/js/categories/categories.js?type=module'])
--}}
</body>