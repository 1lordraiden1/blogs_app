<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
    @auth

        <p> Hello {{ auth()->user()->name }} </p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log out</button>
        </form>

        <div style="border: 3px solid black">
            <h2>Create a New post</h2>
            <form action="/create-post" method="post">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="body" id="" cols="20" rows="5" placeholder="body content..."></textarea>
                <button>Save Post</button>
            </form>
        </div>

        <div style="border: 3px solid black">
            <h2>My Posts</h2>
            @foreach ($myPosts as $post)
                <div style="background-color: gray; padding: 10px; margin: 10px;">
                    <h3> {{ $post['title'] }} </h3>
                    <h5> {{ $post['body'] }} </h5>
                </div>
                <p><a href="/edit-post/{{ $post->post_id }}">Edit</a></p>
                <form action="/delete-post/{{ $post->post_id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            @endforeach

        </div>

        <div style="border: 3px solid black">
            <h2>All Posts</h2>
            @foreach ($posts as $post)
                <div style="background-color: gray; padding: 10px; margin: 10px;">
                    <h3> {{ $post['title'] }} </h3>
                    <h5> {{ $post['body'] }} </h5>
                </div>
            @endforeach

        </div>
    @else
        <div style="border: 3px solid black">
            <h2>Register</h2>
            <form action='/register' method="POST">
                @csrf

                <input name="name" type="text" placeholder="name">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button type="submit">Register</button>
            </form>
        </div>
        <div style="border: 3px solid black">
            <h2>Login</h2>
            <form action='/login' method="POST">
                @csrf
                <input name="loginname" type="text" placeholder="name">
                <input name="loginpassword" type="password" placeholder="password">
                <button type="submit">Login</button>
            </form>
        </div>

        {{-- Errors --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


    @endauth


</body>

</html>
