<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Расписание ДО</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!--  Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <!--  Animate.css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!--  Custom CSS  -->
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <a id="logo" href="/"></a>

            <div class="navbar-nav m-auto mb-lg-0">
                <form class="d-flex" method="POST" action="{{ route('login') }}">
                    @csrf
                    <input id="email"
                           type="email"
                           class="form-control me-2 @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Email"
                           required
                           autocomplete="email"
                           autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="password"
                           type="password"
                           class="form-control me-2 @error('password') is-invalid @enderror"
                           name="password"
                           placeholder="Пароль"
                           required
                           autocomplete="текущий пароль">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>

            <div id="info" class="navbar-nav">
                <div id="info-button"></div>
                <div id="info-modal">
                    <h1 class="mb-3 text-center">Система расписания дистанционного обучения УдГУ</h1>
                    <p>Разработана сотрудниками <a href="https://udsu.ru/chapters/departments/tsentr-formirovaniya-kontingenta-i-novyh-obrazovatelnyh-tehnologij" target="_blank">ЦФКиНОТ</a> и <a href="https://d-itt.udsu.ru/" target="_blank">Управления информационных технологий и телекоммуникаций</a> УдГУ</p>
                    <h2 class="text-center mt-4 mb-3">Команда разработки</h2>
                    <ul>
                        <li>Иван Новоструев</li>
                        <li>Игорь Бочкарёв</li>
                        <li>Александр Арзамасцев</li>
                        <li>Александр Вичужанин</li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <!-- jQuery 3.6.0 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Custom JS -->
    <script src="/js/login.js"></script>
</body>
</html>
