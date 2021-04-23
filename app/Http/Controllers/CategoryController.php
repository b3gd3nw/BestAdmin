<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'view' => View::make('modals.addcategory')->render()
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Category::where('name', '=', $request->name)->first())
        {
            return redirect()->back()->withError('Category exists!');
        } else {
            if (!$request->budget)
            {
                $request->budget = 0;
            }
            $request->merge(['budget' => str_replace(['$', '.', ','], ['','', '.'], $request->budget)]);
            Category::create(
                $request->all()
            );
            return redirect()->back()->withSuccess('Category was successfully added!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $data = [
            'view' => View::make('modals.editcategory')
                ->with('id', $category->id)
                ->with('budget', $category->budget)
                ->render()
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(['budget' => str_replace(['$', '.', ','], ['','', '.'], $request->budget)]);
        $data = $request->except(['_method', '_token']);
        Category::where('id', $id)->update($data);

        return redirect()->back()->withSuccess('Category was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->withSuccess('Category was successfully deleted!');
    }
}