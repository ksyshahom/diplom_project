<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/static/css/base.css">
    <link rel="icon" href="/static/img/favicon.ico">
    <title>MISIS – English-medium Master’s Programs</title>
    <style type="text/css">
        span {
            color: red;
        }
    </style>
</head>
<body>
<main>

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
                <img height="80" src="/static/img/logo-eng-small.png" alt="logo-eng">
            </a>
            @include('_elements.dashboard_menu')
        </header>
    </div>

    <!-- Контент препод -->

    <div class="container">
        <div class="container h1-conteiner">
            <h1>Main page content</h1>
        </div>

        <form method="POST">
            @csrf
            <input type="hidden" name="page_id" value="{{ $page->id }}">

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

            <div class="mb-3">
                <textarea class="form-control" rows="10" id="add-contacts" name="page_content">{!! $page->content !!}</textarea>
            </div>

            <div class="row mt-3">
                <div class="col-5"></div>
                <button class="btn btn-all-blue col-2">Save</button>
            </div>
        </form>

    </div>

</main>
</body>
</html>
