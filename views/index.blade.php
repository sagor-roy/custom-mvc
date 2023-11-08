<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>

    @php
        $user = \App\Base\Auth::user();
    @endphp

    <ul>
        <li>Name: {{ $user[0]['name'] }}</li>
        <li>Name: {{ $user[0]['email'] }}</li>
    </ul>

    <a href="/customer/logout">Logout</a>

    <br>
    <br>

    <img src="{{ asset('uploads/avatar.png') }}" width="50" alt="img">


    @if (!empty($_SESSION['errors']))
        <ul>
            @foreach ($_SESSION['errors'] as $attribute => $errorMessages)
                @foreach ($errorMessages as $errorMessage)
                    <li>{{ $errorMessage }}</li>
                @endforeach
            @endforeach
        </ul>
    @endif
    @php
        unset($_SESSION['errors']);
    @endphp

    <br>
    <p>
        @if (App\Base\Session::has('message'))
            {{ App\Base\Session::get('message') }}
            @php
                unset($_SESSION['message']);
            @endphp
        @endif
    </p>
    <br>

    <form action="/user/create" method="post">
        <input type="text" name="email">
        <input type="text" name="name">
        <button type="submit">Submit</button>
    </form>

    <ol>
        @foreach ($result as $value)
            <li>Name: {{ $value['name'] }}, Email: {{ $value['email'] }}
                <a href="/user/delete/{{ $value['id'] }}">Delete</a>
                <a href="/view/{{ $value['id'] }}">Edit</a>
            </li>
        @endforeach
    </ol>
</body>

</html>
