<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль преподавателя</title>
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
    <p>Вернуться <a href="/dashboard">в личный кабинет</a>.</p>
    <p><strong>Профиль преподавателя</strong></p>
    <form method="POST">
        @csrf
        <label>
            <p>Контактные данные:</p>
            <textarea name="contacts" cols="30" rows="10">{{ old('contacts') ?: $user->teacher->contacts }}</textarea><br>
        </label>
        <p>Направления:</p>
        @foreach($programs as $program)
            <label><input type="checkbox" {{ $user->teacher->programs->contains('id', $program->id) ? ' checked' : '' }}
                value="{{ $program->id }}" name="programs[]"> {{ $program->name }}<br></label>
        @endforeach
        <br>
        <button>Сохранить</button>
    </form>
</main>
</body>
</html>
