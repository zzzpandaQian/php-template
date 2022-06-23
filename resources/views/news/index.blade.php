<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新闻列表</title>
</head>
<body>
    <ul>
        @foreach ($results as $key => $item)
        <li>
            <a href="{{ route('news.detail', $item->id) }}">
                {{ $item->title }}
            </a>
        </li>
        @endforeach
    </ul>
    {{ $results->links() }}
</body>
</html>
