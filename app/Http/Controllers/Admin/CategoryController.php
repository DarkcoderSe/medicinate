<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Category;

use Toastr;

class CategoryController extends Controller
{
    public $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

     // shows the list of all categorys.
    public function index(){
        $categories = $this->category->get();
		return view('admin.category.index')->with([ 
			'categories' => $categories // sending the list to view.
		]);
    }
  
    // shows the creating a categorys page.
	public function create($parentId = null) {
        $parentCategory = null;
        $categories = $this->category->get();
        if (!is_null($parentId))
            $parentCategory = $this->category->get($parentId);

		return view('admin.category.create', compact(['parentCategory', 'categories']));
    }

    public function edit($id) {
        $categories = $this->category->get();
        $category = $this->category->get($id);
		return view('admin.category.edit')->with([
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function delete($id) {
        try {
            $this->category->delete($id);

            Toastr::success('category deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This category has some relations. Please, broke relations first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        // dd($req->all());

        $req->validate([
            'parentId' => 'nullable|string',
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        try {
            $this->category->save($req);
            Toastr::success('Category has been added successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        $req->validate([
            'parentId' => 'nullable|string',
            'name' => 'required|string',
            'slug' => 'required|string',
            'requiredCoins' => 'numeric|required',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'id' => 'required|numeric'
        ]);

        try {
            $this->category->save($req, $req->id);
            Toastr::success('Category has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }


}
