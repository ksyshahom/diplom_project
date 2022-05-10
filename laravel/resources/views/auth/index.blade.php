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
@if ($errors->any())
    <section>
        <p>Ошибки:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </section>
@endif
<main>
    <p>Вход</p>
    <form method="POST" action="/auth/login">
        @csrf
        <label>E-mail<br>
            <input type="email" name="email" value="{{ old('email') }}" required><br>
        </label>
        <label>Пароль<br>
            <input type="password" name="password" value="{{ old('password') }}" required><br>
        </label>
        <button>Войти</button>
    </form>
    <br>
    <p>Регистрация</p>
    <form method="POST" action="/auth/sign-up">
        @csrf
        <label>Имя<br>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required><br>
        </label>
        <label>Фамилия<br>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required><br>
        </label>
        <label>Отчество (если есть)<br>
            <input type="text" name="middle_name" value="{{ old('middle_name') }}"><br>
        </label>
        <label>E-mail<br>
            <input type="email" name="email" value="{{ old('email') }}" required><br>
        </label>
        <label>Подтвердите e-mail<br>
            <input type="email" name="email_confirmation" value="{{ old('email_confirmation') }}" required><br>
        </label>
        <label>Пароль<br>
            <input type="password" name="password" value="{{ old('password') }}" required><br>
        </label>
        <label>Подтвердите пароль<br>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required><br>
        </label>
        <button>Зарегистрироваться</button>
    </form>
</main>
</body>
</html>
