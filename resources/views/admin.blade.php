@include('fragments/head', ['title' => 'Страница админа'])
<body class="body">
<header class="header header--not-main">
    @include('fragments/header_top')
</header>
<section class="auth indent">
    <div class="container">
        привет
    </div>
</section>
@vite(['resources/js/app.js'])
</body>