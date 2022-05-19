<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/static/css/base.css">
    <link rel="icon" href="/static/img/favicon.ico">
    <title>MISIS – English-medium Master’s Programs</title>
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
        <p>Please book an interview time below. Please note that the time shown below in Moscow time. If you want to see it in your local time, please choose a time zone below.</p>

        @if ($errors->any())
            <section>
                <p>Errors:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </section>
        @endif

        <form>
            <div class="mb-3 row">
                <label for="timezone" class="col-2 col-form-label">Choose a time zone:</label>
                <div class="col-2">
                    <select class="form-select" id="timezone" name="timezone" required>
                        <option value>Choose...</option>
                        @foreach ($timezones as $name => $timezone)
                            <option {{ request()->filled('timezone') && request('timezone') == $name ? ' selected' : '' }}
                                    value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-all-blue col-1">Go</button>
            </div>
        </form>

        @if (request()->filled('timezone'))
            <hr>
            <form method="POST" enctype="multipart/form-data">
                @csrf
                @foreach($timezoneSchedule as $timezoneDate => $timezoneScheduleItems)
                    <div class="mb-3 row">
                        <label class="col-2 col-form-label">{{ $timezoneDate }}</label>
                        <div class="col-10">
                            @foreach ($timezoneScheduleItems as $timezoneScheduleItem)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           value="{{ $timezoneScheduleItem['originalDate'] }}_{{ $timezoneScheduleItem['interval_id'] }}"
                                           id="{{ $timezoneScheduleItem['originalDate'] }}_{{ $timezoneScheduleItem['interval_id'] }}"
                                           type="radio"
                                           name="interval_id"
                                           required>
                                    <label for="{{ $timezoneScheduleItem['originalDate'] }}_{{ $timezoneScheduleItem['interval_id'] }}"
                                           class="form-check-label">{{ $timezoneScheduleItem['timezoneTime'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <button class="btn btn-all-blue col-1">Book</button>
            </form>
        @endif

        <div style="margin-bottom: 100px;"></div>
    </div>
</main>
@include('_elements.chat')
</body>
</html>
