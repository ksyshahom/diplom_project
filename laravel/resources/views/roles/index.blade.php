<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Роли</title>
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
    <p>Роли.</p>
    <table>
        <tr>
            <th>ФИО</th>
            <th>E-mail</th>
            <th>Role</th>
            <th></th>
        </tr>
        @foreach ($users as $user)
            <form method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <tr>
                    <td>{{ $user->fullName }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <select name="role_id">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"{{ ($user->role_id == $role->id) ? ' selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><button>Сохранить</button></td>
                </tr>
            </form>
        @endforeach
    </table>
</main>
</body>
</html>
