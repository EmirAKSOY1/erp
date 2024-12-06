<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endkon-Giriş Yap</title>
<!-- Boxicons CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
<link rel="shortcut icon" href="{{asset('storage/images/favicon.png')}}">

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

<!-- Helpers -->
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

<!-- Config Script -->
<script src="{{ asset('assets/js/config.js') }}"></script>

</head>
<body>


    

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner">
            <!-- Login -->
            <div class="card px-sm-6 px-0">
              <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <img src="{{ asset('storage/images/logo.jpg') }}" alt="Şirket Logosu" width="150" />
                </div>
                <!-- /Logo -->
                <h4 class="mb-1">Endkon ERP Otomasyonu </h4>
                <p class="mb-6">Lütfen size verilmiş olan bilgilerinizle giriş yapınız.</p>
      
                <form id="formAuthentication" class="mb-6" action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="mb-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="ornek@mail.com" autofocus="">
                  </div>
                  <div class="mb-6 form-password-toggle">
                    <label class="form-label" for="password">Şifre</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                <br>
                  <div class="mb-6">
                    <button class="btn btn-primary d-grid w-100" type="submit">Giriş Yap</button>
                  </div>
                </form>
      
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
      

              </div>
            </div>
            <!-- /Login -->
          </div>
        </div>
      </div>
      
      <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
      <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
      <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
      
      <!-- endbuild -->
      
      <!-- Vendors JS -->
      
      <!-- Main JS -->
      <script src="{{ asset('assets/js/main.js') }}"></script>
      
</body>
</html>
