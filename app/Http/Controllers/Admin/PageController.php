<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::latest();

        if (!empty($request->get('keyword'))) {
            $pages = $pages->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $pages = $pages->paginate(10);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:pages',
        ]);

        if ($validator->passes()) {
            $page = new Page();
            $page->name = $request->name;
            $page->slug = $request->slug;
            $page->content = $request->content;
            $page->status = $request->status;
            $page->save();

            $request->session()->flash('success', 'New page added successfully.');

            return response()->json([
                'status' => true,
                'message' => "New page added successfully."
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, string $id)
    {
        $page = Page::find($id);

        if(empty($page)){
            $request->session()->flash('error', 'Record not found.');
            return redirect()->route('pages.index');
        }

        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, string $id)
    {
        $page = Page::find($id);

        if (empty($page)) {
            $request->session()->flash('error', 'Record not found.');
            return redirect()->route('pages.index');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:pages,slug,'.$page->id.',id',
        ]);

        if ($validator->passes()) {
            $page->name = $request->name;
            $page->slug = $request->slug;
            $page->content = $request->content;
            $page->status = $request->status;
            $page->save();

            $request->session()->flash('success', 'Page updated successfully.');

            return response()->json([
                'status' => true,
                'message' => "Page updated successfully."
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(Request $request, string $id)
    {
        $page = Page::find($id);

        if (empty($page)) {
            $request->session()->flash('error', 'Record not found.');
            return redirect()->route('pages.index');
        }

        $page->delete();
 
        $request->session()->flash('success', 'Page deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => "Page deleted successfully."
        ]);
    }
}
