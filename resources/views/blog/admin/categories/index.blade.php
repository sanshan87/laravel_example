@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a class="btn btn-primary" href="{{ route('admin.blog.categories.create') }}">Добавить категорию</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Родитель</th>
                    </tr>
                    @foreach($paginator as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <a href="{{ route('admin.blog.categories.edit', $item->id) }}">
                                    {{ $item->title }}
                                </a>
                            </td>
                            <td>
                                <span
                                    @if(in_array($item->parent_id, [0, 1]))style="color:#ccc"@endif>{{ $item->parentTitle }}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
        <div class="row">
            <div class="col-xs-12">
                {{ $paginator->links() }}
            </div>
        </div>
        @endif
    </div>
@endsection
