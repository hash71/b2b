<?php

namespace App\Http\Controllers;

use App\User;
use Request;
use App\Category;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function getMemberList()
    {
        $members = User::where('role','!=','admin')->where('approved', 1)->orderBy('id', 'desc')->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.profile.member-list', compact('members'));
    }

    public function getExpirationInfo()
    {
        $members = User::where('role','!=','admin')->where('approved', 1)->orderBy('id', 'desc')->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.profile.expiration-info', compact('members'));
    }

    public function getFreeMembersList()
    {
        $members = User::where('role','!=','admin')
                        ->where('role','!=','buyer')
                        ->where('gold_supplier',0)
                        ->where('premium_gold_supplier',0)
                        ->where('approved', 1)
                        ->orderBy('id', 'desc')
                        ->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.profile.free-members', compact('members'));
    }

    public function getGoldMembersList()
    {
        $members = User::where('role','!=','admin')
                        ->where('role','!=','buyer')
                        ->where('gold_supplier',1)
                        ->where('approved', 1)
                        ->orderBy('id', 'desc')
                        ->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.profile.gold-members', compact('members'));
    }

    public function getGoldPremiumMembersList()
    {
        $members = User::where('role','!=','admin')
                        ->where('role','!=','buyer')
                        ->where('premium_gold_supplier',1)
                        ->where('approved', 1)
                        ->orderBy('id', 'desc')
                        ->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.profile.gold-premium-members', compact('members'));
    }

    public function getBuyersList()
    {
        $members = User::where('role','buyer')
                        ->where('approved', 1)
                        ->orderBy('id', 'desc')
                        ->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.profile.buyers-list', compact('members'));
    }

    public function postDelete()
    {
        $id = Request::get('id');
        User::destroy($id);
        return redirect('member/member-list')->with('success', 'Member Deleted Successfully');
    }

    public function getMemberData($id = null)
    {
        if (Request::ajax()) {
            if ($id) {
                $member = User::where('id',$id)->first();

                $member->category_name = Category::where('id',$member->category)->value('name');

                return response()->json(['success' => true, 'result' => $member]);
            } else {
                return response()->json(['success' => false]);
            }

        }
    }

    public function postMakeverified()
    {
        if (Request::ajax()) {
            $p_id = Request::input('member_id');
            $checked = Request::input('status');

            if ($checked == 'true')
                $status = 1;
            else
                $status = 0;

            User::where('id', $p_id)->update([
                'verified_company' => $status
            ]);
            return true;
        }
    }

    public function postMakegoldsupplier()
    {
        if (Request::ajax()) {
            $p_id = Request::input('member_id');
            $checked = Request::input('status');

            if ($checked == 'true')
                $status = 1;
            else
                $status = 0;

            User::where('id', $p_id)->update([
                'gold_supplier' => $status
            ]);
            return true;
        }
    }

    public function postMakepremiumgoldsupplier()
    {
        if (Request::ajax()) {
            $p_id = Request::input('member_id');
            $checked = Request::input('status');

            if ($checked == 'true')
                $status = 1;
            else
                $status = 0;

            User::where('id', $p_id)->update([
                'premium_gold_supplier' => $status
            ]);
            return true;
        }
    }

    public function postToggleactive()
    {
        if (Request::ajax())
        {
            $p_id = Request::input('member_id');
            $checked = Request::input('status');

            if ($checked == 'true')
                $status = 1;
            else
                $status = 0;

            $user = User::find($p_id);
            $user->approved = $status;
            $user->upgraded_at = time();
            $user->save();

            return response()->json(['success' => 'true']);
        }
    }

    public function postTogglemembership()
    {
        if (Request::ajax())
        {
            $p_id = Request::input('member_id');
            $checked = Request::input('status');

            if ($checked == 'true')
                $status = 1;
            else
                $status = 0;

            User::where('id', $p_id)->update([
                'paid_member' => $status
            ]);
            return response()->json(['success' => 'true']);
        }
    }

    public function postUpdateTrustProfile()
    {
      $input = \Request::all();

      $user = User::find($input['id']);
      $user->trust_profile = $input['trust_profile'];
      $user->save();

      return redirect('member/member-list')->with('success', 'Trust profile value updated Successfully');
    }
}
