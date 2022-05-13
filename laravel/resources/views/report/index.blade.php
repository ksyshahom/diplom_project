<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отчет</title>
</head>
<body>
<main>
    <p>Вернуться <a href="/dashboard">в личный кабинет</a>.</p>
    <p>Отчет по абитуриентам</p>
    <table>
        <tr>
            <th>ФИО</th>
            <th>Заявка</th>
            <th>Направления</th>
            <th>Записи на собеседования</th>
            <th>Даты собеседований</th>
            <th>ФИО преподавателей</th>
            <th>Собеседования прошли?</th>
            <th>Баллы по итогу собеседований</th>
            <th>Комментарии преподавателей</th>
        </tr>
        @foreach($enrollees as $user)
            <tr>
                <td>{{ $user->fullName }}</td>
                <td>@if($user->app)<a href="/app/{{ $user->app->id }}" target="_blank">Ссылка</a>@elseЕще не подана@endif</td>
                <td>
                    @if($user->app && $user->app->programs->count())
                        @foreach($user->app->programs as $program)
                            <p>{{ $program->pivot->priority }}. {{ $program->name }}</p>
                        @endforeach
                    @else
                        <p>Пока не выбраны</p>
                    @endif
                </td>
                <td>@if($user->interviews->count())Существуют@elseОтсутствуют@endif</td>
                <td>
                    @if($user->interviews->count())
                        @foreach($user->interviews as $interview)
                            {{ $interview->program->name }}: {{ $interview->schedule->interval->name }}
                        @endforeach
                    @else
                        Отсутствуют
                    @endif
                </td>
                <td>
                    @if($user->interviews->count())
                        @foreach($user->interviews as $interview)
                            {{ $interview->program->name }}: {{ $interview->schedule->teacher->user->fullName }}
                        @endforeach
                    @else
                        Отсутствуют
                    @endif
                </td>
                <td>
                    @if($user->interviews->count())
                        @foreach($user->interviews as $interview)
                            {{ $interview->program->name }}: {{ $interview->isOver ? 'Прошло' : 'Еще не прошло' }}
                        @endforeach
                    @else
                        Отсутствуют
                    @endif
                </td>
                <td>
                    @if($user->interviews->count())
                        @foreach($user->interviews as $interview)
                            {{ $interview->program->name }}: {{ $interview->mark_value }}
                        @endforeach
                    @else
                        Отсутствуют
                    @endif
                </td>
                <td>
                    @if($user->interviews->count())
                        @foreach($user->interviews as $interview)
                            {{ $interview->program->name }}: {{ $interview->mark_comment }}
                        @endforeach
                    @else
                        Отсутствуют
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</main>
</body>
</html>
