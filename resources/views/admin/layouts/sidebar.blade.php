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
                    <a href="{{ url('akun-peserta') }}">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Akun Peserta
                    </a>
                </li>
                <li>
                    <a href="{{ url('peserta') }}">
                        <i class="metismenu-icon pe-7s-server"></i>
                        Peserta
                    </a>
                </li>
                <li>
                    <a href="{{ url('ruangan') }}">
                        <i class="metismenu-icon pe-7s-wallet"></i>
                        Ruangan
                    </a>
                </li>
                <!-- <li>
                    <a href="{{ url('jenisrapat') }}">
                        <i class="metismenu-icon pe-7s-albums"></i>
                        Jenis Rapat
                    </a>
                </li> -->
                <li>
                    <a href="{{ url('agenda') }}">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Agenda
                    </a>
                </li>
                <li>
                    <a href="{{ url('notula') }}">
                        <i class="metismenu-icon pe-7s-news-paper"></i>
                        Notula
                    </a>
                </li>
                
                
            </ul>
        </div>
    </div>
</div> 