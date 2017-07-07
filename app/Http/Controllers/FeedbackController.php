<?php

namespace App\Http\Controllers;

use Request;

use App\Feedback;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
  public function getSourcingRequest()
  {
      return view('publicview.sourcing-request');
  }

  public function getList()
  {
      $feedbacks = Feedback::orderBy('id','desc')->paginate(SettingsController::MAX_PAGINATE);
      return view('userview.sourcing-request-list',compact('feedbacks'));
  }

  public function postSourcingRequest()
  {
      $input = \Request::all();
      Feedback::unguard();
      Feedback::create($input);
      Feedback::unguard();
      return redirect('/sourcing-request')->with('success', 'Sourcing Request Posted Successfully');
  }

  public function postDelete()
  {
      $id = Request::input('id');

      Feedback::destroy($id);

      return redirect('feedback/list')->with('success', 'Sourcing Request Deleted Successfully');
  }

  public function getData($id = null)
  {
      if (Request::ajax()) {
          if ($id) {
              $feedback = Feedback::where('id', $id)->first();

              return response()->json(['success' => true, 'result' => $feedback]);
          } else {
              return response()->json(['success' => false]);
          }

      }
  }
}
