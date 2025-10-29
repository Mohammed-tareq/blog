<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Utils\ImageManegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $searchBy = request()->keyword;
        $sort_by = request()->sort_by ?? 'id';
        $order = request()->order ?? 'desc';
        $limit = request()->paginate ?? 10;
        $status = request()->status;

        $categories = Category::withCount('posts')
            ->when($searchBy, fn($q) => $q->where('name', "%" . $searchBy . "%"))
            ->when(!is_null($status), fn($q) => $q->where('status', $status))
            ->orderby($sort_by, $order)
            ->paginate($limit);


        return view('admin.category.index', compact('categories'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25|unique:categories,name',
            'status' => 'nullable|in:0,1',
        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status ?? 1,
        ]);
        noty()->success('Category Created Successfully');
        return redirect()->back();

    }


    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,'.$id,
            'status' => 'required|in:0,1',
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'status'));
        noty()->success('Category Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $category = Category::findOrfail($id);
            $posts = $category->posts()->with('images')->get();
            foreach ($posts as $post) {
                ImageManegment::deleteImagesForPost($post);
            }
            $category->delete();
            noty()->success('Category Deleted Successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            noty()->error('Something went wrong');
        }

        return redirect()->route('admin.categories.index');
    }

    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'status' => !$category->status,
        ]);
        noty()->success('Category Status Updated Successfully');
        return redirect()->back();

    }
}
