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
    <form action="/edit-post/{{ $post->post_id }}" method="post">
        @csrf

        <input type="text" name="title" value="{{ old('title') == null ? $post->title : old('title') }}"
            class="@error('title') is-invalid @enderror">
        <textarea name="body" id="" cols="30" rows="5"> {{ $post->body }} </textarea>
        <button>Save Changes</button>
    </form>
    @error('title')
        <div style="background-color: red">{{ $message }}</div>
    @enderror

</body>

</html>
