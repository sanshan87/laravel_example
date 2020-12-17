@extends('layouts.app')

@section('content')
    @php
        /**
            * @var \App\Models\BlogCategory $item
        */
    @endphp
    @if($item->exists)

        <form method="POST" action="{{ route('admin.blog.categories.update', $item->id) }}">
            @method('PATCH');

            @else
                <form method="POST" action="{{ route('admin.blog.categories.store') }}">
                    @endif

                    @csrf
                    <div class="container">
                        @php /** @var \Illuminate\Support\ViewErrorBag $errors */ @endphp
                        @if($errors->any())
                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" area-label="close">
                                            <span area-hidden="true">x</span>
                                        </button>
                                        {{ $errors->first() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" area-label="close">
                                            <span area-hidden="true">x</span>
                                        </button>
                                        {{ session()->get('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title"
                                           name="title"
                                           value="{{ $item->title }}"
                                           required
                                           class="form-control"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="slug">URL</label>
                                    <input type="text" id="slug" name="slug" class="form-control"
                                           value="{{ $item->slug }}"
                                           >
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Род. категория</label>
                                    <select id="parent_id" name="parent_id" class="form-control">
                                        @foreach($categoryList as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($item->parent_id == $category->id) selected @endif>{{ $category->id_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea id="description" name="description" class="form-control"
                                              rows="3">{{ old('description', $item->description) }}</textarea>
                                </div>
                            </div>
                            @if($item->exists)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="created_at">Создано</label>
                                    <input type="text" id="created_at"
                                           name="created_at"
                                           value="{{ $item->created_at }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="updated_at">Обновлено</label>
                                    <input type="text" id="updated_at"
                                           name="updated_at"
                                           value="{{ $item->updated_at }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="deleted_at">Удалено</label>
                                    <input type="text" id="deleted_at"
                                           name="deleted_at"
                                           value="{{ $item->deleted_at }}" class="form-control" disabled>
                                </div>

                            </div>
                            @endif
                            <div class="col-xl-12">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </div>
                    </div>
                </form>
@endsection
