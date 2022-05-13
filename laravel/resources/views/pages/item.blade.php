<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование страницы</title>
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
    <p>Редактирование страницы.</p>
    <form method="POST">
        @csrf
        <input type="hidden" name="page_id" value="{{ $page->id }}">
        <label>
            <p>Контент</p>
            <textarea name="page_content" cols="30" rows="10">{!! $page->content !!}</textarea><br>
        </label>
        <button>Сохранить</button>
    </form>
</main>
</body>
</html>
