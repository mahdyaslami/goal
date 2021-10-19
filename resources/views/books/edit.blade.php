<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goal</title>
</head>

<body>
    <form action="/books" method="POST">
        @csrf
        @method('PUT')

        <x-forms.input 
            id="title" 
            name="title" 
            label="عنوان" 
            type="text" 
            maxlength="255" 
            value="{{ $book->title }}"
            require 
        />

        <x-forms.input
            id="page_count"
            name="page_count"
            label="تعداد صفحات"
            type="number"
            min="1"
            max="1000"
            value="{{ $book->page_count }}"
            require
        />

        <button type="submit">ذخیره</button>
        <a href="/books">انصراف</a>
    </form>
</body>

</html>