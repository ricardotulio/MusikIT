<?php

namespace Modules\Categories\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Categories\Entities\Category;
use Modules\Categories\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories::index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('categories::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            Category::create($request->all());
            $message = 'Category created successfully';

            return back()->with('message', $message);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories::edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CategoryRequest $request)
    {
        try {
            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->save();

            $message = 'Category was successfully updated';

            return redirect('categories')->with('message', $message);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();

            $message = 'The selected category was successfully deleted';

            return redirect('categories')->with('message', $message);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
