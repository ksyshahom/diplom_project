<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Собеседования</title>
</head>
<body>
<main>
    <p><a href="/dashboard">Вернуться в личный кабинет.</a></p>
    <p>Собеседования.</p>
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
        @foreach($applicationProgramRows as $applicationProgramRow)
            <p>Программа: {{ $programs[$applicationProgramRow->program_id]['name'] }}</p>
            @if(isset($interviews[$applicationProgramRow->id]))
                <ul>
                    <li>Date: {{ $interviews[$applicationProgramRow->id]->schedule->date }}</li>
                    <li>Time: {{ $interviews[$applicationProgramRow->id]->schedule->interval->from }}</li>
                    <li>Teacher: {{ $interviews[$applicationProgramRow->id]->schedule->teacher->user->fullName }}</li>
                    <li>Teacher e-mail: {{ $interviews[$applicationProgramRow->id]->schedule->teacher->user->email }}</li>
                    @if($interviews[$applicationProgramRow->id]->schedule->teacher->contacts)
                        <li>
                            <p>Teacher additional contacts:</p>
                            {!! nl2br($interviews[$applicationProgramRow->id]->schedule->teacher->contacts) !!}
                        </li>
                    @endif
                    @if($interviews[$applicationProgramRow->id]->conference_link)
                        <li>Link to conference: <a href="{{ $interviews[$applicationProgramRow->id]->conference_link }}" target="_blank">{{ $interviews[$applicationProgramRow->id]->conference_link }}</a></li>
                    @endif
                </ul>
            @else
                <a href="/interview/{{ $applicationProgramRow->program_id }}?timezone={{ rawurlencode(request('timezone')) }}"
                   target="_blank">Записаться на интервью</a>
            @endif
            <hr>
        @endforeach
    @endif
</main>
</body>
</html>
