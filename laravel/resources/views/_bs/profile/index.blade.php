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
            <h1>Profile</h1>
        </div>
        <p>Dear Teacher, to conduct interviews you have to fill out the form below. Please add information about programs that you can hold interviews for. Additionally, you can add info about your alternative contacts.</p>

        <form class="row mx-20p" method="POST">
            @csrf

            @if ($errors->any())
                <div style="text-align: left;">
                    <ul class="list-group list-group-flush mb-3">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <hr>

            <div class="mb-3 row">
                <label class="col-3 col-form-label">Programs <span>*</span></label>
                <div class="col-9 mt-2">
                    @foreach($programs as $program)
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="{{ $program->id }}"
                                   name="programs[]"
                                   value="{{ $program->id }}" {{ $user->teacher->programs->contains('id', $program->id) ? ' checked' : '' }}>
                            <label class="form-check-label" for="{{ $program->id }}">{{ $program->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3 row">
                <label for="add-contacts" class="col-3 col-form-label">Additional contacts</label>
                <div class="col-9">
                    <textarea class="form-control"
                              rows="3"
                              placeholder="Discord: #1111, Telegram: +79998887766, ..."
                              id="add-contacts"
                              name="contacts">{{ old('contacts') ?: $user->teacher->contacts }}</textarea>
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
