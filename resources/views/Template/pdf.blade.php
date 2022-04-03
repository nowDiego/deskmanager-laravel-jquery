<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <p>{{$data}}</p>
    <p>{{$now}}</p>
    @foreach ($called as $item)
    <p> {{
        $item->protocol 
    }}</p>
        
    @endforeach
</body>
</html>