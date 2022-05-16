<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Управление собеседованием</title>
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
    <hr>
    <p>Подробности собеседования</p>
    <table>
        <tr>
            <th>ФИО</th>
            <td>{{ $enrollee->fullName }}</td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td>{{ $enrollee->email }}</td>
        </tr>
        <tr>
            <th>Дата и время</th>
            <td>{{ $schedule->date }} {{ $schedule->interval->name }}</td>
        </tr>
        <tr>
            <th>Направление</th>
            <td>{{ $program->name }}</td>
        </tr>
        <tr>
            <th>Заявка</th>
            <td><a href="/app/{{ $application->id }}" target="_blank">Просмотреть</a></td>
        </tr>
    </table>
    <hr>
    <p>Управление собеседованием</p>
    <form method="POST">
        @csrf
        <label>
            <p>Ссылка на конференцию*:</p>
            <div>
                <input type="text" name="conference_link" required
                       value="{{ old('conference_link') ?: $interview->conference_link }}">
            </div>
        </label>
        <label>
            <p>Оценка:</p>
            <div>
                <input type="number" name="mark_value" min="0" max="100"
                       value="{{ old('mark_value') ?: $interview->mark_value }}">
            </div>
        </label>
        <label>
            <p>Комментарий к оценке:</p>
            <textarea name="mark_comment" cols="30" rows="10">{{ old('mark_comment') ?: $interview->mark_comment }}</textarea><br>
        </label>
        <br>
        <button>Сохранить</button>
    </form>
    <hr>
</main>
</body>
</html>
