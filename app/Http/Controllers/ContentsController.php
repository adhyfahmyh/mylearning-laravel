<?php

namespace MyLearning\Http\Controllers;

use Illuminate\Http\Request;
use MyLearning\Contents;
use MyLearning\Ratings;
use MyLearning\Http\Controllers\Auth;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use MyLearning\Comment;
use MyLearning\Selection;
use Symfony\Component\Console\Helper\Table;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyLearning\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $category = $request->category;
        $sortBy = $request->sortBy;
        $terbaru = $request->terbaru;
        $terlama = $request->terlama;

        if ($request->search) {
            $contents = DB::table('contents')
                    ->where('title', 'like', '%'.$search.'%')
                    ->orWhere('tag', 'like', '%'.$search.'%')
                    ->orWhere('category', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
        } elseif ($request->category) {
            $contents = DB::table('contents')
                    ->where('category', $category)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
        } elseif ($request->sortBy) {
            $contents = DB::table('contents')
                    ->orderBy($sortBy, 'DESC')
                    ->paginate(10);
        } else {
            $contents = DB::table('contents')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(10);
        }
        $ratings = Ratings::all();

        // return view('contents.index')->with('contents', $contents)->withQuery ($query);
        return view('contents.index', [
            'contents'=>$contents, 
            'search'=>$search, 
            'ratings'=>$ratings,
            'category'=>$category,
            'sortBy' =>$sortBy
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $contents = Contents::orderBy('updated_at', 'desc')->paginate(5);
        
        return view('contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this-> validate($request,[
            'title'=> 'required',
            'content_img' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5000',
            'description' => 'nullable',
            'category' => 'required',
            'tag' => 'nullable',
            'body' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:10000',
            'video' => 'nullable'
        ]);
        
        if(!isset($_FILES['content_img']) || $_FILES['content_img']['error'] == UPLOAD_ERR_NO_FILE) {
            $img_name = ""; 
        } else {
            $img_content = $request->file('content_img');
            $img_name = time()."_".$img_content->getClientOriginalName();
            $upload_path = 'data_file/images';
            $img_content->move($upload_path, $img_name);
        }
        $file_content = $request->file('file');
        $file_name = time()."_".$file_content->getClientOriginalName();
        $upload_path_f = 'data_file/files';
        $file_content->move($upload_path_f, $file_name);

        $tag = $request->tag;
        $tag = explode(" ", $tag);
        $tags = implode(substr_replace($tag," #",0,0));
        $user_id = $request->user_id;

        Contents::create([
            'user_id' => $user_id,
            'title'=> $request->title,
            'content_img' => $img_name,
            'description'=> $request->description,
            'category'=> $request->category,
            'tag'=> $tags,
            'body'=> $request->body,
            'file'=> $file_name,
            'video'=> $request->video
        ]);

        return redirect('/contents')->with('success', 'Konten Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \MyLearning\Contents  $contents
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contents $contents, $id)
    {
        $content = Contents::find($id);
        $content_id = $content->id;
        $user_id = auth()->user()->id;
        $content_rating = DB::table('ratings')
                            ->where('content_id', $content_id)
                            ->avg('rating');
        $ratings = DB::table('ratings')
                    ->where('user_id', auth()->user()->id)
                    ->where('content_id', $content_id)
                    ->avg('rating');
        $selection = DB::table('user_selection')
                    ->where('user_id', auth()->user()->id)
                    ->where('content_id', $content_id)
                    ->avg('total_selection');
        $timespent = DB::table('timespents')
                        // ->select('timespent')
                        ->where('user_id',$user_id)
                        ->where('content_id', $content_id)
                        ->avg('timespent');
        $bookmarked = DB::table('bookmarks')
                        ->where('user_id',$user_id)
                        ->where('content_id', $content_id)
                        ->avg('bookmarked');
        $comments = DB::table('comments')
                        ->where('content_id', $content_id)
                        ->get();
        if (count($ratings) == 0) {
            $ratings = 0;
        }
        if (count($content_rating) == 0) {
            $content_rating = 0;
        }
        if (count($selection) == 0) {
            $selection = 0;
        }
        return view('contents.show', [
            'content'=>$content, 
            'ratings'=>$ratings, 
            'content_rating' =>$content_rating,
            'selection' => $selection,
            'timespent' => $timespent,
            'bookmarked' => $bookmarked,
            'comments' => $comments,
        ]);   
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Contents::find($id);
        return view('contents.edit')->with('content', $content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyLearning\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contents $contents)
    {
        $this-> validate($request,[
            'title'=> 'required',
            // 'file'=> 'required',
            'body' => 'required'
        ]);
        $id = $request->content_id;
        $content = Contents::find($id);
        $title = $request->title;
        // $content_img = $request->content_img;
        $category = $request->category;
        $tag = $request->tag;
        $body = $request->body;
        // $file = $request->file;
        $video = $request->video;
        // if(!isset($_FILES['content_img']) || $_FILES['content_img']['error'] == UPLOAD_ERR_NO_FILE) {
        //     $content_img = Contents::select('content_img')->where('id', $id); 
        // } else {
        //     $img_content = $request->file('content_img');
        //     $content_img = time()."_".$img_content->getClientOriginalName();
        //     $upload_path = 'data_file/images';
        //     $img_content->move($upload_path, $content_img);
        // };
        // if(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {
        //     $file = Contents::select('file')->where('id', $id); 
        // } else {
        //     $file_content = $request->file('file');
        //     $file = time()."_".$file_content->getClientOriginalName();
        //     $upload_path = 'data_file/files';
        //     $file_content->move($upload_path, $file);
        // };
        // $content->save();
        Contents::where('id',$id)->update([
            'title' => $title,
            // 'content_img' => $content_img,
            'category' => $category,
            'tag' => $tag,
            'body' => $body,
            // 'file' => $file,
            'video' => $video,
        ]);

        // return redirect()->route('user.created-content', $content->id)->with('success', 'Konten Telah Diedit');
        return redirect('/created-content/*')->with('success', 'Konten Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MyLearning\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contents $contents)
    {
        $id = $request->content_id;
        $content = Contents::find($id);
        $content->delete();
        return redirect('/created-content/Auth::user()->id')->with('success', 'Konten Berhasil dihapus');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyLearning\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) 
    {
        // $search = $request->search;
        // $contents = DB::table('contents')->where('title', 'like', '%'.$search.'%')->paginate();
        $contents = Contents::when($request->search, function ($query) use ($request) {
            $query->where('title', 'LIKE', "%{$request->search}%");
        })->get()->paginate();
        return view('contents.search')->with('contents', $contents);
    }

    // public function rating (Request $request)
    // {
    //     $this-> validate($request,[
    //         'rating'=> 'required'
    //     ]);
        
    //     // Create Post 
    //     $rating = new Ratings;
    //     // $content = Contents::find($id);
    //     $rating->user_id = auth()->user()->id;
    //     // $rating->content_id = $request->input('content_id');
    //     // $rating->rating = $request->input('rating');
    //     $rating->save();

    //     return redirect('contents/'.$rating->content_id)->with('rating', $rating);
    // }
}


// $content = new Contents;
// $content->user_id = auth()->user()->id;
// $content->title = $request->input('title');
// $content->content_img = $request->file('content_img');
// $content->description = $request->input('description');
// $content->category = $request->input('category');
// $content->tag = $request->input('tag');
// $content->body = $request->input('body');
// $content->file = $request->file('file');
// $content->video = $request->input('video');
// $content->save();