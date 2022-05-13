<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
</head>
<body>
<main>
    <p>Контент.</p>
    @if (request()->has('success'))
        <p>Вы успешно зарегистрировались!</p>
    @endif
    <p><a href="/">На главную.</a></p>
    <p><a href="/auth/logout">Выйти из профиля.</a></p>
</main>
<hr>
<section>
    <p>Сайдбар.</p>
    @switch ($user->role_id)
        @case(1)
            <p><a href="/app">Заявка@empty($user->app) (еще не подана)@endempty</a></p>
            <p><a href="{{ $user->appIsVerified ? '/interview' : '#' }}">Собеседование@if($user->appIsVerified === false) (недоступно)@endif</a></p>
            @break
        @case(4)
            <p><a href="/roles">Роли</a></p>
            @break
    @endswitch
    </section>
</body>
</html>
