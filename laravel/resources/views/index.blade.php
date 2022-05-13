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
    @if (auth()->user())
        <a href="/dashboard">Войти в личный кабинет</a>
    @else
        <a href="/auth">Авторизация/Регистрация</a>
    @endif
    @if ($page)
        <p>{!! nl2br($page->content) !!}</p>
    @else
        <p>Контента нет.</p>
    @endif
</main>
</body>
</html>
