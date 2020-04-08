<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('plugin.plugin')
</head>
<body>
    <center class="mt-5">
        <a href="logout">
            <button class="btn btn-lg btn-info">Logout</button>
        </a>
    </center>
    {{$data['user_code']}}
    {{$data['valid_until']}}
</body>
</html>