<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список заявок абитуриентов</title>
</head>
<body>
<main>
    <p>Вернуться <a href="/dashboard">в личный кабинет</a>.</p>
    <p>Список заявок абитуриентов.</p>
    <table>
        <tr>
            <th>ФИО</th>
            <th>Заявка</th>
            <th>Статус</th>
            <th>Комментарий</th>
            <td></td>
        </tr>
        @foreach($enrollees as $user)
            <form method="POST">
                @csrf
                @if($user->app)
                    <input type="hidden" name="application_id" value="{{ $user->app->id }}">
                @endif
                <tr>
                    <td>{{ $user->fullName }}</td>
                    <td>
                        <p>@if($user->app)<a href="/app/{{ $user->app->id }}" target="_blank">Ссылка</a>@elseЕще не подана@endif</p>
                    </td>
                    <td>
                        @if($user->app)
                            <select name="verified"{{ $user->app->verified == 1 ? ' disabled' : '' }}>
                                <option value="0"{{ $user->app->verified == 0 ? ' selected' : '' }}>Ожидает проверки сотрудником приемной комиссии</option>
                                <option value="1"{{ $user->app->verified == 1 ? ' selected' : '' }}>Одобрена</option>
                                <option value="2"{{ $user->app->verified == 2 ? ' selected' : '' }}>Ожидает доработки со стороны абитуриента</option>
                            </select>
                        @else
                            <p>Заявка еще не подана</p>
                        @endif
                    </td>
                    <td>
                        @if($user->app)
                            <textarea name="comment" cols="30" rows="10"{{ $user->app->verified == 1 ? ' disabled' : '' }}>{!! $user->app->comment !!}</textarea>
                        @else
                            <p>Заявка еще не подана</p>
                        @endif
                    </td>
                    <td>
                        @if($user->app)
                            <button{{ $user->app->verified == 1 ? ' disabled' : '' }}>Применить</button>
                        @endif
                    </td>
                </tr>
            </form>
        @endforeach
    </table>
</main>
</body>
</html>
