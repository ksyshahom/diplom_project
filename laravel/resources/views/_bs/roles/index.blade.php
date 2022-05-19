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
    <!-- Контент сотрудник -->

    <div class="container">

        <div class="container h1-conteiner">
            <h1>Roles</h1>
        </div>

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

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <form method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <tr>
                        <td>{{ $user->fullName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div>
                                <select class="form-select" name="role_id" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"{{ ($user->role_id == $role->id) ? ' selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="text-align: center;">
                                <button class="btn btn-all-blue mt-1">Save</button>
                            </div>
                        </td>
                    </tr>
                </form>
            @endforeach
            </tbody>
        </table>
    </div>

</main>
</body>
</html>
