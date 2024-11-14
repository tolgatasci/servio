<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon/favicon-32x32.png?v=1.9">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="/assets/css/bootstrap.css?v=1.9">
    <!--Font Awesome css-->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css?v=1.9">
    <!--Magnific css-->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css?v=1.9">
    <!--Owl-Carousel css-->
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css?v=1.9">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css?v=1.9">
    <!--Animate css-->
    <link rel="stylesheet" href="/assets/css/animate.min.css?v=1.9">
    <!--Select2 css-->
    <link rel="stylesheet" href="/assets/css/select2.min.css?v=1.9">
    <!--Slicknav css-->
    <link rel="stylesheet" href="/assets/css/slicknav.min.css?v=1.9">
    <!--Bootstrap-Datepicker css-->
    <link rel="stylesheet" href="/assets/css/bootstrap-datepicker.min.css?v=1.9">
    <!--Jquery UI css-->
    <link rel="stylesheet" href="/assets/css/jquery-ui.min.css?v=1.9">
    <!--Perfect-Scrollbar css-->


    <style>
        /* General error styling */
        .errors {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .errors ul {
            list-style-type: none;
            padding-left: 0;
        }

        .errors li {
            margin-bottom: 5px;
        }

        /* Success message styling */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Ana Konteyner */
        .wizard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .wizard-step {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            max-width: 600px;
            width: 100%;
            text-align: center;
            background-color: #fff;

            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        /* Başlık */
        .wizard-step h3 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        /* Radio Button Stili */
        .radio-group {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            font-size: 18px;
            color: #333;
            margin-right: 20px;
            cursor: pointer;
        }

        .radio-group input[type="radio"] {
            appearance: none;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            position: relative;
        }

        /* Input alanı stili */
        .single-login-field input {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Focus olduğunda input alanı */
        .single-login-field input:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
        }

        /* Input alanının etiket stil düzenlemesi */
        .single-login-field label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            text-align: left;
            font-weight: 500;
        }

        /* Butonların stil düzenlemesi */
        button,
        x-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover,
        x-button:hover {
            background-color: #45a049;
        }

        .flex.items-center {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .radio-group input[type="radio"]:checked {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .radio-group input[type="radio"]:checked::after {
            content: '';
            width: 12px;
            height: 12px;
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* İlerleme Çubuğu */
        .progress-container {
            background-color: #f3f4f6;
            height: 8px;
            border-radius: 5px;
            margin-bottom: 30px;
            overflow: hidden;
        }



        /* Buton Stili */
        .wizard-button {
            background-color: #4CAF50; /* Yeşil arka plan */
            color: white; /* Beyaz yazı rengi */
            padding: 12px 24px; /* Yeterli dolgu */
            font-size: 18px; /* Büyük ve okunabilir yazı */
            border: none;
            border-radius: 5px; /* Köşelerin hafif yuvarlanması */
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Geçiş efektleri */
            width: 100%; /* Butonun genişliği tam olsun */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Hafif gölge */
            text-transform: uppercase; /* Yazıyı büyük harfe dönüştür */
            font-weight: bold;
        }

        .wizard-button:hover {
            background-color: #45a049; /* Hover durumunda biraz daha koyu yeşil */
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Hover durumunda gölge derinleşir */
        }

        /* Butonların hizalanması */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        /* İleri butonunun yeşil renk olması */
        .button-next {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 48%; /* Yarı genişlik */
            font-weight: bold;
        }

        /* Geri butonunun gri renkte olması */
        .button-back {
            background-color: #ccc;
            color: black;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 48%; /* Yarı genişlik */
            font-weight: bold;
        }

        /* Hover efekti */
        .button-next:hover {
            background-color: #45a049;
        }

        .button-back:hover {
            background-color: #b3b3b3;
        }

        /* Radio button stil düzenlemesi */
        .radio-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* Radio button tasarımı */
        .radio-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 18px;
        }

        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-group .custom-radio {
            width: 24px;
            height: 24px;
            border: 2px solid #ccc;
            border-radius: 50%;
            position: relative;
            margin-right: 10px;
            transition: border-color 0.3s ease;
        }

        /* Seçili olduğunda yeşil tik işareti */
        .radio-group input[type="radio"]:checked + .custom-radio {
            border-color: #4CAF50;
            background-color: #4CAF50;
        }

        .radio-group input[type="radio"]:checked + .custom-radio::after {
            content: '';
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: background-color 0.3s ease;
        }

        /* Radio buton hover efekti */
        .radio-group .custom-radio:hover {
            border-color: #45a049;
        }
        .wizard-button:active {
            background-color: #3e8e41; /* Aktif (tıklanmış) durum için daha koyu yeşil */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Gölge tekrar hafiflesin */
            transform: translateY(2px); /* Tıklanınca biraz aşağı iner */
        }
        /* Select2 için genişlik ayarı */
        .select2-container {
            width: 100% !important; /* Selectbox genişliği tam olsun */
        }

        .select2-container--default .select2-selection--single {
            height: 42px;
            display: flex;
            align-items: center;
            border: 1px solid #d1d5db; /* Daha temiz bir görünüm için sınır */
            border-radius: 5px; /* Köşeleri yuvarlat */
        }

        .select2-selection__rendered {
            font-size: 16px;
        }

        .select2-selection__arrow {
            height: 100%;
        }
    </style>
    @if(isset($style))
        {{$style}}
    @endif
    <!--Jquery js-->
    <script src="/assets/js/jquery-3.0.0.min.js?v=1.9"></script>

    <!-- Scripts -->
    @vite([
//'resources/css/app.css',
 'resources/js/app.js'])
</head>
<body>
<!-- Header Area Start -->


{{ $slot }}

</body>

<!--Popper js-->
<script src="/assets/js/popper.min.js?v=1.9"></script>
<!--Bootstrap js-->
<script src="/assets/js/bootstrap.min.js?v=1.9"></script>
<!--Bootstrap Datepicker js-->
<script src="/assets/js/bootstrap-datepicker.min.js?v=1.9"></script>
<!--Perfect Scrollbar js-->
<script src="/assets/js/jquery-perfect-scrollbar.min.js?v=1.9"></script>
<!--Owl-Carousel js-->
<script src="/assets/js/owl.carousel.min.js?v=1.9"></script>
<!--SlickNav js-->
<script src="/assets/js/jquery.slicknav.min.js?v=1.9"></script>
<!--Magnific js-->
<script src="/assets/js/jquery.magnific-popup.min.js?v=1.9"></script>
<!--Select2 js-->
<script src="/assets/js/select2.min.js?v=1.9"></script>
<!--jquery-ui js-->
<script src="/assets/js/jquery-ui.min.js?v=1.9"></script>
<!--Custom-Scrollbar js-->
<script src="/assets/js/custom-scrollbar.js?v=1.9"></script>
<!-- bootstrap datepicker -->
<!--Main js-->
<script src="/assets/js/main.js?v=1.9"></script>

<!-- Select2 ve jQuery CDN'leri -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@if (isset($script))
    {{$script}}
@endif

</html>
