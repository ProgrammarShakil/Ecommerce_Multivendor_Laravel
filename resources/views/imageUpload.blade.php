<div>
    <form action="{{ route('image-upload') }}" method="POST" enctype="multipart/form-data">
        <div>
            @if (session()->has('errorMsg'))
                {{ session('errorMsg') }}
            @elseif (session()->has('success'))
                {{ session('success') }}
            @endif
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
            @endif
        </div>
        @csrf
        @method('POST')
        <input name="photo" type="file">
        <input type="submit" value="submit">
    </form>

    <div>
        @php $filePath = 'C67HSW7y4qZEDHcwDQEJrKpXfY1Xu2lU1MYfgDjA.png'; @endphp
        <img src="{{ asset('images/'. $filePath)}}" alt="photo">
        {{-- php artisan storage:link --}}

    </div>
</div>
