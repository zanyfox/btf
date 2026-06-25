<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Rubric;
use DB;
use Session;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Facades\Image;

class PostsController extends Controller {

  public $rubrics;
  public $authors;

  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {
    $query = Post::latest('created_at')->with(['rubric','author']);
    $query = $query->when(request('search'), function ($query, $search) {
      return $query->where(function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      });
    });
    $posts = $query->paginate(10);
    return response()->json([
      'success' => true,
      'posts' => $posts,
    ]);
  }

  public function store(Request $request) {

    //$user = $request->user();
    //dd($user->email);
    /*dd(auth()->id()); */

    if( $request->input() ) {

      $validator = Validator::make($request->all(), [
        'name' => ['required','min:3','max:191',Rule::unique('posts', 'name')],
        'slug' => ['required','unique:posts,slug'],
        //'rubric_id' => 'required',
        'preview' => 'nullable|mimes:png,jpg,jpeg,webp',
        'picture' => 'nullable|mimes:png,jpg,jpeg,webp'
      ]);

      if( $validator->fails() ) {
        return response()->json([
          'status' => 'fail',
          'message' => __('admin.ValidationWentWrong'),
          'errors' => $validator->errors()
        ]);
      }

      $rubricId = 1;// $request->input('rubric_id');
      $rubric = Rubric::find($rubricId);

      $post = new Post;
      $post->user_id = $request->input('user_id') ?? auth()->id(); // Auth::user()->id;
      $post->name = $request->input('name');

      if(empty($request->input('slug'))) {
        $slugify = new Slugify();
        $post->slug = $slugify->slugify($post->name);
      } else {
        $post->slug = $request->input('slug');
      }

      $post->tagline = $request->input('tagline');
      $post->excerpt = request('excerpt');
      $post->body = $request->input('body');
      $post->tags = $request->input('tags');
      $post->lang = $request->input('lang') ?? config('app.locale');
      $post->status = (bool)$request->input('status');

      /* if($request->hasFile('preview')) {
        //$file = $request->file('preview')->store('posts/preview', 'public');
        //$post->preview = $file;
        $file = $request->file('preview');
        $extension = $file->getClientOriginalExtension();
        $filename = $rubric->name . '_' . time() . '.' . $extension;
        $file->move('uploads/posts/preview', $filename);
        $post->preview = $filename;
      } */

      /* if($request->has('picture')) {
        $file = $request->file('picture');
        $extension = $file->getClientOriginalExtension();
        $filename = $rubric->name . '_' . time() . '.' . $extension;
        $file->move('uploads/posts', $filename);
        $post->picture = $filename;
      } */

      //request('picture')->store('upload/posts', 's3');
      /* $imagePath = request('picture')->store('upload/posts', 'public');

      $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(600, 600);
      $image->save(); */


      //$post->save();

      //DB::beginTransaction();
      $rubric->posts()->save($post);
      //DB::commit();

      /* auth()->user()->posts()->create([
        'name' => $request->input('name')
      ]); */

      //$user = $request->user();
      //$user->posts()->save($post);

      // Insert into pivot table
      /* $rubrics = $request->rubric_ids;
      foreach($rubrics as $rubric) {
        PostRubric::create([
          'post_id' => $post->id,
          'rubric_id' => $rubric
        ]);
      } */


      /* $rubrics = $request->rubric_ids;
      $postRubrics = [];
      foreach($rubrics as $rubric) {
        array_push($postRubrics, ['post_id' => $post->id, 'rubric_id' => $rubric]);
      }
      \Log::info($postRubrics);
      PostRubric::insert($postRubrics); */


      return response()->json([
        'status' => 'success',
        'message' => __('admin.NewRecordHasBeenCreatedSuccessfully'),
        'post' => $post
      ]);
    }
  }

  public function show($id) {
    //$this->authorize('isAdmin', Post::class);
    $post = Post::findOrFail($id)->with(['rubric', 'author'])->first();

    /* if(\illuminate\Support\Facades\Gate::denies('isAdmin', $post)) {
      abort(403, __('admin.YouAreNotAuthorizedToAccessThisPage'));
    } */
    return response()->json([
      'status' => 'success',
      'post' => $post
    ]);
  }

  public function update(Request $request, $id) {

    /* if( auth()->user()->cannot('isAdmin', Post::class) ) {
      abort(403, 'You do not own this post');
    } */

    $post = Post::findOrFail($id);

    /* if(\illuminate\Support\Facades\Gate::forUser(auth()->user())->denies('isAdmin', $post)) {
      abort(403, __('admin.YouAreNotAuthorizedToUpdateThisRecord'));
    } */

    $rubricId = $request->input('rubric_id');
    $rubric = Rubric::find($rubricId);
    if(!$rubric) {
      $rubric = $post->rubric;
    }

    $request->validate([
      'name' => ['required', 'min:3', 'max:255'],
      'slug' => ['required','unique:posts,slug,' . $id],
      //'rubric_id' => 'required',
      //'preview' => 'nullable|mimes:png,jpg,jpeg,webp',
      //'picture' => 'nullable|mimes:png,jpg,jpeg,webp',
      //'status' => 'sometimes'
    ]);

    $post->rubric_id = $request->input('rubric_id');
    $post->user_id = $request->input('user_id') ?? auth()->id();
    $post->name = $request->input('name');

    //print_r($post); die;

    if(empty($request->input('slug'))) {
      $slugify = new Slugify();
      $post->slug = $slugify->slugify($post->name);
    } else {
      $post->slug = $request->input('slug');
    }

    $post->tagline = $request->input('tagline');
    $post->excerpt = request('excerpt');
    $post->body = $request->input('body');
    $post->tags = $request->input('tags');
    $post->lang = $request->input('lang') ?? config('app.locale');
    $post->status = (bool)$request->input('status');

    /* if( request('preview') ) {
      if($post->preview) {
        Storage::delete($post->preview);
      }
      $imagePath = request('preview')->store('posts/preview', 'public');
      //$image = Image::make(public_path("storage/{$imagePath}"))->fit(600, 600);
      //$image->save();
      $post->preview = $imagePath ?? null;
    } */


    /* if( request('picture') ) {
      if($post->picture) {
        Storage::delete($post->picture);
      }
      $imagePath = request('picture')->store('posts', 'public');
      //$image = Image::make(public_path("storage/{$imagePath}"))->fit(600, 600);
      //$image->save();
      $post->picture = $imagePath ?? null;
    } */

    /* if($request->hasFile('preview')) {
      $file = $request->file('preview');
      $extension = $file->getClientOriginalExtension();
      $filename = $rubric->name . '_' . time() . '.' . $extension;
      $file->move('uploads/posts/preview', $filename);

      if(File::exists('uploads/posts/preview/' . $post->preview)) {
        File::delete('uploads/posts/preview/' . $post->preview);
      }

      $post->preview = $filename;
    }

    if($request->has('picture')) {
      $file = $request->file('picture');
      $extension = $file->getClientOriginalExtension();
      $filename = $rubric->name . '_' . time() . '.' . $extension;
      $file->move('uploads/posts', $filename);

      if(File::exists('uploads/posts/' . $post->picture)) {
        File::delete('uploads/posts/' . $post->picture);
      }

      $post->picture = $filename;
    } */

    //$post->update(array_merge($data, ['image' => $imagePath ?? null]));

    DB::beginTransaction();
    try {
      $post->save();
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }

    /* $model = new Rubric();
    $rubric = $model->find($request->input('rubric_id'));
    $post->rubric()->save($rubric); */

    return response()->json([
      'status' => 'success',
      'message' => __('admin.RecordUpdatedSuccessfully'),
      'post' => $post
    ]);

  }

  // Change post status
  public function changeStatus(Request $request, $id) {
    $post = Post::find($id);
    if (!$post) {
      return response()->json(['status' => 'error', 'message' => 'Post not found'], 404);
    }
    $post->update([
      'status' => $request->status,
    ]);
    return response()->noContent();
  }

  public function destroy($id) {

    //$this->authorize('isAdmin', Post::class);

    try {
      $post = Post::find($id);

      /* if(\illuminate\Support\Facades\Gate::any(['isAdmin','delete-post'], $post)) {
        abort(403, __('admin.YouAreNotAuthorizedToUpdateThisRecord'));
      } */


      if($post->preview) {
        //Storage::delete($post->preview);
        if(File::exists('uploads/posts/preview/' . $post->preview)) {
          File::delete('uploads/posts/preview/' . $post->preview);
        }
      }
      if($post->picture) {
        //Storage::delete($post->picture);
        if(File::exists('uploads/posts/' . $post->picture)) {
          File::delete('uploads/posts/' . $post->picture);
        }
      }
      $post->delete();
      return response()->noContent();
    } catch(Exception $e) {
      throw new Exception('Error!!');
      //dd($e);
    }
  }

}
