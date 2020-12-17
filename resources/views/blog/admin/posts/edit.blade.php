@extends('layouts.app')

@section('content')
    @php
        /**
            * @var \App\Models\BlogPost $item
        */
    @endphp
    @if($item->exists)
        <form method="POST" action="{{ route('admin.blog.posts.update', $item->id) }}">
        @method('PATCH');
    @else
        <form method="POST" action="{{ route('admin.blog.posts.store') }}">
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
                        <div class="col-xl-12">
                        @if($item->is_published)
                        Опубликовано
                        @else
                        Не опубликовано
                        @endif
                        </div>
                </div>
                   <div class="row">
                       <div class="col-md-8">
                           <ul class="nav nav-tabs">

                               <li class="nav-item">
                                   <a class="nav-link active" data-toggle="tab" href="#description">Основные данные</a>
                               </li>

                               <li class="nav-item">
                                   <a class="nav-link" data-toggle="tab" href="#characteristics">Другие данные</a>
                               </li>

                           </ul>
                           <div class="tab-content">
                               <div class="tab-pane fade show active" id="description">
                                   <div class="form-group">
                                       <label for="title">Заголовок</label>
                                       <input type="text" id="title"
                                              name="title"
                                              value="{{ $item->title }}"
                                              required
                                              class="form-control">
                                   </div>
                                   <div class="form-group">
                                       <label for="content_raw">Описание</label>
                                       <textarea id="content_raw" name="content_raw" class="form-control"
                                                 rows="15">{{ old('content_raw', $item->content_raw) }}</textarea>
                                   </div>
                               </div>

                               <div class="tab-pane fade" id="characteristics">
                                   <div class="form-group">
                                       <label for="category_id">Категория</label>
                                       <select id="category_id" name="category_id" class="form-control">
                                           @foreach($categoryList as $category)
                                               <option value="{{ $category->id }}"
                                                       @if($item->category_id == $category->id) selected @endif>{{ $category->id_title }}</option>
                                           @endforeach
                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label for="slug">URL</label>
                                       <input type="text" id="slug" name="slug" class="form-control"
                                              value="{{ $item->slug }}"
                                              >
                                   </div>
                                   <div class="form-group">
                                       <label for="excerpt">Выдержка</label>
                                       <textarea id="excerpt" name="excerpt" class="form-control"
                                                 rows="4">{{ old('excerpt', $item->excerpt) }}</textarea>
                                   </div>
                                   <div class="form-group">
                                       <label for="is_published">Опубликовано</label>
                                       <input id="is_published" type="checkbox" name="is_published" value="1"
                                       @if($item->is_published)
                                       checked
                                           @endif>
                                   </div>

                               </div>

                           </div>

                       </div>
                       <div class="col-md-4">
                           <button type="submit" class="btn btn-primary">Сохранить</button>
                       @if($item->exists)

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
                                   <label for="published_at">Опубликовано</label>
                                   <input type="text" id="published_at"
                                          name="published_at"
                                          value="{{ $item->published_at }}" class="form-control" disabled>
                               </div>


                       @endif
                       </div>

                   </div>

                </div>
        </form>
            @if($item->exists)
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <form method="POST" action="{{ route('admin.blog.posts.destroy', $item->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
@endsection

