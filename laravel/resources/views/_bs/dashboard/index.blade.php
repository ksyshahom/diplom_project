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

    <!-- Хедер сотрудник -->

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
                <img height="80" src="./static/img/logo-eng-small.png" alt="logo-eng">
            </a>
            @include('_elements.dashboard_menu')
        </header>
    </div>

    <!-- Контент сотрудник -->

    <div class="container">
        @switch ($user->role_id)
            @case(1)
                <div class="container h1-conteiner">
                    <h1>Steps to Enroll</h1>
                </div>
                <p>Dear Prospective Student!</p>
                <p>The following are the major 10 steps an international candidate should take to get enrolled to a NUST MISIS full-time International Master’s Program:</p>
                <p><strong>Step 1</strong></p>
                <p>Choose a <a class="color-blue" target="_blank" href="https://en.misis.ru/academics/masters-english/">program of study</a> you would like to pursue at NUST MISIS. Please check the following webpage: <a class="color-blue" target="_blank" href="https://en.misis.ru/applicants/master-programs/tuition/">Tuition &amp; Fees</a>.</p>
                <p><strong>Step 2</strong></p>
                <p>Complete the <a class="color-blue" target="_blank" href="/app">application</a>. See the <a class="color-blue" target="_blank" href="https://en.misis.ru/applicants/master-programs/documents/">list of documents</a> you will need to complete and submit the application. The application deadline for Fall 2022 is August 8, 2022. However, all international students are strongly encouraged to apply by July 19, 2022 due to longer documents processing international students might encounter.</p>
                <p><strong>Step 3</strong></p>
                <p>After you’ve uploaded the required documents online, it is going to be checked by the uni staff. Then you might need to correct some information. When your application is accepted, you may proceed to <a class="color-blue" target="_blank" href="/interview">sign up for the interview</a>.</p>
                <p><strong>Step 4</strong></p>
                <p>...</p>
                @break
            @case(2)
                <div class="container h1-conteiner">
                    <h1>Welcome to the platform</h1>
                </div>
                <p>Dear Admissions Officer!</p>
                <p>To start working with the platform, please choose a section from the menu above.</p>
                @break
            @case(3)
                <div class="container h1-conteiner">
                    <h1>Welcome to the platform</h1>
                </div>
                <p>Dear Teacher!</p>
                <p>To start working with the platform, please <a class="color-blue" href="/profile">add information</a> about programs that you can hold interviews for. Additionally, you can add info about your alternative contacts.</p>
                <p>After adding your info, please proceed to <a class="color-blue" href="/schedule">submit your schedule</a> for enrollees to book their interviews.</p>
                @break
            @case(4)
                <div class="container h1-conteiner">
                    <h1>Welcome to the platform</h1>
                </div>
                <p>Dear Admin!</p>
                <p>To start working with the platform, please choose a section from the menu above.</p>
                @break
        @endswitch
    </div>

</main>
</body>
</html>
