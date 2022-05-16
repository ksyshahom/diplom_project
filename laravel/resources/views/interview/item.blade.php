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
                @foreach($schedule as $date => $scheduleItems)
                    <tr>
                        <th>{{ $date }}</th>
                        <td>
                            @foreach ($scheduleItems as $scheduleItem)
                                <label>
                                    <input value="{{ $date }}_{{ $scheduleItem->interval_id }}"
                                           type="radio" name="interval_id" required> {{ date('H:i', $scheduleItem->start_timestamp + $timezones[request('timezone')]['offset'] - 10800) }}<br>
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
