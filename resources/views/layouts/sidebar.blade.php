{{--Left sidebar--}}
<nav class="mt-2">

    @canany([
        'permission.mainadmin'
    ])
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'active':''}}">
                <i class="fas fa-users-cog"></i>
                <p>
                    @lang('cruds.userManagement.title')
                </p>
            </a>
            <ul class="nav nav-treeview pl-3" style="display: {{ (Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'block':'none'}};">
{{--                @can('permission.show')--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('permissionIndex') }}" class="nav-link {{ Request::is('permission*') ? "active":'' }}">--}}
{{--                        <i class="fas fa-key"></i>--}}
{{--                        <p> @lang('cruds.permission.title_singular')</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endcan--}}

{{--                @can('roles.show')--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('roleIndex') }}" class="nav-link {{ Request::is('role*') ? "active":'' }}">--}}
{{--                        <i class="fas fa-user-lock"></i>--}}
{{--                        <p> @lang('cruds.role.fields.roles')</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endcan--}}

                @can('user.show')
                <li class="nav-item  {{ Request::is('user*') ? "active":'' }}">
                    <a href="{{ route('userIndex') }}" class="nav-link">
                        <i class="fas fa-user-friends"></i>
                        <p> @lang('cruds.user.title')</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
    </ul>
    @endcanany
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/category" class="nav-link {{ (Request::is('category*') || Request::is('category*') || Request::is('category*')) ? 'active':''}}">
                <i class="fas fa-border-all" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;">
                    Категории
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/product" class="nav-link {{ Request::is('product*') ? "active":'' }}">
                <i class="fas fa-th" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;">Продукты</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/order" class="nav-link {{ Request::is('order*') ? "active":'' }}">
                <i class="fas fa-shopping-cart"  style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;">Заказы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/botusers" class="nav-link {{ Request::is('botusers*') ? "active":'' }}">
                <i class="fas fa-users" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;">Пользователи</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/complaint" class="nav-link {{ Request::is('complaint*') ? "active":'' }}">
                <i class="fas fa-file-alt" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;"> Жалоба</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/mailing" class="nav-link {{ Request::is('mailing*') ? "active":'' }}">
                <i class="fas fa-envelope" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;"> Рассылки </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/settings" class="nav-link {{ Request::is('settings*') ? "active":'' }}">
                <i class="fas fa-cog" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;"> Настройки </p>
            </a>
        </li>
    </ul>

{{--    @can('card.main')--}}

{{--    @endcan--}}
</nav>
