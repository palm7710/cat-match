<?php
namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function show($id)
    {
        $cat = Cat::findOrFail($id);
        return view('cats.show', compact('cat'));
    }

    public function edit($id)
    {
        $cat = Cat::findOrFail($id);
        return view('cats.edit', compact('cat'));
    }

    public function update(Request $request, $id)
    {
        $cat = Cat::findOrFail($id);
        $cat->update($request->all());
        return redirect()->route('cats.show', $cat->id);
    }
}
