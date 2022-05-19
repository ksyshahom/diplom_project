<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Расписание</title>
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
    <p>Добавить дату в расписание</p>
    <form method="POST">
        @csrf
        <table>
            <tr>
                <th><label for="date">Дата собеседование</label></th>
                <th>Интервалы</th>
            </tr>
            <tr>
                <td>
                    <input type="date" id="date" name="date" value="{{ old('date') }}" required>
                </td>
                <td>
                    @foreach($intervals as $interval)
                        <input type="checkbox" name="intervals[]" value="{{ $interval->id }}"> {{ $interval->name }}<br>
                    @endforeach
                </td>
            </tr>
        </table>
        <br>
        <button>Добавить в расписание</button>
    </form>
    <hr>
    <p>Расписание</p>
    <table>
        <tr>
            <th>Дата собеседование</th>
            <th>Интервалы</th>
        </tr>
        @foreach($schedule as $date => $scheduleItems)
            <tr>
                <td>{{ $date }}</td>
                <td>
                    <ul>
                        @foreach($scheduleItems as $scheduleItem)
                            @if($scheduleItem->hasInterview)
                                <li><a href="/schedule/{{ $scheduleItem->id }}">{{ $scheduleItem->interval->name }}</a> (занято)</li>
                            @else
                                <li>{{ $scheduleItem->interval->name }}</li>
                            @endif
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
</main>
</body>
</html>
