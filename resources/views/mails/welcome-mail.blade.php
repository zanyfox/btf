<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>Dear user {{$name}} Welcome to {{ config('app.name') }}</h1>
  <p>This is Regano service and we love that you have joined us.</p>
  <p><a href="#">Verify your email address</a></p>
  <p>Thanks,<br>
  {{ config('app.name') }}</p>
</body>
</html>
