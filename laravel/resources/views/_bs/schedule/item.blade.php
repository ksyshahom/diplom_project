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

    <div class="container">

        <div class="container h1-conteiner">
            <h1>Interview</h1>
        </div>

        <p>Date: {{ $schedule->date }}</p>
        <p>Time: {{ $schedule->interval->from }}</p>
        <p>Program: {{ $program->name }}</p>
        <p>Enrollee: {{ $enrollee->fullName }}</p>
        <p>Enrollee e-mail: <a href="mailto:{{ $enrollee->email }}" class="color-blue" target="_blank">{{ $enrollee->email }}</a></p>
        <p>Enrollee application: <a href="/app/{{ $application->id }}" class="color-blue" target="_blank">click here</a></p>
        @if ($interview->conference_link)
            <p>Link to conference: <a href="{{ $interview->conference_link }}" target="_blank">{{ $interview->conference_link }}</a></p>
        @endif
        @if ($interview->mark_value)
            <p>Mark value: {{ $interview->mark_value }}</p>
        @endif
        @if ($interview->mark_comment)
            <p>Mark comment: {{ $interview->mark_comment }}</p>
        @endif

        @if ($errors->any())
            <div style="text-align: left;">
                <ul class="list-group list-group-flush mb-3">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="row mx-20p" method="POST">
            @csrf
            <hr>
            <p><strong>Add link to conference:</strong></p>
            <div class="mb-3 row">
                <label for="conf-link" class="col-3 col-form-label">Link <span>*</span></label>
                <div class="col-9">
                    <input type="text" class="form-control" id="conf-link" name="conference_link" required
                           value="{{ old('conference_link') ?: $interview->conference_link }}">
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-5"></div>
                <button class="btn btn-all-blue col-2">Submit</button>
            </div>
            <hr>
        </form>

        <form class="row mx-20p" method="POST">
            @csrf

            <p><strong>Add mark:</strong></p>

            <div class="mb-3 row">
                <label for="mark-value" class="col-3 col-form-label">Value <span>*</span></label>
                <div class="col-3">
                    <input type="number" class="form-control" id="mark-value"
                           name="mark_value" min="0" max="100" required
                           value="{{ old('mark_value') ?: $interview->mark_value }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="mark-comment" class="col-3 col-form-label">Comment <span>*</span></label>
                <div class="col-9">
                    <textarea class="form-control"
                              rows="3"
                              id="mark-comment"
                              name="mark_comment"
                              required>{{ old('mark_comment') ?: $interview->mark_comment }}</textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-5"></div>
                <button class="btn btn-all-blue col-2">Submit</button>
            </div>

        </form>

        <div style="margin-bottom: 100px;"></div>

    </div>

</main>
</body>
</html>
