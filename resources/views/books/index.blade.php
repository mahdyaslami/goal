<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goal</title>
</head>
<body>
    <a href="/books/create">کتاب جدید</a>

    <ul>
        @foreach($books as $book)
            <li>
                {{ "{$book->title}, {$book->page_count}, {$book->step_count}" }}
                <a href="{{ $book->pathToEdit() }}">edit</a>
            </li>
        @endforeach
    </ul>
</body>
</html>