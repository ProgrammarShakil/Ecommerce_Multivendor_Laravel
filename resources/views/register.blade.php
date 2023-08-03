<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('register') }}" method="post">
        @csrf

        <div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                     {{$error}}
                @endforeach
            @endif
        </div>
        <div>
            @if(session()->has('message'))
              {{session('message')}}
            @endif
        </div>

        <label for="">Name: <input type="text" name="name" value="{{ old('name') }}"></label>

        <label for="">Email: <input type="email" name="email" value="{{ old('email') }}"></label>

        <label for="">Phone: <input type="text" name="phone" value="{{ old('phone') }}"></label>

        <label for="">Password: <input type="password" name="password"></label>

        <label for="">Confirm Password: <input type="password" name="password_confirmation"></label>

        <input type="submit" value="submit">
    </form>
</body>

</html>