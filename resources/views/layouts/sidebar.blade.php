<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>   
    
    <!-- sidebar -->
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>
                <li>
                    <a href="{{ url('agenda-rapat') }}">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Agenda
                    </a>
                </li>
                <li>
                    <a href="{{ url('profil') }}">
                        <i class="metismenu-icon pe-7s-smile"></i>
                        Profil
                    </a>
                </li>
                <li>
                    <a href="{{ url('ruangan-rapat') }}">
                        <i class="metismenu-icon pe-7s-wallet"></i>
                        Ruangan
                    </a>
                </li>
                <li>
                    <a href="{{ url('notula-rapat') }}">
                        <i class="metismenu-icon pe-7s-news-paper"></i>
                        Notula
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Laporan
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('/laporan-perbulan') }}">
                                <i class="metismenu-icon"></i>
                                Perbulan
                            </a>
                            <a href="{{ url('/laporan-pertahun') }}">
                                <i class="metismenu-icon"></i>
                                Pertahun
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</div> 