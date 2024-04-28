<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="webhtml/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Đăng nhập | Công ty Hoàng Phát</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('webhtml/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('webhtml/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('webhtml/assets/css/custom.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet"
        href="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('webhtml/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('webhtml/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('webhtml/assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('webhtml/assets/js/config.js') }}"></script>

    <script src="{{ asset('webhtml/assets/js/js-custom/jquery.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/js/js-custom/toastr.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('webhtml/assets/css/toastr.min.css') }}">
</head>

<body @yield('onload')>
    <script>
        function loadPage(result, type) {
            console.log("aaa");
            if (result !== null) {
                toastr.options.positionClass = 'toast-bottom-right';
                if (type === 'success')
                    toastr.success(result);
                if (type === 'danger')
                    toastr.error(result);
                if (type === 'warning')
                    toastr.warning(result);
                if (type === 'info')
                    toastr.info(result);
            }
        };
    </script>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('webhtml/assets/img/illustrations/bg-login-light.gif') }}"
                        alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/bg-login-light.gif"
                        data-app-dark-img="illustrations/bg-login-dark.gif" style="width: 100%;" />

                    <img src="{{ asset('webhtml/assets/img/illustrations/bg-shape-image-light.png') }}"
                        alt="auth-login-cover" class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="{{ route('home') }}" class="app-brand-link gap-2">
                            <img src="{{ asset('webhtml/assets/img/logo/logo.png') }}" alt="logo" class="logo">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h3 class="mb-1">CÔNG TY TNHH SX - TM BAO BÌ HOÀNG PHÁT 👋</h3>
                    <p class="mb-4">Vui lòng đăng nhập để sử dụng các tính năng</p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('solve-login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Nhập tên người dùng" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Mật khẩu</label>
                                {{-- <a href="auth-forgot-password-cover.html">
                    <small>Quên mật khẩu?</small>
                  </a> --}}
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Nhớ tài khoản </label>
                            </div>
                        </div>
                        <input class="btn-primary rounded d-grid w-100 h-100" type="submit" value="Đăng nhập">
                    </form>

                    {{-- <p class="text-center">
              <span>New on our platform?</span>
              <a href="auth-register-cover.html">
                <span>Create an account</span>
              </a>
            </p> --}}

                    {{-- <div class="divider my-4">
              <div class="divider-text">or</div>
            </div>

            <div class="d-flex justify-content-center">
              <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                <i class="tf-icons fa-brands fa-google fs-5"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                <i class="tf-icons fa-brands fa-twitter fs-5"></i>
              </a>
            </div> --}}
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('webhtml/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('webhtml/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('webhtml/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('webhtml/assets/js/pages-auth.js') }}"></script>
</body>

</html>
