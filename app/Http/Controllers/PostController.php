<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function __construct(private Post $post)
    {

    }

    public function index()
    {
        $posts = $this->post->getAllPosts();
        return Inertia::render('Post/Index', compact('posts'));
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->post->create($request->validated());
            DB::commit();
            return to_route('posts.index')->with('message', 'Post Has Been Created');
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return Inertia::render('Post/Create', ['post' => $post, 'isUpdating' => true]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        DB::beginTransaction();
        try {
            $post->update($request->validated());
            DB::commit();
            return to_route('posts.index')->with('message','Post Has Been Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        DB::beginTransaction();
        try {
            $post->delete();
            DB::commit();
            return to_route('posts.index')->with('message','Post Has Been Deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
