<div class="admin__navigation">
    <div class="container container--admin">
        <div class="admin__navigation-inner">
            <a class="logo" href="/">
                <img class="logo" width="133" height="31" src="{{asset('static/images/icons/logo.svg')}}"
                     alt="логотип">
            </a>
            <ul class="admin__navigation-list">
                <li class="admin__navigation-item">
                    <a class="admin__navigation-link {{ request()->routeIs('admin.categories.index') ? 'admin__navigation-link--active' : '' }}"
                       href="{{route('admin.categories.index')}}">
                        Управление категориями
                    </a>
                </li>
                <li class="admin__navigation-item">
                    <a class="admin__navigation-link {{ request()->routeIs('admin.products.index') ? 'admin__navigation-link--active' : '' }}"
                       href="{{route('admin.products.index')}}">Управление товарами</a>
                </li>
                <li class="admin__navigation-item">
                    <a class="admin__navigation-link {{ request()->routeIs('admin.reviews.index') ? 'admin__navigation-link--active' : '' }}" href="{{route('admin.reviews.index')}}">
                        Управление отзывами
                    </a>
                </li>
                <li class="admin__navigation-item">
                    <a class="admin__navigation-link" href="">
                        Улучшения проекта
                    </a>
                </li>
                <li class="admin__navigation-item">
                    <a class="admin__navigation-link {{ request()->routeIs('admin.users.index') ? 'admin__navigation-link--active' : '' }}"
                       href="{{route('admin.users.index')}}">Управление пользователями</a>
                </li>
            </ul>
        </div>
    </div>
</div>