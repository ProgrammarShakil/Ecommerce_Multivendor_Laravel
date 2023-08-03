<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('login') }}" method="post">
        <div>
            @if(session()->has('message'))
            {{session('message')}}
            @endif
        </div>
        @csrf
        <label for="">Email: <input type="email" name="email"></label>
        <label for="">Password: <input type="password" name="password"></label>
        <input type="submit" value="submit">
    </form>
</body>
</html>