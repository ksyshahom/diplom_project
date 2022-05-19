@php
    use App\Models\Program;
    use App\Models\Interview;
    use App\Models\Schedule;
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./static/css/base.css">
    <link rel="icon" href="./static/img/favicon.ico">
    <title>MISIS – English-medium Master’s Programs</title>
</head>
<body>
<main>

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
                <img height="80" src="./static/img/logo-eng-small.png" alt="logo-eng">
            </a>
            @include('_elements.dashboard_menu')
        </header>
    </div>

    <div class="container">
        <div class="container h1-conteiner">
            <h1>Report</h1>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Applicant</th>
                <th>Program</th>
                <th>Interview date</th>
                <th>Teacher name</th>
                <th>Interview took place</th>
                <th>Mark value</th>
                <th>Mark comment</th>
            </tr>
            </thead>
            <tbody>

            @foreach($enrollees as $user)
                @if($user->app && $user->app->programs->count())
                    @php
                        $firstColumn = false;
                    @endphp
                    @foreach($user->app->applicationProgram as $row)
                        @php
                            $interview = Interview::where('application_program_id', $row->id)->first();
                        @endphp
                        <tr>
                            @if ($firstColumn === false)
                                <td rowspan="3">{{ $user->fullName }}<br><a href="/app/{{ $user->app->id }}" class="color-blue" target="_blank">Application</a></td>
                                @php
                                    $firstColumn = true;
                                @endphp
                            @endif
                            <td>{{ Program::where('id', $row->program_id)->first()->name }}</td>
                            <td>{{ $interview ? $interview->schedule->date : '-' }}</td>
                            <td>{{ $interview ? $interview->schedule->teacher->user->fullName : '-' }}</td>
                            <td>{{ ($interview && $interview->isOver) ? '+' : '-' }}</td>
                            <td>{{ ($interview && $interview->mark_value) ? $interview->mark_value : '-' }}</td>
                            <td>{{ ($interview && $interview->mark_comment) ? $interview->mark_comment : '-' }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

</main>
</body>
</html>
