<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Rubric;
use DB;
use Session;
use Storage;
use Cocur\Slugify\Slugify;

use Intervention\Image\Facades\Image;

class PostsController extends Controller {

  public $rubrics;
  public $authors;

  public function __construct() {

    $this->middleware('isAdmin');
    
    $this->rubrics = DB::table('rubrics')->select('id','title')->get();
    $this->authors = DB::table('users')->select('id','name')->where('is_admin', true)->get();
  }

  public function index() {
    return view('admin.posts.index', [
      'posts' => Post::latest()->paginate(15)
    ]);
  }

  public function create() {
    return view('admin.posts.create', [
      'authors' => $this->authors,
      'rubrics' => $this->rubrics
    ]);
  }

  public function store(Request $request) {

    //$user = $request->user();
    //dd($user->email);
    /*dd(auth()->id()); */

    //if( $request->input() ) {

      $request->validate([
        'name' => ['required', Rule::unique('posts', 'name'), 'min:3', 'max:255'],
        'rubric_id' => 'required',
        'preview' => 'nullable|mimes:png,jpg,jpeg,webp',
        'picture' => 'nullable|mimes:png,jpg,jpeg,webp',
        'status' => 'sometimes'
      ]);

      $rubricId = $request->input('rubric_id');
      $rubric = Rubric::find($rubricId);

      $post = new Post;
      $post->user_id = $request->input('user_id') ?? auth()->id();
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

      if($request->hasFile('preview')) {
        /* $file = $request->file('preview')->store('posts/preview', 'public');
        $post->preview = $file; */
        $file = $request->file('preview');
        $extension = $file->getClientOriginalExtension();
        $filename = $rubric->name . '_' . time() . '.' . $extension;
        $file->move('uploads/posts/preview', $filename);
        $post->preview = $filename;
      }      

      if($request->has('picture')) {
        $file = $request->file('picture');
        $extension = $file->getClientOriginalExtension();
        $filename = $rubric->name . '_' . time() . '.' . $extension;
        $file->move('uploads/posts', $filename);
        $post->picture = $filename;
      }

      //request('picture')->store('upload/posts', 's3');
      /* $imagePath = request('picture')->store('upload/posts', 'public');

      $image = \Intervention\Image\Facades\Image::make(public_path("storage/{$imagePath}"))->fit(600, 600);
      $image->save(); */


      //$post->save();

      $rubric->posts()->save($post);

      /* auth()->user()->posts()->create([
        'name' => $request->input('name')
      ]); */

      //$user = $request->user();
      //$user->posts()->save($post);

      return redirect('admin/posts')->with('success', __('admin.NewRecordHasBeenCreatedSuccessfully'));
    //}

    

  }

  public function edit($id) {
    $this->authorize('isAdmin', Post::class);
    $post = Post::findOrFail($id);

    if(\illuminate\Support\Facades\Gate::denies('isAdmin', $post)) {
      abort(403, __('admin.YouAreNotAuthorizedToAccessThisPage'));
    }


    return view('admin/posts/edit', [
      'post' => $post,
      'authors' => $this->authors,
      'rubrics' => $this->rubrics
    ]);
  }

  public function update(Request $request, $id) {

    if( auth()->user()->cannot('isAdmin', Post::class) ) {
      abort(403, 'You do not own this post');
    }

    $post = Post::findOrFail($id);

    if(\illuminate\Support\Facades\Gate::forUser(auth()->user())->denies('isAdmin', $post)) {
      abort(403, __('admin.YouAreNotAuthorizedToUpdateThisRecord'));
    }

    $rubricId = $request->input('rubric_id');
    $rubric = Rubric::find($rubricId);
    if(!$rubric) {
      $rubric = $post->rubric;
    }

    $request->validate([
      'name' => ['required', 'min:3', 'max:255'],
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

    if($request->hasFile('preview')) {
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
    }

    //$post->update(array_merge($data, ['image' => $imagePath ?? null]));

    $post->save();

    /* $model = new Rubric();
    $rubric = $model->find($request->input('rubric_id'));
    $post->rubric()->save($rubric); */


    $request->session()->flash('success', __('admin.RecordHasBeenUpdated'));
    return redirect('admin/posts');

    /* return view('admin/posts/edit', [
      'post' => $post,
      'authors' => $this->authors,
      'rubrics' => $this->rubrics
    ]); */

  }

  public function delete($id) {

    $this->authorize('isAdmin', Post::class);

    try {
      $post = Post::find($id);

      if(\illuminate\Support\Facades\Gate::any(['isAdmin','delete-post'], $post)) {
        abort(403, __('admin.YouAreNotAuthorizedToUpdateThisRecord'));
      }


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
      //Post::destroy($id);
      $post->delete();
      Session::flash('success', __('admin.RecordHasBeenRemoved'));
      return redirect('admin/posts');
    } catch(Exception $e) {
      throw new Exception('Error!!');
      //dd($e);
    }
  }

}
