<div class="flex mt-[4.7rem] md:mt-0">
    <!-- BEGIN: Side Menu -->
    <nav class="side-nav bg-blue-800 text-white w-64 min-h-screen">
        <a href="{{ route('admin.dashboard') }}"
           class="intro-x flex items-center pl-5 pt-4">
            <img alt="Logo"
                 class="w-10"
                 src="/images/logo.png" />
            <span class="hidden xl:block text-white text-lg ml-3"> RGO </span>
        </a>
        <div class="side-nav__devider my-6"></div>
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="side-menu {{ Route::currentRouteNamed('admin.dashboard') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon"><i data-lucide="home"></i></div>
                    <div class="side-menu__title">Dashboard</div>
                </a>
            </li>
            @canany('Post access', 'Post add', 'Post edit', 'Post delete')
                <li x-data="{ open: {{ Route::is('admin.posts.*', 'admin.production.*', 'admin.import.*') ? 'true' : 'false' }} }">
                    <a href="javascript:;"
                       @click="open = !open"
                       class="side-menu">
                        <div class="side-menu__icon"><i data-lucide="file-text"></i></div>
                        <div class="side-menu__title">
                            ข้อมูลทะเบียน
                            <div class="side-menu__sub-icon transform"
                                 :class="{ 'rotate-180': open }">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="side-menu__sub-open"
                        x-show="open"
                        x-transition>
                        <li>
                            <a href="{{ route('admin.posts.index') }}"
                               class="side-menu {{ Route::currentRouteNamed('admin.posts.index') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                                <div class="side-menu__title">ข้อมูลการขึ้นทะเบียน</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.production.index') }}"
                               class="side-menu {{ Route::currentRouteNamed('admin.production.index') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                                <div class="side-menu__title">ข้อมูลทะเบียนการผลิต</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.import.index') }}"
                               class="side-menu {{ Route::currentRouteNamed('admin.import.index') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                                <div class="side-menu__title">ทะเบียนนำเข้า</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcanany

            @canany('Permission access', 'Permission add', 'Permission edit', 'Permission delete')
                <li>
                    <a href="{{ route('admin.permissions.index') }}"
                       class="side-menu {{ Route::currentRouteNamed('admin.permissions.index') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"><i data-lucide="key"></i></div>
                        <div class="side-menu__title">Permission</div>
                    </a>
                </li>
            @endcanany

            @canany('Role access', 'Role add', 'Role edit', 'Role delete')
                <li>
                    <a href="{{ route('admin.roles.index') }}"
                       class="side-menu {{ Route::currentRouteNamed('admin.roles.index') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"><i data-lucide="shield"></i></div>
                        <div class="side-menu__title">Role</div>
                    </a>
                </li>
            @endcanany

            @canany('User access', 'User add', 'User edit', 'User delete')
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="side-menu {{ Route::currentRouteNamed('admin.users.index') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"><i data-lucide="users"></i></div>
                        <div class="side-menu__title">User</div>
                    </a>
                </li>
            @endcanany
        </ul>
    </nav>

</div>

<link rel="stylesheet"
      href="{{ asset('stype_c/app.css') }}">
<script src="{{ asset('stype_c/app.js') }}"></script>
