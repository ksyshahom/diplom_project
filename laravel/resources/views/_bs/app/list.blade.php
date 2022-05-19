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

    <!-- Хедер сотрудник -->

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
                <img height="80" src="/static/img/logo-eng-small.png" alt="logo-eng">
            </a>
            @include('_elements.dashboard_menu')
        </header>
    </div>
    <!-- Контент сотрудник -->

    <div class="container">

        <div class="container h1-conteiner">
            <h1>Applications</h1>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                </ul>
            @endforeach
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Link</th>
                <th width="40%">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($enrollees as $user)
                @if($user->app)
                    <form method="POST">
                        @csrf
                        <input type="hidden" name="application_id" value="{{ $user->app->id }}">
                        <tr>
                            <td>{{ $user->fullName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="/app/{{ $user->app->id }}" class="color-blue" target="_blank">Application</a>
                            </td>
                            <td>
                                <div>
                                    <select class="form-select"
                                            name="verified"{{ $user->app->verified == 1 ? ' disabled' : '' }}>
                                        <option value="0"{{ $user->app->verified == 0 ? ' selected' : '' }}>Pending</option>
                                        <option value="1"{{ $user->app->verified == 1 ? ' selected' : '' }}>Accepted</option>
                                        <option value="2"{{ $user->app->verified == 2 ? ' selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                                <br>
                                <div>
                                    <label class="form-label">Comment</label>
                                    <textarea
                                        class="form-control"
                                        rows="1"
                                        name="comment"{{ $user->app->verified == 1 ? ' disabled' : '' }}
                                    >{!! $user->app->comment !!}</textarea>
                                </div>
                                <div style="text-align: center;">
                                    <button class="btn btn-all-blue mt-1">Save</button>
                                </div>
                            </td>
                        </tr>
                    </form>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

</main>
</body>
</html>
