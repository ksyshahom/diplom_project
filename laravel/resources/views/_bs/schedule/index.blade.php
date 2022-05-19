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
            <h1>Schedule</h1>
        </div>
        <p>Dear Teacher, below you can see your schedule and interviews (in blue). To see full information about an interview just click on it. To add more intervals to your schedule please fill out the form under the schedule.</p>

        <div class="mx-20p">
            <hr>
            <p><strong>Schedule</strong></p>
            @foreach($schedule as $date => $scheduleItems)
                <div class="row mb-3">
                    <p class="col-3 col-form-label">{{ $date }}</p>
                    <div class="col-9">
                        @foreach($scheduleItems as $scheduleItem)
                            @if($scheduleItem->hasInterview)
                                <p style="margin-bottom: 0;">
                                    <a class="color-blue"
                                       href="/schedule/{{ $scheduleItem->id }}"
                                       target="_blank">{{ $scheduleItem->interval->name }}</a>
                                </p>
                            @else
                                <p style="margin-bottom: 0;">{{ $scheduleItem->interval->name }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <form class="row mx-20p" method="POST">
            @csrf
            <hr>
            <p><strong>Add more intervals:</strong></p>

            @if ($errors->any())
                <div style="text-align: left;">
                    <ul class="list-group list-group-flush mb-3">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3 row">
                <label for="sch_date" class="col-3 col-form-label">Date</label>
                <div class="col-9">
                    <input type="date" class="form-control" id="sch_date"
                           name="date" value="{{ old('date') }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-3 col-form-label">Intervals</label>
                <div class="col-9 mt-2">
                    @foreach($intervals as $interval)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="{{ $interval->id }}"
                                   name="intervals[]" value="{{ $interval->id }}">
                            <label class="form-check-label" for="{{ $interval->id }}">{{ $interval->name }}</label>
                        </div>
                    @endforeach
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
