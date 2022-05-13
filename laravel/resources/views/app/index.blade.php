<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Подача заявки</title>
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
    <p>Подача заявки</p>
    @if ($user->app && $user->app->verified == 0)
        <p>Заявки находится на рассмотрении.</p>
        <p><a href="/dashboard">Вернуться в личный кабинет.</a></p>
    @elseif ($user->app && $user->app->verified == 1)
        <p>Заявка рассмотрена. Можно <a href="/interview">записываться на собеседование</a>.</p>
    @else
        @if($user->app && $user->app->verified == 2)
            <p>Заявка отклонена. Комментарий:</p>
            <p>{!! $user->app->comment !!}</p>
            <hr>
        @endif
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <label>Имя*<br>
                <input type="text" name="first_name"
                       value="{{ old('first_name') ?: $user->first_name }}" required><br>
            </label>
            <label>Фамилия*<br>
                <input type="text" name="last_name"
                       value="{{ old('last_name') ?: $user->last_name }}" required><br>
            </label>
            <label>Отчество (если есть)<br>
                <input type="text" name="middle_name"
                       value="{{ old('middle_name') ?: $user->middle_name }}"><br>
            </label>
            <hr>
            ...
            <hr>
            <label>Nationality*<br>
                <input type="text" name="nationality" value="{{ old('nationality') }}" required><br>
            </label>
            <hr>
            <label>Desired Program of Study (first priority)*<br>
                <select name="program_01" required>
                    <option value>Выберите программу</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select><br>
            </label>
            <label>Desired Program of Study (second priority)*<br>
                <select name="program_02" required>
                    <option value>Выберите программу</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select><br>
            </label>
            <label>Desired Program of Study (third priority)*<br>
                <select name="program_03" required>
                    <option value>Выберите программу</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select><br>
            </label>
            <hr>
            ...
            <hr>
            <label>A color passport-style photo<br>
                <input type="file" name="photo" value="{{ old('photo') }}"
                       accept="image/jpeg,image/png"><br>
            </label>
            <hr>
            ...
            <hr>
            <label>Bachelor or previous educational diploma scan*<br>
                <input type="file" name="diploma" value="{{ old('diploma') }}"
                       accept="application/pdf" required><br>
            </label>
            <hr>
            ...
            <hr>
            <br>
            <button>Подать заявку</button>
        </form>
    @endif
</main>
</body>
</html>
