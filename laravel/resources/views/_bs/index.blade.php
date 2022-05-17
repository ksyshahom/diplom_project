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
            @if (auth()->user())
                <div class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
                    <img height="80" src="./static/img/logo-eng-small.png" alt="logo-eng">
                </div>
                <div class="col-md-3 text-end">
                    <a class="btn btn-border-blue me-2" href="/dashboard">Dashboard</a>
                    <a class="btn btn-all-blue" href="/auth/logout">Logout</a>
                </div>
            @else
                <div class="d-flex align-items-center col-md-3 mb-2 mb-md-0">
                    <img height="80" src="./static/img/logo-eng-small.png" alt="logo-eng">
                </div>
                <div class="col-md-3 text-end">
                    <a class="btn btn-all-blue" href="/auth">Login/Sign-up</a>
                </div>
            @endif
        </header>
    </div>

    <div class="container">
        @if ($page)
            <p>{!! $page->content !!}</p>
        @else
            <p>No content here.</p>
        @endif
    </div>

</main>

<script>
    window.replainSettings = { id: '2caa3d67-9a53-4f42-b060-1f0c367b542e' };
    (function(u){var s=document.createElement('script');s.async=true;s.src=u;
        var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
    })('https://widget.replain.cc/dist/client.js');
</script>

</body>
</html>
