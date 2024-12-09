<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta http-equiv="refresh" content="3600"> --}}

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Yeni Template-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    

    <!--Sonu-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="shortcut icon" href="{{asset('storage/images/favicon.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    @yield('css')
    <style>


/* Mesajlar için ana stil */
.dropdown-menu .menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: block; /* Mesajları blok olarak sıralıyoruz */
}

/* Her mesajın stilleri */
.dropdown-menu .menu li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    display: block !important; /* Her mesajın alt alta sıralanması için display: block */
}

/* Mesaj linki için stiller */
.dropdown-menu .menu li a {
    display: block; /* Mesaj linkinin alt alta sıralanabilmesi için */
    text-decoration: none;
    color: inherit; /* Linklerin rengini koruyoruz */
}

/* Profil fotoğrafı ve mesaj metni düzenlemesi */
.message-info {
    margin-left: 10px;
    margin-top: 5px;
}

.message-info h4 {
    font-size: 14px;
    margin: 0;
}

.message-info p {
    font-size: 12px;
    margin: 5px 0;
    color: #666;
}

/* Mesaj okundu işaretinin stilini belirliyoruz */
.message-info small {
    font-size: 12px;
    color: #999;
}

.message-info i {
    color: #28a745;
    margin-left: 5px;
}

/* Profil fotoğrafının boyutu */
.pull-left img {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    object-fit: cover;
}

.unread {
    background-color: #f9f9f9; /* Okunmamış mesajları ayıran stil */
}






/* Genel ayarlar */
.pagination-wrapper {
    display: flex;
    justify-content: center; /* Ortalamak için */
    margin-top: 20px; /* Üstüne biraz boşluk bırakmak isterseniz */
}

.pagination {
    list-style-type: none;
}

#menu .active {
    background: #000 !important;
}

/* Modal içerik ayarları */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 300px; /* Genişlik */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

/* Tooltip ayarları */
.jqstooltip {
    position: absolute;
    left: 0;
    top: 0;
    visibility: hidden;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    font: 10px Arial, sans-serif;
    text-align: left;
    white-space: nowrap;
    padding: 5px;
    border: 1px solid white;
    z-index: 10000;
}

.jqsfield {
    color: white;
    font: 10px Arial, sans-serif;
    text-align: left;
}

/* Okunmamış mesaj ayarı */
.unread {
    background-color: #c7dbf6; /* Koyu gri veya istediğiniz başka bir renk */
}

/* Hesap makinesi ayarları */
#calculator {
    display: flex;
    flex-direction: column;
    align-items: center;
}

#display {
    width: 100%;
    height: 50px;
    font-size: 24px;
    text-align: right;
    margin-bottom: 10px;
}

