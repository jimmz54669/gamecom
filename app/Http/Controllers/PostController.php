<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Postpic;
use App\Comment;


class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Function to Add Post on Timeline
    public function addPost(Request $request){
        $userid = Auth::user()->id;
        $content = $request->content;//$_POST['content']
        $photo_post = $request->file('photo_post');

        if(isset($content)){
            //Insert Post to Database
            $SavePost = New Post;
            $SavePost->content = $content;
            $SavePost->userid = $userid;
            $SavePost->save();
        }

        
        if($photo_post != NULL || $photo_post != ''){
        
            $image_name = rand(100, 999) . '.' . $photo_post->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');

            $resize_image = Image::make($photo_post->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/images');

            $photo_post->move($destinationPath, $image_name);

            //Save to postpic DB
            $AddPostPic = New Postpic;
            $AddPostPic->imgname = $image_name;
            $AddPostPic->postid = $SavePost->id;
            $AddPostPic->userid = $userid;
            $AddPostPic->save();
        }

        return view('profile');
    }
    



    public function editPost(Request $request){
        $userid = Auth::user()->id;
        $editphoto = $request->file('editedpic');
        $oldpic = $request->picname;
        $editedpost = $request->editedpost;
        $postid = $request->postid;


        if(isset($editedpost)){
            $EditPost = Post::find($postid);
            $EditPost->content = $editedpost;
            $EditPost->userid = $userid;
            $EditPost->save();
        }

        

        if($editphoto != NULL || $editphoto != ''){
          
            if($oldpic == NULL){
        
                $image_name = rand(100, 999) . '.' . $editphoto->getClientOriginalExtension();

                $destinationPath = public_path('/thumbnail');

                $resize_image = Image::make($editphoto->getRealPath());

                $resize_image->resize(150, 150, function($constraint){
                $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image_name);

                $destinationPath = public_path('/images');

                $editphoto->move($destinationPath, $image_name);

                //Save to postpic DB
                $AddPostPic = New Postpic;
                $AddPostPic->imgname = $image_name;
                $AddPostPic->postid = $postid;
                $AddPostPic->userid = $userid;
                $AddPostPic->save();

            }else{

                $image_name = rand(100, 999) . '.' . $editphoto->getClientOriginalExtension();

                $destinationPath = public_path('/thumbnail');
                //Delete Old Photo on directory
                File::delete($destinationPath.'/'.$oldpic);

                $resize_image = Image::make($editphoto->getRealPath());

                $resize_image->resize(150, 150, function($constraint){
                $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image_name);

                $destinationPath = public_path('/images');
                File::delete($destinationPath.'/'.$oldpic);

                $editphoto->move($destinationPath, $image_name);    

                //Update Image Record post
                $EditPostPic = Postpic::where('postid', '=', $postid)
                ->where('userid', '=', $userid)
                ->update(['imgname' => $image_name]);
                
            }
        }
      

    }

    public function deletePost(Request $request){
        $userid = Auth::user()->id;
        $postid = $request->postid;
        $oldpic = $request->picname;

        Post::where('id', '=', $postid)
        ->where('userid', '=', $userid)
        ->delete();

        Comment::where('postid', '=', $postid)
        ->delete();

        if($oldpic != NULL){
            PostPic::where('postid', '=', $postid)
            ->delete();

            $destinationPath = public_path('/images');
            File::delete($destinationPath.'/'.$oldpic);

            $destinationPath = public_path('/thumbnail');
            File::delete($destinationPath.'/'.$oldpic);
        }
        

    }

}//End Class
