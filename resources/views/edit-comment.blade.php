<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comment </title>
</head>

<body>
    <h1>Edit Comment</h1>
    <form action="/edit-comment/{{ $comment->id }}" method="post">
        @csrf
        <textarea name="content" id="" cols="30" rows="5"> {{ old('content') == null ? $comment->content : old('content') }} </textarea>
        <button>Save Changes</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: red ; text-color: white">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</body>

</html>
