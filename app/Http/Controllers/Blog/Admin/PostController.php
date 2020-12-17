<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostStoreRequest;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Response;
use App\Http\Requests\BlogPostUpdateRequest;

class PostController extends BaseController
{
    private $postRepository;
    private $categoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->postRepository = app(BlogPostRepository::class);
        $this->categoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $paginator = $this->postRepository->getPaginator(25);

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogPost();
        $categoryList = $this->categoryRepository->getForComboBox();
        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogPostStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogPostStoreRequest $request)
    {
        $data = $request->input();

        $item = (new BlogPost())->create($data);

        if ($item) {
            return redirect()
                ->route('admin.blog.posts.edit', ['post' => $item->id])
                ->with(['success' => 'Успешно добавлено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $item = $this->postRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList = $this->categoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->postRepository->getEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>'Запись не существует'])
                ->withInput();
        }

        $data =$request->all();

        if (!isset($data['is_published'])) {
            $data['is_published'] = 0;
        }

       // dd($data);
        /*if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }

        if(empty($item->published_at) && $data['is_published']){
            $data['published_at'] = Carbon::now();
        }*/

        //$result = $item->fill($data)->save();

        $result = $item->update($data);
        if($result){
            return redirect()
                ->route('admin.blog.posts.edit', $item->id)
                ->with(['success'=>'Успешно обновлено']);
        }else{
            return back()
                ->withErrors(['msg'=>'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = BlogPost::destroy([$id]);

        if($result){
            return redirect()
                ->route('admin.blog.posts.index')
                ->with(['success'=>"Запись с id[$id] удалена"]);
        }else{
            back()->withErrors(['msg'=>'Ошибка удаления']);
        }
    }
}
