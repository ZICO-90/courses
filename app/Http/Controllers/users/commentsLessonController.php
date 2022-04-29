<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\LessonComment;
use App\Models\LessonReplyComment;
use Auth;
class commentsLessonController extends Controller
{
    public function comments(Request $requset)
    {

        try {
            $lessonId = Crypt::decrypt($requset->lessonId);
        
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }
          
            LessonComment::create([
                'lesson_id' => $lessonId,
                'student_id' => Auth::user()->id,
                'comments' => $requset->comments,  
            ]);

            return redirect()->back();
  
    }
    

    public function commentsEdit(Request $requset)
    {
       

        try {
            $editCommentId = Crypt::decrypt($requset->editCommentId);
        
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }
          
       $comments_update =    LessonComment::findOrFail($editCommentId);

       $comments_update->comments =  $requset->edit_comment;
       $comments_update->save();

            return redirect()->back();
  
    }

    public function commentsDelete($deleteId)
    {
        try {
            $deleteId = Crypt::decrypt($deleteId);
        
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }

        LessonComment::findOrFail($deleteId)->delete();

        return redirect()->back(); 
    }
  
    public function reply(Request $requset)
    {

        try {
            $commentId = Crypt::decrypt($requset->commentId);
        
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }

        
           
            LessonReplyComment::create([
                'comment_id' => $commentId ,
                'student_id' => Auth::user()->id,
                'reply_comments'=> $requset->comment_reply,
            ]);
            return redirect()->back();
    }


    public function repliesEdit(Request $requset)
    {
       

        try {
            $editReplyId = Crypt::decrypt($requset->editReplyId);
        
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }
          
       $comments_reply_update =    LessonReplyComment::findOrFail($editReplyId);

       $comments_reply_update->reply_comments =  $requset->edit_reply;
       $comments_reply_update->save();

            return redirect()->back();
  
    }


    public function repliesDelete($deleteId)
    {
        try {
            $deleteId = Crypt::decrypt($deleteId);
        
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }

            LessonReplyComment::findOrFail($deleteId)->delete();
        
        return redirect()->back(); 
    }
}
