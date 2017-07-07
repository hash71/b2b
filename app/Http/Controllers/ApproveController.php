<?php

namespace App\Http\Controllers;

use App\Buyproduct;
use App\Message;
use App\Product;
use App\ReqToBuyer;
use App\ReqToSupplier;
use App\User;
use Mail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApproveController extends Controller
{

    //Get the list of unappproved or Inactive users
    public function getRegistrationApprove()
    {
        $users = User::where('approved', '0')->orderBy('id', 'desc')->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.approval.registration', compact('users'));
    }

    //Get the lsit of inquiries waiting for approval
    public function getInquiryApprove()
    {
        $inquiries = ReqToSupplier::whereIn('buyer', User::where('approved', 1)->lists('id')->toArray())->
        where('approved', 0)->orderBy('id', 'desc')->paginate(SettingsController::MAX_PAGINATE);

        return view('userview.approval.inquiry', compact('inquiries'));
    }

    //Get the list of products waiting for Approval
    public function getProductsApprove()
    {
        $products = Product::where('approved', 0)->orderBy('id', 'desc')->paginate(SettingsController::MAX_PAGINATE);

        return view('userview.approval.products', compact('products'));
    }

    //Approve this product
    public function getProductsAccept($id)
    {
        Product::where('id', $id)->update(['approved' => 1]);

        return redirect()->back()->with('success', 'Products request approved successfully');
    }

    //Reject and Delete this product
    public function getProductsReject($id)
    {
        Product::destroy($id);

        return redirect()->back()->with('success', 'Products request rejected and deleted successfully');
    }

    //Get the list of Buying Offers waiting for approval
    public function getBuyingOfferApprove()
    {
        $offers = Buyproduct::where('approved', 0)->orderBy('id', 'desc')->paginate(SettingsController::MAX_PAGINATE);

        return view('userview.approval.buying-request', compact('offers'));
    }

    //Accept this buying request
    public function getBuyingOfferAccept($id)
    {
        Buyproduct::where('id', $id)->update(['approved' => 1]);

        return redirect()->back()->with('success', 'Buying request approved successfully');
    }

    //Reject and delete this buying offer
    public function getBuyingOfferReject($id)
    {
        Buyproduct::destroy($id);

        return redirect()->back()->with('success', 'Buying request rejected and deleted successfully');
    }

    //Get the list of Messages waiting for approval
    public function getMessageApprove()
    {
        $messages = Message::where('approved', 0)->orderBy('id', 'desc')->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.approval.message', compact('messages'));
    }


    //Accept this message
    public function getMessageAccept($id)
    {
        $message = Message::find($id);

        Message::where('id', $id)->update(['approved' => 1]);

        if ($message->type = 'reqtobuyer') {
            $msg = ReqToBuyer::find( $message->req_id);
            $msg->approved = 1;
            $msg->save();

            $user = User::where('id',$message->to)->first();
        } elseif ($message->type = 'reqtosupplier') {
            $msg = ReqToSupplier::find( $message->req_id);
            $msg->approved = 1;
            $msg->save();

            $user = User::where('id',$message->to)->first();
        }

        $link = url('dashboard');

        //Send Mail to user notifying the message
        Mail::send('emails.messageapprove', ['name' => $user->company_name,'link'=>$link], function ($m) use ($user) {
            $m->from('admin@sourcingkey.com', 'SourcingKey');

            $m->to($user->email, $user->company_name)->subject('New Message');
        });

        return redirect()->back()->with('success', 'Message approved successfully');
    }

    //Reject and destroy this message
    public function getMessageReject($id)
    {
        $message = Message::find($id);

        Message::destroy($id);

        if ($message->type = 'reqtobuyer') {
            ReqToBuyer::destroy($id);
        } elseif ($message->type = 'reqtosupplier') {
            ReqToSupplier::destroy($id);
        }

        return redirect()->back()->with('success', 'Message rejected and deleted successfully');
    }

    //Accept this inquiry
    public function getInquiryAccept($id)
    {
        ReqToSupplier::where('id', $id)->update(['approved' => 1]);

        return redirect()->back()->with('success', 'Inquiry approved successfully');
    }

    //Reject and destroy this inquiry
    public function getInquiryReject($id)
    {
        ReqToSupplier::destroy($id);

        return redirect()->back()->with('success', 'Inquiry rejected and deleted successfully');
    }

    //Registration Approval Accept from Admin Panel by ADMIN
    public function getAccept($id)
    {
        $user = User::find($id);

        $loginlink = url('auth/login');

        //Send Mail to user notifying the approval
        Mail::send('emails.registrationapprove', ['name' => $user->company_name,'link'=>$loginlink], function ($m) use ($user) {
            $m->from('admin@sourcingkey.com', 'SourcingKey');

            $m->to($user->email, $user->name)->subject('Account Activation');
        });

        //Update approval in DB
        $user->approved = 1;
        $user->save();

        return redirect()->back()->with('success', 'Registration request approved successfully');
    }

    //Registration Approval Rejection from Admin Panel by ADMIN
    public function getReject($id)
    {
        User::destroy($id);

        return redirect()->back()->with('success', 'Registration request rejected and deleted successfully');
    }
}
