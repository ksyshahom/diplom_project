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
                    <input type="date" name="date" id="date" value="{{ old('date') }}" required>
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
        @foreach($schedule as $scheduleItem)
            <tr>
                <td>{{ $scheduleItem->date }}</td>
                @if($scheduleItem->hasInterview)
                    <td><a href="/schedule/{{ $scheduleItem->id }}">{{ $scheduleItem->interval->name }}</a> (занято)</td>
                @else
                    <td>{{ $scheduleItem->interval->name }}</td>
                @endif
            </tr>
        @endforeach
    </table>
</main>
</body>
</html>
