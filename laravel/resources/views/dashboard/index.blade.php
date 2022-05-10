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
    <a href="/auth/logout">Выйти из профиля.</a>
</main>
</body>
</html>
