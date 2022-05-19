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

    <!-- Хедер в лк, с разделами -->

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
                <img height="80" src="/static/img/logo-eng-small.png" alt="logo-eng">
            </a>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/app" class="nav-link px-2 color-blue">Application</a></li>
                <li><a href="/interview" class="nav-link px-2 link-dark">Interview</a></li>
            </ul>
            <div class="col-md-3 text-end">
                <a class="btn btn-border-blue me-2" href="/dashboard">Dashboard</a>
                <a class="btn btn-all-blue" href="/auth/logout">Logout</a>
            </div>
        </header>
    </div>

    <!-- Заявка -->

    <div class="container">
        <div class="container h1-conteiner">
            <h1>Application</h1>
        </div>

        <div>
            @include('_elements.app', ['app' => $application])
        </div>
        <div style="margin-bottom: 100px;"></div>
    </div>
</main>
</body>
</html>