.buttons {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.btn-light {
    height: 50px;
    font-size: 20px;
}

/* Yükleme ekranı ayarları */
.loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(255, 255, 255, 0.8); /* Beyaz yarı şeffaf arka plan */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader-chicken {
    width: 200px; /* Resmin boyutu */
    height: 100px;
    animation: spin 2s linear infinite; /* Döndürme animasyonu */
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
li{
    margin-right: 15px;
}
@media (max-width: 1200px) {
    .layout-navbar.navbar-detached {
    width: 500px;

  }
}


</style>
    
</head>

<body >
    
    {{-- <div id="loader" class="loader-overlay">
        <img src="{{ asset('storage/images/logo.jpg') }}" class="loader-chicken" alt="Yükleniyor..." >
    </div> --}}

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="">
                <div class="app-brand demo">

                @if (Auth::check()) 

                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{route("admin_dashboard")}}"  class="app-brand-link">
                    @elseif (Auth::user()->hasRole('yönetici'))
                        <a href="{{route("manager_dashboard")}}"  class="app-brand-link">
                    @elseif (Auth::user()->hasRole('bakıcı'))
                        <a href="{{route("bakici_dashboard")}}"  class="app-brand-link">
                    @elseif (Auth::user()->hasRole('veteriner'))
                        <a href="{{route("bakici_dashboard")}}"  class="app-brand-link">
                    @else
                        {{ Auth::logout() }}
                        <script>
                            window.location.href = "{{ route('login') }}";
                        </script>
                    @endif
                @else
                    {{ Auth::logout() }}
                    <script>
                        window.location.href = "{{ route('login') }}";
                    </script>
                @endif
                    <span class="app-brand-logo demo">
                        <img src="{{ asset('storage/images/logo.jpg') }}" alt="Şirket Logosu" width="150" />
                    </span>
                    
                    

                  </a>
        
                  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                  </a>
                </div>
        
                <div class="menu-inner-shadow"></div>
        <br>
                <ul class="menu-inner py-1">



                    {{-- @foreach($menus as $menu)
                    <li class="menu-item">
                        <a href="{{route($menu['route'])}}" class="menu-link">
                          <i class="menu-icon tf-icons {{$menu['icon']}}"></i>
                          <div data-i18n="Analytics">{{$menu['title']}}</div>
                        </a>
                      </li>
                      <br>
                    @endforeach --}}
                    <li class="menu-item">
                        <a href="{{route('admin_dashboard')}}" class="menu-link">
                          <i class="menu-icon tf-icons bx bxs-home-circle"></i>
                          <div data-i18n="Analytics">Anasayfa</div>
                        </a>
                      </li>
                      <br>
                    <li class="menu-item" style="">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon fa-solid fa-cubes "></i>
                          <div class="text-truncate" data-i18n="Layouts">Stok</div>
                        </a>
                  
                        <ul class="menu-sub">
                  
                          <li class="menu-item">
                            <a href="{{route('category.index')}}" class="menu-link">
                              <div class="text-truncate" data-i18n="Without menu">Kategoriler</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="layouts-without-navbar.html" class="menu-link">
                              <div class="text-truncate" data-i18n="Without navbar">Ürünler</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="layouts-fluid.html" class="menu-link">
                              <div class="text-truncate" data-i18n="Fluid">Fiyat Listeleri</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="{{route('supplier.index')}}" class="menu-link">
                              <div class="text-truncate" data-i18n="Container">Tedarikçiler</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <br>
                      <li class="menu-item" style="">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon fa-solid fa-wallet"></i>
                          <div class="text-truncate" data-i18n="Layouts">Satış</div>
                        </a>
                  
                        <ul class="menu-sub">
                  
                          <li class="menu-item">
                            <a href="layouts-without-menu.html" class="menu-link">
                              <div class="text-truncate" data-i18n="Without menu">Teklifler</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="{{route('customer.index')}}" class="menu-link">
                              <div class="text-truncate" data-i18n="Without navbar">Müşteriler</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="layouts-fluid.html" class="menu-link">
                              <div class="text-truncate" data-i18n="Fluid">Tahsilat</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <br>
                      <li class="menu-item">
                        <a href="{{route('admin_dashboard')}}" class="menu-link">
                          <i class="menu-icon fa-solid fa-receipt"></i>
                          <div data-i18n="Analytics">Giderler</div>
                        </a>
                      </li>
                      <br>
                      <li class="menu-item" style="">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon fa-regular fa-calendar-days"></i>
                          <div class="text-truncate" data-i18n="Layouts">CRM</div>
                        </a>
                  
                        <ul class="menu-sub">
                  
                          <li class="menu-item">
                            <a href="layouts-without-menu.html" class="menu-link">
                              <div class="text-truncate" data-i18n="Without menu">Etkinlikler</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="layouts-without-navbar.html" class="menu-link">
                              <div class="text-truncate" data-i18n="Without navbar">Müşteriler</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="layouts-fluid.html" class="menu-link">
                              <div class="text-truncate" data-i18n="Fluid">Tahsilat</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                </ul>
              </aside>
              <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                      <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                        <i class="bx bx-menu bx-md"></i>
                      </a>
                      
                    </div>
                
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <h3>Endkon Muhasebe</h3>
                      <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <li class="nav-item lh-1 me-4">
                          <span></span>
                        </li>
            <!-- Mesajlar Dropdown Menüsü -->
            <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    {{-- <span class="badge badge-center rounded-pill bg-info" id="unread-count">{{ $unreadCount ?? 0 }}</span> <!-- Mesaj sayısı --> --}}
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                            <ul class="menu" style="overflow-y: auto; height: 200px; margin: 0; padding: 0;">
                                {{-- @if ($messages->count() > 0)
                                    @foreach ($messages as $message)
                                        <li class="{{ $message->is_read ? '' : 'unread' }}">
                                            <a href="#">
                                                <div class="pull-left">
                                                    
                                                </div>
                                                <div class="message-info">
                                                    <h4>
                                                        {{ $message->sender->name }} {{ $message->sender->surname }} <!-- Mesajı gönderenin ismi -->
                                                        <small><i class="fa fa-clock-o"></i> {{ $message->created_at->diffForHumans() }}</small>
                                                    </h4>
                                                    <p>{{ Str::limit($message->message, 50) }}</p> <!-- Mesajın içeriği, 50 karakterle kısıtlandı -->
                                                    @if (!$message->is_read)
                                                        <small>
                                                            <form action="{{ route('messages.markAsRead', $message->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-link" title="Mesajı Oku">
                                                                    <i class="fa fa-check"></i> Okundu
                                                                </button>
                                                            </form>
                                                        </small>
                                                    @else
                                                        <small><i class="fa fa-check-circle"></i> Okundu</small>
                                                    @endif
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><a href="#">Henüz mesaj yok.</a></li>
                                @endif --}}
                            </ul>
                        </div>
                    </li>
                    <li class="footer"><a href="/mesaj/gelen_kutusu.php">Tüm Mesajlar</a></li>
                </ul>
            </li>


            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-center rounded-pill bg-info">5</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">5 Bildirim var</li>
                    <li>
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                            <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                {{-- @forelse ($notifications as $notification)
                                <li>
                                    <a href="#" class="notification-item" data-title="{{ $notification->title }}" data-content="{{ $notification->content }}" data-toggle="modal" data-target="#notificationModal">
                                        <i class="fa fa-warning text-yellow"></i> 
                                        <strong>{{ Str::limit($notification->title, 30, '...') }}</strong>
                                        <p style="margin: 0; padding-top: 5px; font-size: 12px; color: #777;">
                                            {{ Str::limit($notification->content, 40, '...') }}
                                        </p>
                                    </a>
                                </li>
                            @empty
                                <li class="text-center">Henüz bir bildirim yok</li>
                            @endforelse --}}
                            </ul>
                            <div class="slimScrollBar"
                                style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">
                            </div>
                            <div class="slimScrollRail"
                                style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                            </div>
                        </div>
                    </li>
                    <li class="footer"><a href="#">Tüm Bildirimler</a></li>
                </ul>
            </li>
            <li class="nav-item lh-1 me-4">
                <a href="javascript:void(0)" id="calculator-button" data-bs-toggle="modal" data-bs-target="#calculatorModal"><i class="fa fa-calculator"></i></a>
            </li>
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown"><i class="fa fa-user-circle fa-2x"></i> </a>
                <ul class="dropdown-menu dropdown-menu-end">
                   <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                               <i class="fa fa-user-circle fa-2x"></i> <!-- Profil simgesi olarak bir ikon kullanıldı -->
                            </div>
                            <div class="flex-grow-1">
                               <h6 class="mb-0">{{ auth()->user()->name }} {{ auth()->user()->surname }}</h6>
                               
                               <br>
                               <small class="text-muted">{{ ucfirst(auth()->user()->roles->first()->role_name) }}</small>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li>
                      <div class="dropdown-divider my-1"></div>
                   </li>
                   <li><a class="dropdown-item" href="#"><i class="bx bx-user bx-md me-3"></i><span>Hesabım</span></a></li>
                   <li>
                      <div class="dropdown-divider my-1"></div>
                   </li>
                   <li>
                      <!-- Log Out Link -->
                      <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="bx bx-power-off bx-md me-3"></i>
                      <span>Çıkış Yap</span>
                      </a>
                      <!-- Logout Form (POST method) -->
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                      </form>
                   </li>
                </ul>
             </li>
                        
                      </ul>
                    </div>
                  </nav>
                <div class="content-wrapper">
                    <br>
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @error('error')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror


                        @yield('content')
                    </div>
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                          <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                            <div class="text-body">
                              ©2024, made with by <a href="https://endkon.com" target="_blank" class="footer-link">Endkon 1.0</a>
                            </div>
                          </div>
                        </div>
                      </footer>
                      <div class="content-backdrop fade"></div>
                    </div>
              </div>
        </div>
    </div>
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Bildirim Detayı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 id="modalNotificationTitle"></h3>
                <p id="modalNotificationContent"></p>
            </div>
        </div>
    </div>
</div>
<!-- Hesap Makinesi Modalı -->
<div class="modal fade" id="calculatorModal" tabindex="-1" role="dialog" aria-labelledby="calculatorModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calculatorModalLabel">Hesap Makinesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body">
                <div id="calculator">
                    <input type="text" id="display" disabled>
                    <div class="buttons">
                        <button class="btn btn-light" onclick="appendToDisplay('7')">7</button>
                        <button class="btn btn-light" onclick="appendToDisplay('8')">8</button>
                        <button class="btn btn-light" onclick="appendToDisplay('9')">9</button>
                        <button class="btn btn-light" onclick="appendToDisplay('/')">/</button>
                        <button class="btn btn-light" onclick="appendToDisplay('4')">4</button>
                        <button class="btn btn-light" onclick="appendToDisplay('5')">5</button>
                        <button class="btn btn-light" onclick="appendToDisplay('6')">6</button>
                        <button class="btn btn-light" onclick="appendToDisplay('*')">*</button>
                        <button class="btn btn-light" onclick="appendToDisplay('1')">1</button>
                        <button class="btn btn-light" onclick="appendToDisplay('2')">2</button>
                        <button class="btn btn-light" onclick="appendToDisplay('3')">3</button>
                        <button class="btn btn-light" onclick="appendToDisplay('-')">-</button>
                        <button class="btn btn-light" onclick="appendToDisplay('0')">0</button>
                        <button class="btn btn-light" onclick="calculate()">=</button>
                        <button class="btn btn-light" onclick="clearDisplay()">C</button>
                        <button class="btn btn-light" onclick="appendToDisplay('+')">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    
    <script src="https://kit.fontawesome.com/dbfeb55d48.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    
	<!-- jQuery Cookie Plugin -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    
    <script>
        // 3 saniye sonra bildirimi otomatik olarak kapatma
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    </script>
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').click(function () {
        var dropdownMenu = $(this).next('.dropdown-menu');
        var windowHeight = $(window).height();
        var menuHeight = dropdownMenu.outerHeight();
        var menuTop = dropdownMenu.offset().top;

        // Eğer menü ekranın altına taşarsa, menüyü yukarıya doğru aç
        if (menuTop + menuHeight > windowHeight) {
            dropdownMenu.css('top', -menuHeight);  // Menüyü yukarıya doğru kaydır
        }
    });
    $('.notification-item').on('click', function() {
        var title = $(this).data('title');
        var content = $(this).data('content');
        
        $('#modalNotificationTitle').text(title);
        $('#modalNotificationContent').text(content);
    });
});

    </script>        
<script>
    function appendToDisplay(value) {
        document.getElementById('display').value += value;
    }

    function clearDisplay() {
        document.getElementById('display').value = '';
    }

    function calculate() {
        try {
            const result = eval(document.getElementById('display').value);
            document.getElementById('display').value = result;
        } catch (error) {
            alert('Geçersiz işlem');
        }
    }

    // Klavye ile kontrol için
    document.addEventListener('keydown', function(event) {
        if (event.key >= '0' && event.key <= '9') {
            appendToDisplay(event.key);
        } else if (['+', '-', '*', '/'].includes(event.key)) {
            appendToDisplay(event.key);
        } else if (event.key === 'Enter') {
            calculate();
        } else if (event.key === 'Escape') {
            clearDisplay();
        }
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>

    @yield('js')
</body>

</html>
