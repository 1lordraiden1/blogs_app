<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
</head>

<body>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{ $post->id }}" method="post">
        @csrf

        <input type="text" name="title" value="{{ old('title') == null ? $post->title : old('title') }}">
        <textarea name="body" id="" cols="30" rows="5"> {{ old('body') == null ? $post->body : old('body') }} </textarea>
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
