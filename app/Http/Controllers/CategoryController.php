<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Hash;
use Datatables;
use Validator;

class CategoryController extends Controller
{

    public function index()
    {
        return view('categories.index', [
            'active_menu' => 'categories'
        ]);
    }


    public function datatable()
    {
        $category = Category::all();
        
        return Datatables::of($category)
            ->addColumn('action', function (Category $category) {
                return view('categories.chunk.action', [
                    'id'        => $category->id,
                    'resource'  => 'categories'
                ]);
            })
            ->editColumn('created_at', function(Category $category) {
                return $category->created_at->format(config('project.formatUI'));
            })
            ->make(true);
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $input = $request->only('name');
   
        $rules = config('validations.web.category.store');
        $this->validate($request, $rules);

		DB::transaction(function() use ($input, $request) {
        	$category = Category::create($input);
		});
  
        return response()->view('message.success', ['message' => trans('Category has been added successfully') ]);
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.update', [
            'category' => $category
        ]);
    }


    public function update(Request $request, $id)
    {
        $input = $request->only('name');
        $rules = config('validations.web.category.update');
        $rules['name'] .= ','. $id;
		$this->validate($request, $rules);
		
        $category = Category::findOrFail($id);
		DB::transaction(function() use ($category, $input, $request) {
			$category->fill($input)->save();
		});

		return response()->view('message.success', ['message' => trans('Category has been updated successfully') ]);
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->jobs()->where('category_id', $id)->count() > 0) {
            return response( trans('Can\'t remove this category, is attached to Yellow Page!'), 406 );
        }

        $category->delete();

        return trans('Category deleted successfully');
    }
}
