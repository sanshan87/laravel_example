@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="container">
            <div class="row">
                <div class="col-xl-12">{{ session()->get('success') }}</div>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <a class="btn btn-primary" href="{{ route('admin.blog.posts.create') }}">Добавить статью</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Автор</th>
                        <th>Дата публикации</th>
                    </tr>
                    @foreach($paginator as $item)
                        @php /** @var \App\Models\BlogPost $item */ @endphp
                        <tr @if(!$item->is_published)style="background:#ccc"@endif>
                            <td>{{ $item->id }}</td>
                            <td>
                                <a href="{{ route('admin.blog.posts.edit', $item->id) }}">
                                    {{ $item->title }}
                                </a>
                            </td>
                            <td>
                                {{ $item->category->title}}
                            </td>
                            <td>
                                {{ $item->user->name}}
                            </td>
                            <td>
                                {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M H:i') : '' }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <div class="row">
                <div class="col-xl-12">
                    {{ $paginator->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
