<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ContentController extends Controller
{

    // Company Profile 
    public function edit()
    {
        $company = CompanyProfile::first();
        return view('admin.content.profile', compact('company'));
    }

    public function update(Request $request, CompanyProfile $company)
    {
        $request->validate([
            'company_name' => 'required|max:50',
            'email' => 'required|email',
            'phone_1' => 'required',
            'address' => 'required|string',
            'logo' => 'mimes:jpg,jpeg,png,bmp',
        ]);

        // Image Update 
        $companyLogo = '';
        if ($request->hasFile('logo')) {
            if (!empty($company->logo) && file_exists($company->logo)) {
                unlink($company->logo);
            }
            $companyLogo = $this->imageUpload($request, 'logo', 'uploads/logo/');
        } else {
            $companyLogo = $company->logo;
        }
        $company->company_name = $request->company_name;
        $company->email = $request->email;
        $company->phone_1 = $request->phone_1;
        $company->phone_2 = $request->phone_2;

        $company->office_time = $request->office_time;
        $company->free_shipping = $request->free_shipping;
        $company->cashback = $request->cashback;

        $company->address = $request->address;
        $company->facebook = $request->facebook;
        $company->youtube = $request->youtube;
        $company->linkedin = $request->linkedin;
        $company->instagram = $request->instagram;
        $company->news_headline = $request->news_headline;
        $company->updated_by = Auth::user()->id;
        $company->logo = $companyLogo;
        $company->save();
        if ($company) {
            Session::flash('success', 'Company Profile Update Successfully');
            return redirect()->back();
        }
        return redirect()->back();
    }

    //Welcome note
    public function welcome(CompanyProfile $company)
    {
        $company = CompanyProfile::first();
        return view('admin.content.welcome', compact('company'));
    }

    // Welcome data update
    public function welcomeUpdate(Request $request)
    {
        $this->validate($request, [
            'welcome_title' => 'required|max:200',
        ]);
        $company = CompanyProfile::first();
        $company->welcome_title = $request->welcome_title;
        $company->welcome_note = $request->welcome_note;
        $company->updated_by = Auth::user()->id;
        if ($request->hasFile('welcome_image')) {
            $image_path = public_path($company->welcome_image);
            @unlink($image_path);
            $company->welcome_image = $this->imageUpload($request, 'welcome_image', 'uploads/welcome');
        }

        $company->save();
        return back()->with('success', 'welcome note updated successfully.');
    }
    //service function
    public function service()
    {
        return view('admin.service.service');
    }
    public function banner()
    {
        return view('admin.banner.banner');
    }
    public function aboutUs()
    {
        $company = CompanyProfile::first();
        return view('admin.content.about_us', compact('company'));
    }
    // about data update
    public function aboutUpdate(Request $request)
    {
        $company = CompanyProfile::first();
        $about_image = '';
        if ($request->hasFile('about_image')) {
            if (!empty($company->about_image) && file_exists($company->about_image)) {
                unlink($company->about_image);
            }
            $about_image = $this->imageUpload($request, 'about_image', 'uploads/about/');
        } else {
            $about_image = $company->about_image;
        }

        $company->about_image       = $about_image;
        $company->about_title       = $request->about_title;
        $company->about_description = $request->about_description;
        $company->save();
        return back()->with('success', 'welcome note updated successfully.');
    }
    public function mission(Request $request)
    {
        $company = CompanyProfile::first();
        return view('admin.content.mission', compact('company'));
    }

    // mission vission data update
    public function missionUpdate(Request $request)
    {
        $company = CompanyProfile::first();
        $company->mission_vision_title = $request->mission_vision_title;
        $company->mission_vision = $request->mission_vision;
        $company->trams_condition_title = $request->trams_condition_title;
        $company->trams_condition = $request->trams_condition;
        $company->save();
        return back()->with('success', 'Mission Vission & term condition updated successfully');
    }
    public function refund(CompanyProfile $company)
    {
        $company = CompanyProfile::first();
        return view('admin.content.refund', compact('company'));
    }
    public function refundUpdate(Request $request)
    {
        $company = CompanyProfile::first();
        $company->refund_title = $request->refund_title;
        $company->refund_details = $request->refund_details;
        $company->save();
        return back()->with('success', 'Refund data updated successfully');
    }
    public function faq()
    {
        $company = CompanyProfile::first();
        return view('admin.content.faq', compact('company'));
    }
    public function faqUpdate(Request $request)
    {
        $company = CompanyProfile::first();
        $company->faq_title = $request->faq_title;
        $company->faq_details = $request->faq_details;
        $company->save();
        return back()->with('success', 'FAQ data updated successfully');
    }

    public function adminPhone(){
        return  view('admin.permission.admin_mobile');
    }
    public function adminPhoneUpdate(Request $request){
        $this->validate($request, [
            'phone_3' => 'required|max:11',
            'phone_4' => 'required|max:11',
            'phone_5' => 'required|max:11',
        ]);
        $company = CompanyProfile::first();
        $company->phone_3 = $request->phone_3;
        $company->phone_4 = $request->phone_4;
        $company->phone_5 = $request->phone_5;
        $company->save();
        return back()->with('success', 'Admin Phone Updated Successfully');
    }

    public function userPhone(){
        return  view('admin.permission.user_mobile');
    }
    public function userPhoneUpdate(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'phone_6' => 'required|max:11',
            'phone_7' => 'required|max:11',
        ]);
        $company = CompanyProfile::first();
        $company->phone_6 = $request->phone_6;
        $company->phone_7 = $request->phone_7;
        $company->save();
        return back()->with('success', 'User Phone Updated Successfully');
    }
}
