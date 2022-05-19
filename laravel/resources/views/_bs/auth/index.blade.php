<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./static/css/base.css">
    <link rel="icon" href="./static/img/favicon.ico">
    <link href="./static/css/signin.css" rel="stylesheet">
    <title>MISIS – English-medium Master’s Programs</title>
</head>

<body>

<!-- Хедер -->

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
            <img height="80" src="./static/img/logo-eng-small.png" alt="logo-eng">
        </a>
    </header>
</div>

<!-- Форма авторизации -->

<div class="body-div">
    <div class="form-signin text-center">
        <div style="text-align: left;">
            <ul class="list-group list-group-flush mb-3">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
        <form method="POST" action="/auth/login">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Sign in</h1>
            <div class="form-floating">
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control form-signin-fi" id="signinEmail" required>
                <label for="signinEmail">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" value="{{ old('password') }}"
                       class="form-control form-signin-li" id="signinPassword" required>
                <label for="signinPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-all-blue" type="submit">Sign in</button>
        </form>

        <!-- Форма регистрации -->

        <form method="POST" action="/auth/sign-up">
            @csrf
            <p class="h3 mb-3 mt-5 fw-normal">Sign up</p>
            <div class="form-floating">
                <input type="text" name="first_name" value="{{ old('first_name') }}"
                       class="form-control form-signin-fi" id="firstname" required>
                <label for="firstname">First name</label>
            </div>
            <div class="form-floating">
                <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                       class="form-control form-signin-mi" id="middlename" required>
                <label for="middlename">Middle name (optional)</label>
            </div>
            <div class="form-floating">
                <input type="text" name="last_name" value="{{ old('last_name') }}"
                       class="form-control form-signin-li" id="lastname" required>
                <label for="lastname">Last name</label>
            </div>
            <div class="form-floating">
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control form-signin-fi" id="signupEmail1" required>
                <label for="signupEmail1">Email address</label>
            </div>
            <div class="form-floating">
                <input type="email" name="email_confirmation" value="{{ old('email_confirmation') }}"
                       class="form-control form-signin-li" id="signupEmail2" required>
                <label for="signupEmail2">Repeat email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" value="{{ old('password') }}"
                       class="form-control form-signin-fi" id="signupPassword1" required>
                <label for="signupPassword1">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                       class="form-control form-signin-li" id="signupPassword2" required>
                <label for="signupPassword2">Repeat password</label>
            </div>
            <button class="w-100 btn btn-lg btn-all-blue" type="submit">Sign up</button>
        </form>
    </div>
</div>
@include('_elements.chat')
</body>
</html>
