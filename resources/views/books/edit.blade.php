<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goal</title>
</head>

<body>
    <p>{{ $book->recentlyCreated() ? 'Book created.' : '' }}</p>

    @include('books.form', [
        'action' => $book->path(),
        'method' => 'PUT'
    ])

    @foreach ($book->steps->sortBy('id') as $index => $step)
        <form action="{{ $step->path() }}" method="POST">
            @csrf
            @method('PUT')

            <x-forms.input
                id="step-{{ $index }}"
                name="description"
                label="توضیحات"
                type="text"
                value="{{ $step->description }}"
                require
            />

            <button type="submit">ذخیره</button>
        </form>
    @endforeach
</body>

</html>