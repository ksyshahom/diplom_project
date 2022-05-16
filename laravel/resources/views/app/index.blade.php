<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заявка</title>
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
    <p><a href="/dashboard">Вернуться в личный кабинет.</a></p>
    @if($user->app)
        @switch ($user->app->verified)
            @case(0)
                <p>Статус: Заявка находится на рассмотрении.</p>
                @break
            @case(1)
                <p>Статус: Заявка рассмотрена. Можно <a href="/interview">записаться на собеседование</a>.</p>
                @break
            @case(1)
                <p>Статус: Заявка отклонена. Комментарий:</p>
                <p>{!! $user->app->comment !!}</p>
                @break
        @endswitch
    @else
        <p>Отправить новую заявку.</p>
    @endif
    <p>Заявка:</p>
    <hr>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <label>Имя*<br>
            <input type="text" name="first_name" required
                   value="{{ old('first_name') ?: ($user->app ? $user->app->data['first_name'] : $user->first_name) }}"><br>
        </label>
        <label>Фамилия*<br>
            <input type="text" name="last_name" required
                   value="{{ old('last_name') ?: ($user->app ? $user->app->data['last_name'] : $user->last_name) }}"><br>
        </label>
        <label>Отчество (если есть)<br>
            <input type="text" name="middle_name"
                   value="{{ old('middle_name') ?: ($user->app ? $user->app->data['middle_name'] : $user->middle_name) }}"><br>
        </label>
        <hr>
        ...
        <hr>
        <label>Nationality*<br>
            <input type="text" name="nationality" required
                   value="{{ old('nationality') ?: ($user->app ? $user->app->data['nationality'] : '') }}"><br>
        </label>
        <hr>
        <label>Desired Program of Study (first priority)*<br>
            <select name="program_01" required>
                <option value>Выберите программу</option>
                @foreach ($programs as $program)
                    <option {{ (old('program_01') == $program->id || ($user->app && $user->app->data['program_01'] == $program->id)) ? ' selected ' : '' }}
                        value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select><br>
        </label>
        <label>Desired Program of Study (second priority)*<br>
            <select name="program_02" required>
                <option value>Выберите программу</option>
                @foreach ($programs as $program)
                    <option {{ (old('program_02') == $program->id || ($user->app && $user->app->data['program_02'] == $program->id)) ? ' selected ' : '' }}
                        value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select><br>
        </label>
        <label>Desired Program of Study (third priority)*<br>
            <select name="program_03" required>
                <option value>Выберите программу</option>
                @foreach ($programs as $program)
                    <option
                        {{ (old('program_03') == $program->id || ($user->app && $user->app->data['program_03'] == $program->id)) ? ' selected ' : '' }}
                        value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select><br>
        </label>
        <hr>
        ...
        <hr>
        <label>A color passport-style photo<br>
            @if($user->app && isset($user->app->data['photo']))
                <div>
                    <p>Ранее загруженное:</p>
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['photo']) }}" alt="" width="200">
                    <input type="hidden" name="photo_old" value="{{ $user->app->data['photo'] }}">
                </div>
            @endif
            <input type="file" name="photo" value="{{ old('photo') }}"
                   accept="image/jpeg,image/png"><br>
        </label>
        <hr>
        ...
        <hr>
        <label>Bachelor or previous educational diploma scan*<br>
            @if($user->app)
                <div>
                    <p>Ранее загруженное: <a href="{{ \Illuminate\Support\Facades\Storage::url($user->app->data['diploma']) }}" target="_blank">просмотреть</a>.</p>
                    <input type="hidden" name="diploma_old" value="{{ $user->app->data['diploma'] }}">
                </div>
            @endif
            <input type="file" name="diploma" value="{{ old('diploma') }}"
                   accept="application/pdf"><br>
        </label>
        <hr>
        ...
        <hr>
        <br>
        @if(is_null($user->app) || $user->app->verified == 2)
            <button>Подать заявку{{ $user->app ? ' повторно' : '' }}</button>
        @else
            <p>Заявку подать невозможно, т.к. она принята, либо ожидает проверки.</p>
            <p><a href="/app/delete">Удалить заявку.</a></p>
        @endif
    </form>
</main>
</body>
</html>
