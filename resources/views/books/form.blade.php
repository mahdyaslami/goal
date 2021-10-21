<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method == 'PUT')
        @method('PUT')
    @endif

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

    <x-forms.input
        id="step_count"
        name="step_count"
        label="تعداد گام ها"
        type="number"
        min="1"
        max="100"
        value="{{ $book->step_count }}"
        require
    />

    <button type="submit">ذخیره</button>
    <a href="/books">انصراف</a>
</form>