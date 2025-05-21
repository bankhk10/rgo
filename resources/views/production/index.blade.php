{{-- <x-app-layout> --}}
<div class="flex mt-[4.7rem] md:mt-0">
    <!-- BEGIN: Side Menu -->
    <nav class="side-nav">
        <a href=""
           class="intro-x flex items-center pl-5 pt-4">
            <img alt="Midone - HTML Admin Template"
                 class="w-6"
                 src="dist/images/logo.svg" />
            <span class="hidden xl:block text-white text-lg ml-3"> Test1 </span>
        </a>
        <div class="side-nav__devider my-6"></div>
        <ul>
            <li>
                <a href="side-menu-light-post.html"
                   class="side-menu">
                    <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                    <div class="side-menu__title"> Post </div>
                </a>
            </li>

            <li>
                <a href="javascript:;.html"
                   class="side-menu side-menu--active">
                    <div class="side-menu__icon"><i data-lucide="home"></i></div>
                    <div class="side-menu__title">
                        Dashboard 1
                        <div class="side-menu__sub-icon transform rotate-180">
                            <i data-lucide="chevron-down"></i>
                        </div>
                    </div>
                </a>
                <ul class="side-menu__sub-open">
                    <li>
                        <a href="index.html"
                           class="side-menu side-menu--active">
                            <div class="side-menu__icon">
                                <i data-lucide="activity"></i>
                            </div>
                            <div class="side-menu__title">Overview 1</div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-dashboard-overview-2.html"
                           class="side-menu">
                            <div class="side-menu__icon">
                                <i data-lucide="activity"></i>
                            </div>
                            <div class="side-menu__title">Overview 2</div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-dashboard-overview-3.html"
                           class="side-menu">
                            <div class="side-menu__icon">
                                <i data-lucide="activity"></i>
                            </div>
                            <div class="side-menu__title">Overview 3</div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-dashboard-overview-4.html"
                           class="side-menu">
                            <div class="side-menu__icon">
                                <i data-lucide="activity"></i>
                            </div>
                            <div class="side-menu__title">Overview 4</div>
                        </a>
                    </li>
                </ul>
            </li>



        </ul>
    </nav>
    <div class="content">
        <div class="top-bar">
            <nav aria-label="breadcrumb"
                 class="-intro-x mr-auto hidden sm:flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Application</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">
                        Dashboard
                    </li>
                </ol>
            </nav>
            <div class="intro-x relative mr-3 sm:mr-6">
                <div class="search hidden sm:block">
                    <input type="text"
                           class="search__input form-control border-transparent"
                           placeholder="Search..." />
                    <i data-lucide="search"
                       class="search__icon dark:text-slate-500"></i>
                </div>
                <a class="notification sm:hidden"
                   href="">
                    <i data-lucide="search"
                       class="notification__icon dark:text-slate-500"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet"
      href="{{ asset('stype_c/app.css') }}">
<script src="{{ asset('stype_c/app.js') }}"></script>
{{-- </x-app-layout> --}}
