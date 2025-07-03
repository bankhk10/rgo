<div class="flex mt-[4.7rem] md:mt-0">
    <nav class="side-nav w-[220px] text-white min-h-screen">
        <!-- ✅ Logo อยู่ด้านบนสุดของเมนู -->
        <div class="flex items-center justify-center py-6">
            <img alt="Logo" class="h-21" src="{{ asset('images/logo.png') }}" />
        </div>
        <div class="side-nav__devider my-2"></div>
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="side-menu" id="menu-dashboard">
                    <div class="side-menu__icon"><i data-lucide="home"></i></div>
                    <div class="side-menu__title mt-1">แดชบอร์ด</div>
                </a>
            </li>
            @canany('Inregister read', 'Inregister create', 'Inregister update', 'Inregister delete')
                <li>
                    <a href="{{ route('import.index') }}" class="side-menu" id="menu-inregister">
                        <div class="side-menu__icon"><i data-lucide="file-text"></i></div>
                        <div class="side-menu__title">ทะเบียนนำเข้าวัตถุดิบ</div>
                    </a>
                </li>
            @endcanany
            @canany('RegisterNew read', 'RegisterNew create', 'RegisterNew update', 'RegisterNew delete')
                <li>
                    <a href="{{ route('newregis.index') }}" class="side-menu" id="menu-newregis">
                        <div class="side-menu__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clipboard-pen-icon lucide-clipboard-pen">
                                <rect width="8" height="4" x="8" y="2" rx="1" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5.5" />
                                <path d="M4 13.5V6a2 2 0 0 1 2-2h2" />
                                <path
                                    d="M13.378 15.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                            </svg>
                        </div>

                        <div class="side-menu__title">ทะเบียนสินค้าทั้งหมด</div>
                    </a>
                </li>
            @endcanany
            {{-- @canany('RegisterContinue read',
                'RegisterContinue create',
                'RegisterContinue update',
                'RegisterContinue
                delete')
                <li>
                    <a href="{{ route('renewregis.index') }}" class="side-menu" id="menu-renewregis">
                        <div class="side-menu__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-pen-line-icon lucide-pen-line">
                                <path d="M12 20h9" />
                                <path
                                    d="M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z" />
                            </svg>
                        </div>

                        <div class="side-menu__title">ต่อทะเบียนสินค้าเก่า</div>
                    </a>
                </li>
            @endcanany --}}
            @canany('RegisterManufacture read',
                'RegisterManufacture create',
                'RegisterManufacture update',
                'RegisterManufacture
                delete')
                <li>
                    <a href="{{ route('manufactureregis.index') }}" class="side-menu" id="menu-manufacture">
                        <div class="side-menu__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clipboard-check-icon lucide-clipboard-check">
                                <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                <path d="m9 14 2 2 4-4" />
                            </svg>
                        </div>

                        <div class="side-menu__title">ทะเบียนผลิตทั้งหมด</div>
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
                                <div class="side-menu__title">ทะเบียนนำเข้าวัตถุดิบ</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcanany --}}
            @canany('Permission read', 'Permission create', 'Permission update', 'Permission delete')
                <li>
                    <a href="{{ route('admin.permissions.index') }}" class="side-menu" id="menu-permissions">
                        <div class="side-menu__icon"><i data-lucide="key"></i></div>
                        <div class="side-menu__title">Permission</div>
                    </a>
                </li>
            @endcanany
            @canany('Role read', 'Role create', 'Role update', 'Role delete')
                <li>
                    <a href="{{ route('admin.roles.index') }}" class="side-menu" id="menu-roles">
                        <div class="side-menu__icon"><i data-lucide="shield-check"></i></div>

                        <div class="side-menu__title">กำหนดสิทธื์</div>
                    </a>
                </li>
            @endcanany
            @canany('User read', 'User create', 'User update', 'User delete')
                <li>
                    <a href="{{ route('admin.users.index') }}" class="side-menu" id="menu-users">
                        <div class="side-menu__icon"><i data-lucide="users"></i></div>
                        <div class="side-menu__title">ผู้ใช้งาน</div>
                    </a>
                </li>
            @endcanany
            @canany('User read', 'User create', 'User update', 'User delete')
                <li>
                    <a href="{{ route('company.index') }}" class="side-menu" id="menu-company">
                        <div class="side-menu__icon"><i data-lucide="building"></i></div>
                        <div class="side-menu__title">บริษัท</div>
                    </a>
                </li>
            @endcanany
        </ul>
    </nav>
</div>


<style>
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 24px 0;
        /* Adjusted padding for better spacing */
    }

    .logo-circular {
        width: 100px;
        /* Adjust size as needed /
    height: 100px; / Ensure it's a square for a perfect circle /
    border-radius: 50%;
    overflow: hidden; / Clips the image into a circle */
    }

    .logo-circular img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<link rel="stylesheet" href="{{ asset('stype_c/app.css') }}">
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
        if (currentUrl === "{{ route('newregis.index', [], false) }}") {
            document.getElementById('menu-newregis')?.classList.add('side-menu--active');
        }
        if (currentUrl === "{{ route('renewregis.index', [], false) }}") {
            document.getElementById('menu-renewregis')?.classList.add('side-menu--active');
        }
        if (currentUrl === "{{ route('manufactureregis.index', [], false) }}") {
            document.getElementById('menu-manufacture')?.classList.add('side-menu--active');
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
        if (currentUrl === "{{ route('company.index', [], false) }}") {
            document.getElementById('menu-company')?.classList.add('side-menu--active');
        }

    });
</script>
