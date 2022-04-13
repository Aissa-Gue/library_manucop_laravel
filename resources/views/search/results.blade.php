    @extends('layouts.app')
    @section('content')
        <div class="container">
            @if (Route::is('search.quick.manuSearch'))
                <div class="alert alert-primary text-center fw-bold"> نتائج البحث في الاستمارات </div>
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">عنوان الكتاب</th>
                            <th scope="col">عدد النساخ</th>
                            <th scope="col">بلد النسخ</th>
                            <th scope="col">مدينة النسخ</th>
                            <th scope="col" class="text-center">تفاصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($manuscripts as $manuscript)
                            <tr>
                                <th scope="row">{{ $manuscript->id }}</th>
                                <td>{{ $manuscript->book->title }}</td>
                                <td>{{ $manuscript->transcribers->count() }}</td>
                                <td>{{ $manuscript->country->name ?? '/' }}</td>
                                <td>{{ $manuscript->city->name ?? '/' }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> تفاصيل
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item fw-bold"
                                                    href="{{ Route('manuscripts.show', $manuscript->id) }}"><i
                                                        class="fas fa-eye text-success"></i> عرض</a></li>
                                            <li><a class="dropdown-item fw-bold"
                                                    href="{{ Route('manuscripts.edit', $manuscript->id) }}"><i
                                                        class="fas fa-pencil-alt text-primary"></i> تعديل</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if ($manuscripts->count() == 0)
                            <tr class="text-danger text-center fw-bold">
                                <td colspan="6" class="p-4"> <i class="fas fa-exclamation-triangle"></i>
                                    لا توجد نتائج مطابقة لبحثك !
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row justify-content-center fixed-bottom">
                    <div class="offset-2 col-md-auto">
                        {{ $manuscripts->links() }}
                    </div>
                </div>
            @elseif (Route::is('search.quick.transSearch'))
                <div class="alert alert-primary text-center fw-bold"> نتائج البحث في النساخ </div>
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الاسم الكامل والنسب</th>
                            <th scope="col">اللقب (اسم الشهرة)</th>
                            <th scope="col">الكنية</th>
                            <th scope="col">المدينة </th>
                            <th scope="col">البلد </th>
                            <th scope="col" class="text-center">تفاصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transcribers as $transcriber)
                            <tr>
                                <th scope="row">{{ $transcriber->id }}</th>
                                <td>{{ $transcriber->full_name .' ' .$transcriber->descent1 .' ' .$transcriber->descent2 .' ' .$transcriber->descent3 .' ' .$transcriber->descent4 .' ' .$transcriber->descent5 }}
                                </td>
                                <td>{{ $transcriber->last_name }}</td>
                                <td>{{ $transcriber->nickname }}</td>
                                <td>{{ $transcriber->country->name ?? '/' }}</td>
                                <td>{{ $transcriber->city->name ?? '/' }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> تفاصيل
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item fw-bold"
                                                    href="{{ Route('transcribers.show', $transcriber->id) }}"><i
                                                        class="fas fa-eye text-success"></i> عرض</a></li>
                                            <li><a class="dropdown-item fw-bold"
                                                    href="{{ Route('transcribers.edit', $transcriber->id) }}"><i
                                                        class="fas fa-pencil-alt text-primary"></i> تعديل</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if ($transcribers->count() == 0)
                            <tr class="text-danger text-center fw-bold">
                                <td colspan="7" class="p-4"> <i class="fas fa-exclamation-triangle"></i>
                                    لا توجد نتائج مطابقة لبحثك !
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row justify-content-center fixed-bottom">
                    <div class="offset-2 col-md-auto">
                        {{ $transcribers->links() }}
                    </div>
                </div>
            @elseif (Route::is('search.quick.bookSearch'))
                <div class="alert alert-primary text-center fw-bold"> نتائج البحث في الكتب </div>
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">العنوان</th>
                            <th scope="col">المؤلفين</th>
                            <th scope="col">عدد المنسوخات</th>
                            <th scope="col" class="text-center">تفاصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <th scope="row">{{ $book->id }}</th>
                                <td>{{ $book->title }}</td>
                                <td>
                                    @foreach ($book->authors as $author)
                                        <dd class="badge rounded-pill bg-primary mx-1 p-2 col-md-auto">
                                            {{ $author->name }}
                                        </dd>
                                    @endforeach
                                </td>
                                <td>{{ $book->manuscripts ? $book->manuscripts->count() : 0 }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> تفاصيل
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item fw-bold"
                                                    href="{{ Route('books.show', $book->id) }}"><i
                                                        class="fas fa-eye text-success"></i> عرض</a></li>
                                            <li><a class="dropdown-item fw-bold"
                                                    href="{{ Route('books.edit', $book->id) }}"><i
                                                        class="fas fa-pencil-alt text-primary"></i> تعديل</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if ($books->count() == 0)
                            <tr class="text-danger text-center fw-bold">
                                <td colspan="7" class="p-4"> <i class="fas fa-exclamation-triangle"></i>
                                    لا توجد نتائج مطابقة لبحثك !
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row justify-content-center fixed-bottom">
                    <div class="offset-2 col-md-auto">
                        {{ $books->links() }}
                    </div>
                </div>
            @endif
        </div>
    @endsection
