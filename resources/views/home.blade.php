<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

    @auth()
        <p> Congrats you are logged in.</p>

        <form action="/logout" method="post">
            @csrf
            <button>LOG OUT</button>
        </form>
        <div style="border: 3px solid black">
            <h2>Create a New Blog:</h2>
            <form action="/create-post" method="post">
                @csrf
                <input type="text" name="title" placeholder="post">
                <textarea name="body" placeholder="Body Content. . ."></textarea>
                <button>Save Post</button>
            </form>
        </div>

        <div style="border: 3px solid black">
            <h2>All Posts</h2>
            @foreach($posts as $post)
                <div style="border: 3px solid darkslategray; padding: 10px;margin: 5px;">
                    <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                        {{$post['body']}}
                    <p><a href="/edit-post/{{$post->id}}">Edit</a> </p>
                    <form action="/delete-post/{{$post->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

    @else

        <div style="border: 3px solid black">
            <h2>REGISTER</h2>
            <form action="/register" method="post">
                @csrf
                <input name="name" type="text" placeholder="name" >
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button type="submit">Submit</button>
            </form>
            <div style="border: 3px solid black">
                <h2>Log In</h2>
                <form action="/login" method="post">
                    @csrf
                    <input name="loginname" type="text" placeholder="name" >
                    <input name="loginpassword" type="password" placeholder="password">
                    <button type="submit">LOG IN</button>
                </form>
    @endauth


    </div>
</body>
</html>
