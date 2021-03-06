<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

  public function index() {
    $post = Category::all();
    return response() -> json($post);
  }

  public function getCategory(Request $request, $id) {
    $item = Category::find($id);
    return response() -> json($item);
  }

  public function create(Request $request) {
    $this -> validate($request, [
      'title' => 'required'
    ]);
    $newPost = Category::create($request->all());
    if ($newPost) {
      return response() -> json([
        'status' => 'success',
        'newElementId' => $newPost
      ]);
    } else {
      return response()->json(['status' => 'fail']);
    }
  }

  public function remove(Request $request, $id) {
    $item = Category::find($id);
    $item -> delete();
    return response() -> json('Item with ' . $id . ' removed');
  }

  public function editCategory(Request $request, $id) {
    $item = Category::find($id);
    $item -> title = $request -> input('title');
    $item -> save();

    return response() -> json('Item was updated');

  }
}
