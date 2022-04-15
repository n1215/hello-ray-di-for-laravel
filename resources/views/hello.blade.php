<!DOCTYPE html>
<html lang="ja">
<head>
    <title>hello</title>
</head>
<body>
<h1>Hello {{ $i }}</h1>
database name: {{ $dbname }}
<p>
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
</p>
</body>
</html>
