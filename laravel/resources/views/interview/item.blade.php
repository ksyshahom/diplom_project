<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Запись на собеседование</title>
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
    <p>Запись на собеседование.</p>

    <form method="GET">
        <label>Часовой пояс*<br>
            <select name="timezone" required>
                <option value>Выберите часовой пояс</option>
                @foreach ($timezones as $name => $timezone)
                    <option {{ request()->filled('timezone') && request('timezone') == $name ? ' selected' : '' }}
                            value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select><br>
        </label>
        <br>
        <button>Применить часовой пояс</button>
    </form>

    <hr>

    @if (request()->filled('timezone'))
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <table>
                @foreach($timezoneSchedule as $timezoneDate => $timezoneScheduleItems)
                    <tr>
                        <th>{{ $timezoneDate }}</th>
                        <td>
                            @foreach ($timezoneScheduleItems as $timezoneScheduleItem)
                                <label>
                                    <input value="{{ $timezoneScheduleItem['originalDate'] }}_{{ $timezoneScheduleItem['interval_id'] }}"
                                           type="radio" name="interval_id" required> {{ $timezoneScheduleItem['timezoneTime'] }}<br>
                                </label>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
            <br>
            <button>Записаться на собеседование</button>
        </form>
    @endif
</main>
</body>
</html>
