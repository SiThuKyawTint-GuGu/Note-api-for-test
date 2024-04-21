<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryApi extends Controller
{
    private function user(Request $request)
    {
        return $request->user();
    }

    public function index(Request $request)
    {
        $category = Category::where('user_id', $this->user($request)->id)->withCount('note')->latest()->get();
        return $this->success($category);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => "required"
        ]);
        if ($v->fails()) {
            return $this->error($v->errors());
        }
        $category = Category::create([
            'slug' => uniqid() . $request->name,
            'user_id' => $this->user($request)->id,
            'name' => $request->name,
        ]);
        return $this->success($category);
    }

    public function update(Request $request, $slug)
    {
        $v = Validator::make($request->all(), [
            'name' => "required",
        ]);

        if ($v->fails()) {
            return $this->error($v->errors());
        }

        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return $this->error('wrong_slug');
        }

        $category->update([
            'slug' => uniqid() . Str::slug($request->name),
            'user_id' => $this->user($request)->id,
            'name' => $request->name,
        ]);

        return $this->success($category);
    }


    public function destroy(Request $request,$id)
    {
        $category = Category::where('user_id', $this->user($request)->id)->where('slug', $id);
        if (!$category->first()) {
            return $this->error('wrong_slug');
        }
        $category->delete();
        return $this->success('success');
    }
}
