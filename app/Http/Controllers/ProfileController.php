<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('notadmin', ['except' => ['getResetPassword', 'postResetPassword']]);
    }

    public function getBasicinfo()
    {
        return redirect('/dashboard');
    }

    public function getBasicinfoChange()
    {
        return view('userview.profile.company-profile-change');
    }

    public function postBasicinfoChange()
    {
        $input = \Request::all();
        $input['logo'] = json_encode($this->get_images($input));
        unset($input['images']);
        User::unguard();
        User::where('id', \Auth::user()->getAttributeValue('id'))->update($input);
        User::reguard();
        return redirect('/dashboard');
    }

    public function getContactinfoChange()
    {
        return view('userview.profile.contact-details-change');
    }

    public function postContactinfoChange()
    {
        $input = \Request::all();
        User::unguard();
        User::where('id', \Auth::user()->getAttributeValue('id'))->update($input);
        User::reguard();
        return redirect('/dashboard');
    }

    /**
     * @param $input
     */
    private function get_images($input)
    {
        $images = [];

//        dd($input);

        if (!is_null($input['images'][0])) {
            foreach ($input['images'] as $image_file) {
                $path = 'images/products/'; //relative path, not absolute
                $image_name = time() . $image_file->getClientOriginalName();
                $image_path = $path . $image_name;
                Image::make($image_file)->resize(300, 200)->save($image_path);
                array_push($images, $image_path);
            }
        } else {
            array_push($images, "images/common-placeholder.jpg");
        }

        return $images;
    }

    public function getResetPassword()
    {
        return view('userview.reset_password');
    }

    public function postResetPassword()
    {
        $input = \Request::all();

        if (!\Hash::check($input['old'], \Auth::user()->password)) {
            return redirect()->back()->with('error', 'wrong old password');
        } elseif ($input['new'] == "" || $input['new'] !== $input['confirm']) {
            return redirect()->back()->with('error', 'password mismatch');
        } else {
            User::where('id', \Auth::user()->id)->update(['password' => bcrypt($input['confirm'])]);
            return redirect()->back()->with('success', 'Successfully Updated');
        }
    }

    public function getBrochure()
    {
      $userid = \Auth::user()->getAttributeValue('id');
      $brochure = User::where('id', $userid)->value('brochure');

      $goldsupplier = \Auth::user()->getAttributeValue('gold_supplier');
      $premiumgoldsupplier = \Auth::user()->getAttributeValue('premium_gold_supplier');

      $free = !($goldsupplier || $premiumgoldsupplier);

      return view('userview.brochure', compact('brochure','free'));
    }

    public function postBrochure(Request $request)
    {
      $target_file = $request->file('file')->getRealPath();

      $fileType = $request->file('file')->getClientOriginalExtension();

      if($fileType != 'pdf')
      {
        return redirect()->back()->with('error', 'Wrong file type. Please upload a pdf doucment');
      }

      //Store the file at server
      $filepath = 'brochures/brochure-'.time().'.pdf';
      $resource = file_get_contents($target_file);
      Storage::put($filepath,$resource);

      //update the database
      $user = User::find(\Auth::user()->getAttributeValue('id'));
      $user->brochure = $filepath;
      $user->save();

      return redirect()->back()->with('success', 'Brochure uploaded successfully');
    }
}
