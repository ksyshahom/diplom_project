<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет</title>
</head>
<body>
<main>
    <p>Добро пожаловать!</p>
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
            <p><a href="{{ $user->appIsVerified ? '/interview' : '#' }}">Собеседования@if($user->appIsVerified === false) (недоступно)@endif</a></p>
            @break
        @case(2)
            <p><a href="/app/list">Заявки абитуриентов</a></p>
            @break
        @case(3)
            <p><a href="/profile">Профиль</a></p>
            <p><a href="/schedule">Расписание</a></p>
            @break
        @case(4)
            <p><a href="/roles">Роли</a></p>
            <p><a href="/report">Отчет по абитуриентам</a></p>
            <p><a href="/pages/1">Редактирование главной страницы</a></p>
            @break
    @endswitch
</section>
</body>
</html>
