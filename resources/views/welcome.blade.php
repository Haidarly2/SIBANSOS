<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Font Bootstrap -->
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/font/') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/styles.css') }}">
</head>

<body>
    <nav class="navbar navbar-light bg-secondary bg-opacity-10 static-top">
        <div class="container">
            <a class="navbar-brand">
                SIBANSOS
            </a>
            <a href="{{ url('login') }}" class="btn btn-primary">
                Login
            </a>
        </div>
    </nav>
    <header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-white">
                        <!-- Page heading-->
                        <h1 class="mb-5">Selamat datang di web SIBANSOS</h1>
                        <!-- Signup form-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="testimonials text-center bg-light">
        <div class="container">
            <h2 class="mb-5">Tentang SIBANSOS</h2>
            <p>
                Selamat datang di SIBANSOS, platform inovatif yang dirancang khusus untuk memfasilitasi sistem administrasi RT dan RW. 
                Kami memahami betapa pentingnya efisiensi dan transparansi dalam pengelolaan administrasi dan bantuan sosial di tingkat komunitas, 
                dan itulah mengapa SIBANSOS hadir sebagai solusi terbaik untuk kebutuhan ini. 
            </p>
        </div>
    </section>
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('adminlte/dist/img/showcase-1.jpg') }}')"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Apa itu SIBANSOS?</h2>
                    <p class="lead mb-0">
                        SIBANSOS adalah sistem yang memungkinkan warga untuk dengan mudah mengajukan permohonan bantuan sosial. 
                        Platform ini juga memudahkan pengurus RT dan RW dalam mengelola dan meninjau setiap permintaan yang masuk, 
                        memastikan bahwa bantuan sosial tepat sasaran dan diberikan kepada mereka yang benar-benar membutuhkan.
                    </p>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{ asset('adminlte/dist/img/showcase-2.jpg') }}')"></div>
                <div class="col-lg-6 my-auto showcase-text">
                    <h2>Mengapa memilih SIBANSOS</h2>
                    <p class="lead mb-0">
                        SIBANSOS hadir untuk menjawab tantangan dalam pengelolaan bantuan sosial di tingkat komunitas. 
                        Kami berkomitmen untuk meningkatkan kesejahteraan warga dengan menyediakan alat yang memudahkan proses administrasi dan distribusi bantuan.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer bg-secondary bg-opacity-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                    <ul class="mb-2" style="list-style-type: none;">
                        <li class="text-black mb-1 opacity-75">Contact</li>
                        <li class="text-black opacity-50">Email: example@gmail.com</li>    
                        <li class="text-black opacity-50">Phone: (000) 0000-0000</li>  
                        <li class="text-black opacity-50">Mobile: 0000-0000-0000</li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="h-100 text-center text-lg-start my-auto">
                    <p class="text-muted small mt-3 mb-4 mb-lg-0">&copy; Your Website 2023. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>