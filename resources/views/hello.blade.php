<!DOCTYPE html>
<html lang="ja">
<head>
    <title>hello</title>
</head>
<body>
<h1>Hello {{ $i }}</h1>
<p>
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
</p>
</body>
</html>
