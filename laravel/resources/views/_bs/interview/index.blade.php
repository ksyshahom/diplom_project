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

    <!-- Хедер в лк, с разделами -->

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
            <h1>Interviews</h1>
        </div>
        <p>Please book an interview for selected programs below. You can choose one, two or three programs take an interview at. After applying for an interview full info will be available below.</p>
        <p>Notice that time of interviews is in Moscow time. If you want to see it in your local time, please choose a time zone below.</p>

        <form>
            <div class="mb-3 row">
                <label for="timezone" class="col-2 col-form-label">Choose a time zone:</label>
                <div class="col-3">
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
            @foreach($applicationProgramRows as $applicationProgramRow)

                <hr>
                <p><strong>Program: {{ $programs[$applicationProgramRow->program_id]['name'] }}</strong></p>

                @if(isset($interviews[$applicationProgramRow->id]))
                    @php
                        $timestamp = $interviews[$applicationProgramRow->id]->schedule->start_timestamp + $timezones[request('timezone')]['offset'] - 10800;
                        $teacherEmail = $interviews[$applicationProgramRow->id]->schedule->teacher->user->email;
                    @endphp
                    <p>Date: {{ date('Y-m-d', $timestamp) }}</p>
                    <p>Time: {{ date('H:i', $timestamp) }}</p>
                    <p>Teacher: {{ $interviews[$applicationProgramRow->id]->schedule->teacher->user->fullName }}</p>
                    <p>Teacher e-mail: <a class="color-blue"
                                          href="{{ $teacherEmail }}"
                                          target="_blank">{{ $teacherEmail }}</a></p>
                    @if($interviews[$applicationProgramRow->id]->schedule->teacher->contacts)
                        <p>Teacher additional contacts: {!! nl2br($interviews[$applicationProgramRow->id]->schedule->teacher->contacts) !!}</p>
                    @endif
                    @if($interviews[$applicationProgramRow->id]->conference_link)
                        <p>Link to conference: <a class="color-blue"
                                                  href="{{ $interviews[$applicationProgramRow->id]->conference_link }}"
                                                  target="_blank">{{ $interviews[$applicationProgramRow->id]->conference_link }}</a></p>
                    @endif
                    @if($interviews[$applicationProgramRow->id]->schedule->start_timestamp > time())
                        <a class="btn btn-all-blue" href="/interview/{{ $applicationProgramRow->program_id }}/cancel">Cancel the interwiew</a>
                    @endif
                @else
                    <a class="btn btn-all-blue"
                       href="/interview/{{ $applicationProgramRow->program_id }}?timezone={{ rawurlencode(request('timezone')) }}"
                       target="_blank">Book an interwiew</a>
                @endif

            @endforeach
        @endif

        <div style="margin-bottom: 100px;"></div>

    </div>
</main>
@include('_elements.chat')
</body>
</html>
