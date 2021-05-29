<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Faq;
use App\Models\ContactUs;
use App\Models\ReportedIssue;

use Auth;
use Validator;

class MigrationController extends Controller
{
    //
    /**
     * 
     * Data Migration
     */

    public function users(){
        $link = new \mysqli("localhost", "root", "", "test_preparehow");
        
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }


        // Attempt select query execution
        $sql = "SELECT * FROM users";
        $result = mysqli_query($link, $sql) or die('erorr');
        while($row = \mysqli_fetch_array($result)){
            $validator = Validator::make($row, [
                'email' => 'required|unique:users,email',
                'contact_number' => 'required|unique:users,contact_no',
            ]);
    
            if($validator->fails()){
                echo 'fail -';
            }else{
                $user = new User;
                $user->name = $row['name'];
                $user->email = $row['email'];
                $user->contact_no = $row['contact_number'];
                $user->admin_notes = $row['admin_notes'];
                $user->email_verified_at = $row['email_verified_at'];
                $user->password = $row['password'];
                $user->created_at = $row['created_at'];
                $user->source = $row['source'];
                $user->ref_by = $row['referred_by'];
                $user->last_login_at = $row['last_login_at'];
                $user->save();

                echo 'done - ';
            }

            
        }
        
        // Close connection
        mysqli_close($link);
    }

    public function subjectChapters(){
        $link = new \mysqli("localhost", "root", "", "test_preparehow");
        
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }


        // Attempt select query execution
        $sql = "SELECT * FROM subjects";
        $result = mysqli_query($link, $sql) or die('erorr');
        while($row = \mysqli_fetch_array($result)){

            $subject = new Subject;
            $subject->name = $row['subject'];
            $subject->save();

            $sql1 = "SELECT * FROM chapters WHERE subject_id = {$row['id']}";
            $result1 = mysqli_query($link, $sql1) or die('erorr');
            while($row1 = \mysqli_fetch_array($result1)){
                $chapter = new Chapter;
                $chapter->subject_id = $subject->id;
                $chapter->name = $row1['chapter_name'];
                $chapter->save();
            }

            echo 'done - ';
            
        }
        
        // Close connection
        mysqli_close($link);
    }

    public function questionOptions(){
        $link = new \mysqli("localhost", "root", "", "test_preparehow");
        
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }


        // Attempt select query execution
        /**
         * Getting all questions
         */
        $sql = "SELECT * FROM questions";
        $result = mysqli_query($link, $sql) or die('erorr');
        while($row = \mysqli_fetch_array($result)){

            /**
             * Creating new question one by one.
             */
            $question = new Question;
            $question->question = $row['question'];
            $question->explaination = $row['explaination'];
            $question->added_by = 1;
            $question->updated_by = 1;
            $question->save();

            $sql1 = "SELECT * FROM chapters WHERE id = {$row['chapter']}";
            $result1 = mysqli_query($link, $sql1) or die('erorr2');
            $chapter = [];
            while($row1 = \mysqli_fetch_array($result1)){
                $chapter = Chapter::where('name', $row1['chapter_name'])->first();
                // dd($row1);
            }
            

            try {
                if(!is_null($chapter))
                    $question->chapter_id = $chapter->id;
                else 
                    echo '<font color="red"> -ERROR- </font>';
            } catch (\Throwable $th) {
                echo '<font color="red"> -*ERROR*- </font>';
                
            }

            $opt1 = new QuestionOption;
            $opt1->question_id = $question->id;
            $opt1->value = $row['option_one'];
            $opt1->save();

            $opt2 = new QuestionOption;
            $opt2->question_id = $question->id;
            $opt2->value = $row['option_two'];
            $opt2->save();

            $opt3 = new QuestionOption;
            $opt3->question_id = $question->id;
            $opt3->value = $row['option_three'];
            $opt3->save();

            $opt4 = new QuestionOption;
            $opt4->question_id = $question->id;
            $opt4->value = $row['option_four'];
            $opt4->save();

            if($row['option_correct'] == 1)
                $question->correct_option = $opt1->id;
            elseif($row['option_correct'] == 2)
                $question->correct_option = $opt2->id;
            elseif($row['option_correct'] == 3)
                $question->correct_option = $opt3->id;
            elseif($row['option_correct'] == 4)
                $question->correct_option = $opt4->id;

            $question->save();


            echo 'done - ';
            
        }
        
        // Close connection
        mysqli_close($link);    
    }

    public function faqs(){
        $link = new \mysqli("localhost", "root", "", "test_preparehow");
        
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }


        // Attempt select query execution
        $sql = "SELECT * FROM faq";
        $result = mysqli_query($link, $sql) or die('erorr');
        while($row = \mysqli_fetch_array($result)){
        
            $faq = new Faq;
            $faq->question = $row['question'];
            $faq->answer = $row['answer'];
            $faq->category = $row['category'];
            $faq->added_by = 1;
            $faq->save();

            echo "done - ";
        }
        
        // Close connection
        mysqli_close($link);
    }

    public function reportedIssues(){
        $link = new \mysqli("localhost", "root", "", "test_preparehow");
        
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }


        // Attempt select query execution
        $sql = "SELECT * FROM laravel_reported_issues";
        $result = mysqli_query($link, $sql) or die("ER:: ".$link->error);
        while($row = \mysqli_fetch_array($result)){
            /**
             * Getting Question date
             */
        
            $reportedIssue = new ReportedIssue;
            $reportedIssue->name = $row['name'];
            $reportedIssue->contact_no = $row['contact'];
            $reportedIssue->message = $row['issue_message'];
            $reportedIssue->reported_url = $row['reported_url'];
            $reportedIssue->status = $row['issue_status'];
            $reportedIssue->notes = $row['admin_notes'];
            $reportedIssue->subject = 'OLD ISSUES';

            try {
                $sql1 = "SELECT * FROM questions WHERE id = {$row['question_id']}";
                $result1 = mysqli_query($link, $sql1);
                while($row1 = \mysqli_fetch_array($result1)){
                    $question = Question::where('question', $row1['question'])->first();
                    $reportedIssue->question_id = $question->id;
                }

            } catch (\Throwable $th) {
                echo "<font color='blue'> -NULL- </font>";
            }

            $reportedIssue->save();

            echo "done - ";
        }
        
        // Close connection
        mysqli_close($link);
    }

    public function contactUs(){
        $link = new \mysqli("localhost", "root", "", "test_preparehow");
        
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }


        // Attempt select query execution
        $sql = "SELECT * FROM laravel_app_contact_us_messages";
        $result = mysqli_query($link, $sql) or die('erorr');
        while($row = \mysqli_fetch_array($result)){
        
            $contact = new ContactUs;
            $contact->name = $row['name'];
            $contact->email = $row['email'] ?? '';
            $contact->contact_no = $row['contact_number'];
            $contact->message = $row['message'];
            $contact->status = $row['message_status'];
            $contact->admin_notes = $row['admin_notes'];
            $contact->save();

            echo "done - ";
        }
        
        // Close connection
        mysqli_close($link);
    }
    
}
