<?php

namespace App\Repository;

use App\Models\Category as Cat;

class Category 
{
    public function get($id = null)
    {
        $categories = Cat::all();
        if(!is_null($id))
            $categories = Cat::find($id);

        return $categories;
    }

    public function save($request, $id = null) 
    {
        if (is_null($id)) 
            $category = new Cat;
        else 
            $category = Cat::find($id);

        if (!is_null($request->parentId))
            $category->parent_id = $request->parentId;

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->required_coins = $request->requiredCoins;
        $category->status = $request->status == 'on' ? 1 : 0;
        $category->description = $request->description;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $name = 'cat_' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/images/categories');
            $image->move($destinationPath, $name);
            $category->image = $name;   
        }

        $category->save();

        return $category;
    }

    public function delete($id)
    {
        Cat::destroy($id);
    }
    
}