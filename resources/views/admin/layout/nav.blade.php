@include('admin.update.check_update')
<?php
$version_update = updateCurl('http://apps.ranksol.com/app_updates/classified_app/update.php?ver='.$setting->version.'&time='.time(), 'post');
/*
print_r($version_update);
die();*/
if($version_update!=''){
    \Session::put('up_version', json_decode($version_update) );
}
?>
<!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{!! url('/') !!}" class="logo"><span> {{ $setting->title }} </span><i class="mdi mdi-cube"></i></a>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <a href="{{ url('/') }}" class="btn btn-primary m-t-15 "> Siteye Git </a>
            @if($setting->translate == 1)
            <a class="btn btn-primary btn-sm m-t-15" style="padding: 0px 4px 3px 6px !important;" id="google_translate_element"></a>
            @endif
            <!-- Navbar-left -->
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
                <li class="hidden-xs">
            </ul>
            <!-- Right(Notification) -->
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown user-box">
                    <a href="" class="dropdown-toggle waves-effect waves-light user-link" data-toggle="dropdown" aria-expanded="true">
                        <img src="<?= (Auth::user()->image !="")? asset('assets/images/users/'.Auth::user()->image) : asset('assets/images/user_hidden.png') ?>" alt="user-img" class="img-circle user-img profile-img">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                        <li>
                            <h5> Hi, <span id="user_name"> {{ Auth::user()->name }} </span> </h5>
                        </li>
                        <li><a href="{{ url('profile')  }}"><i class="ti-user m-r-5"></i> Profil</a></li>

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti-power-off m-r-5"></i> ????k???? Yap
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                    </ul>
                </li>
            </ul> <!-- end navbar-right -->
        </div><!-- end container -->
    </div><!-- end navbar -->
</div>
<!-- Top Bar End -->

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- User detail -->
            <div class="user-details">
                <div class="overlay"></div>
                <div class="text-center">
                    <img src="<?= (Auth::user()->image !="")? asset('assets/images/users/'.Auth::user()->image) : asset('assets/images/user_hidden.png') ?>" alt="" class="img-thumbnail profile-img" style="height: 45px;">
                </div>
                <div class="user-info">
                    <div>
                        <a href="#setting-dropdown" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> {{ Auth::user()->name }} <span class="mdi mdi-menu-down"></span></a>
                    </div>
                </div>
            </div>
            <!-- end user detail -->

            <div class="dropdown" id="setting-dropdown">
                <ul class="dropdown-menu">
                    <li><a href="{{ url('profile')  }}"><i class="mdi mdi-face-profile m-r-5"></i> Profil</a></li>
                    <li><a href=""><i class="mdi mdi-account-settings-variant m-r-5"></i> Ayarlar</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti-power-off m-r-5"></i> ????k???? Yap
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
            <ul>

                <?php

                $ver_update = json_decode($version_update);
                if(isset($ver_update->updates))
                {

                ?>
                <?php } ?>
                <li class="menu-title">Navigation</li>
                <li><a href="{{ url('dashboard') }}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span> Kontrol Paneli </span> </a></li>
                <li><a href="{{ url('users') }}" class="waves-effect"><i class="fa fa-users"></i><span> Kullan??c??lar?? Y??net</span> </a></li>
                <li><a href="{{ route('ads.index') }}" class="waves-effect"><i class="fa fa-tv" aria-hidden="true"></i><span> ??lanlar</span> </a></li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file"></i> <span>??zel Sayfalar</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('custom-page.index') }}">Sayfa Olu??tur</a></li>
                        <li><a href="{{ route('custom-page.create') }}">Sayfalar?? Y??net</a></li>

                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i> <span>Ayarlar</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{!! Route('setting.create') !!}">A?? Ayarlar??</a></li>
                        <li><a href="{!! Route('setting.index') !!}">A?? Reklamlar??</a></li>
                        <li><a href="{!! Route('email-settings.index') !!}">E-Postalar</a></li>
                        <li><a href="{!! Route('featured-ads.index') !!}">??ne ????kan ??lanlar</a></li>
                        @if($setting->mobile_verify == 1)
                        <li><a href="{!! Route('mobile_verify.index') !!}">Mobil Do??rulama</a></li>
                        @endif
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-list-alt"></i> <span>Kategori</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('category.create') }}" class="waves-effect"><i class="fa fa-plus"></i><span>Ekle</span> </a></li>
                        <li><a href="{{ route('category.index') }}" class="waves-effect"><i class="fa fa-list"></i><span>Listele</span> </a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-files-o"></i> <span>Gruplar</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('groups.create') }}" class="waves-effect"><i class="fa fa-plus"></i><span>Ekle</span> </a></li>
                        <li><a href="{{ route('groups.index') }}" class="waves-effect"><i class="fa fa-list"></i><span>Listele</span> </a></li>
                    </ul>
                </li>

                 <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-map-marker"></i> <span>Konum</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('region') }}" class="waves-effect"><i class="fa fa-plus"></i><span>B??lge</span> </a></li>
                        <li><a href="{{ url('city') }}" class="waves-effect"><i class="fa fa-plus"></i><span>??ehir</span> </a></li>
                    </ul>
                </li>
                <!-- Custom Fields -->
                <li><a href="{{ url('customfields') }}" class="waves-effect"><i class="fa fa-list"></i><span>??zel Alanlar</span></a></li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
