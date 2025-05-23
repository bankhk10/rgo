{{-- <x-app-layout> --}}

<div class="flex mt-[4.7rem] md:mt-0">
    <nav class="side-nav">
        <a href="{{ route('admin.dashboard') }}"
           class="intro-x flex items-center pl-5 pt-4">
            <img alt="Logo"
                 class="w-22"
                 src="/images/logo.png" />
        </a>
        {{-- <div class="side-nav__devider my-6"></div> --}}
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="side-menu"
                   id="menu-dashboard">
                    <div class="side-menu__icon"><i data-lucide="home"></i></div>
                    <div class="side-menu__title mt-1">รายงาน</div>
                </a>
            </li>
            @canany('Inregister read', 'Inregister create', 'Inregister update', 'Inregister delete')
                <li>
                    <a href="{{ route('import.index') }}"
                       class="side-menu"
                       id="menu-inregister">
                        <div class="side-menu__icon"><i data-lucide="file-text"></i></div>

                        <div class="side-menu__title">ทะเบียนนำเข้า</div>
                    </a>
                </li>
            @endcanany

            {{-- @canany('Post read', 'Post create', 'Post update', 'Post delete')
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
            @endcanany --}}
            @canany('Permission read', 'Permission create', 'Permission update', 'Permission delete')
                <li>
                    <a href="{{ route('admin.permissions.index') }}"
                       class="side-menu"
                       id="menu-permissions">
                        <div class="side-menu__icon"><i data-lucide="key"></i></div>
                        <div class="side-menu__title">Permission</div>
                    </a>
                </li>
            @endcanany
            @canany('Role read', 'Role create', 'Role update', 'Role delete')
                <li>
                    <a href="{{ route('admin.roles.index') }}"
                       class="side-menu"
                       id="menu-roles">
                        <div class="side-menu__icon"><i data-lucide="shield-check"></i></div>

                        <div class="side-menu__title">สิทธื์</div>
                    </a>
                </li>
            @endcanany
            @canany('User read', 'User create', 'User update', 'User delete')
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="side-menu"
                       id="menu-users">
                        <div class="side-menu__icon"><i data-lucide="users"></i></div>
                        <div class="side-menu__title">ผู้ใช้งาน</div>
                    </a>
                </li>
            @endcanany
        </ul>
    </nav>
</div>



<link rel="stylesheet"
      href="{{ asset('stype_c/app.css') }}">
<script src="{{ asset('stype_c/app.js') }}"></script>
<script>
    window.addEventListener('load', function() {
        const currentUrl = window.location.pathname;
        // ตรวจสอบและ active เมนูหลังโหลดหน้าเสร็จ
        if (currentUrl === "{{ route('admin.dashboard', [], false) }}") {
            document.getElementById('menu-dashboard')?.classList.add('side-menu--active');
        }
        if (currentUrl === "{{ route('import.index', [], false) }}") {
            document.getElementById('menu-inregister')?.classList.add('side-menu--active');
        }
        if (currentUrl === "{{ route('admin.permissions.index', [], false) }}") {
            document.getElementById('menu-permissions')?.classList.add('side-menu--active');
        }
        if (currentUrl === "{{ route('admin.production.index', [], false) }}") {
            document.getElementById('menu-production')?.classList.add('side-menu--active');
        }
        if (currentUrl === "{{ route('admin.roles.index', [], false) }}") {
            document.getElementById('menu-roles')?.classList.add('side-menu--active');
        }
        if (currentUrl === "{{ route('admin.users.index', [], false) }}") {
            document.getElementById('menu-users')?.classList.add('side-menu--active');
        }
    });
</script>
{{-- </x-app-layout> --}}
