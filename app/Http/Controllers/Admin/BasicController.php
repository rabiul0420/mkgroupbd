<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Asset;
use App\Models\AssetNote;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\AssetInventory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BasicController extends Controller
{
    public function profile() {
        $user = Auth::user();
        $menus = Menu::with('activities')->get();
        return view('admin.profile',compact('user','menus'));
    }
    public function websiteSettings() {
        return view('admin.basic.website_settings');
    }

    public function updateWebsiteSettings(Request $request){
        $this->validate($request,[
            'company_name' => 'required|string|max:100',
            'email' => 'required|email|max:50',
            'mobile' => 'required|max:20',
            'phone' => 'required|max:20',
            'address' => 'required|string|max:2000',
            'site_slogan' => 'required|string|max:2000',
            'about_us_section_slogan' => 'required|string|max:2000',
            'service_section_slogan' => 'required|string|max:2000',
            'event_section_slogan' => 'required|string|max:2000',
            'team_section_slogan' => 'required|string|max:2000',
            'faq_section_slogan' => 'required|string|max:2000',
            'contact_us_section_slogan' => 'required|string|max:2000',
            'client_section_slogan' => 'required|string|max:2000',
            'newsletter_section_slogan' => 'required|string|max:2000',
            'youtube_video_link' => 'required|string|max:2000',
            'google_map_url' => 'required|string|max:2000',
            'about_us' => 'required|string|max:5000',
            'mission_vission' => 'required|string|max:5000',
            'privacy_policy' => 'required|string|max:5000',
            'why_choose_us' => 'required|string|max:5000',
            'our_commitment' => 'required|string|max:5000',
        ]);
        //return $request;
        $setting_data['company_name'] = $request->company_name ?? '';
        $setting_data['email'] = $request->email ?? '';
        $setting_data['mobile'] = $request->mobile ?? '';
        $setting_data['phone'] = $request->phone ?? '';
        $setting_data['fax'] = $request->fax ?? '';
        $setting_data['address'] = $request->address ?? '';
        $setting_data['site_slogan'] = $request->site_slogan ?? '';
        $setting_data['about_us_section_slogan'] = $request->about_us_section_slogan ?? '';
        $setting_data['service_section_slogan'] = $request->service_section_slogan ?? '';
        $setting_data['event_section_slogan'] = $request->event_section_slogan ?? '';
        $setting_data['team_section_slogan'] = $request->team_section_slogan ?? '';
        $setting_data['faq_section_slogan'] = $request->faq_section_slogan ?? '';
        $setting_data['client_section_slogan'] = $request->client_section_slogan ?? '';
        $setting_data['contact_us_section_slogan'] = $request->contact_us_section_slogan ?? '';
        $setting_data['newsletter_section_slogan'] = $request->newsletter_section_slogan ?? '';
        $setting_data['youtube_video_link'] = $request->youtube_video_link ?? '';
        $setting_data['google_map_url'] = $request->google_map_url ?? '';
        $setting_data['about_us'] = $request->about_us ?? '';
        $setting_data['mission_vission'] = $request->mission_vission ?? '';
        $setting_data['privacy_policy'] = $request->privacy_policy ?? '';
        $setting_data['why_choose_us'] = $request->why_choose_us ?? '';
        $setting_data['our_commitment'] = $request->our_commitment ?? '';
        $setting_data['facebook_url'] = $request->facebook_url ?? '';
        $setting_data['twitter_url'] = $request->twitter_url ?? '';
        $setting_data['linkedin_url'] = $request->linkedin_url ?? '';
        $setting_data['instagram_url'] = $request->instagram_url ?? '';


        $setting_data['about_us_image'] = $request->about_us_image_input;
        if ($request->hasFile('about_us_image')) {
            $file = $request->file('about_us_image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
            $destinationPath = 'uploads/' ;
            $file->move($destinationPath,$fileName);
            $filePath = $destinationPath.$fileName;
            $setting_data['about_us_image'] = $filePath;
        }

        $setting_data['logo'] = $request->logo_input;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
            $destinationPath = 'uploads/' ;
            $file->move($destinationPath,$fileName);
            $filePath = $destinationPath.$fileName;
            $setting_data['logo'] = $filePath;
        }


        $newJsonString = json_encode($setting_data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('/public/assets/json/site_setting.json'), $newJsonString);
        return redirect()->route('admin.website-settings')->with(updateMessage());
    }

    public function assetList() {
        $data = Asset::with('inventories','notes')->first();
        return view('admin.basic.asset_list',compact('data'));
    }

    public function editAsset() {
        $data = Asset::with('inventories')->first();
        $page_title = "Edit Asset";
        $route = route('admin.update-asset');
        return view('admin.basic.asset_edit',compact('data','page_title','route'));
    }

    public function updateAsset(Request $request) {

        $data = Asset::first();
        $data->bank_account_holder_name = $request->bank_account_holder_name;
        $data->bank_name = $request->bank_name;
        $data->bank_branch_name = $request->bank_branch_name;
        $data->bank_account_number = $request->bank_account_number;
        $data->current_balance = $request->current_balance;
        $data->save();
        if(isset($request->item_name) AND sizeof($request->item_name) > 0){
            AssetInventory::truncate();
            foreach($request->item_name as $key => $item){
                $asset_inventory = new AssetInventory();
                $asset_inventory->asset_id = $data->id;
                $asset_inventory->item_name = $request->item_name[$key] ?? "None";
                $asset_inventory->item_quantity = $request->item_quantity[$key] ?? 0;
                $asset_inventory->save();
            }
        }

        if(isset($request->note) AND sizeof($request->note) > 0){
            AssetNote::truncate();
            foreach($request->note as $key => $note){
                $asset_note = new AssetNote();
                $asset_note->asset_id = $data->id;
                $asset_note->note = $request->note[$key] ?? "None";
                $asset_note->save();
            }
        }
        return redirect()->route('admin.asset-list')->with(savedMessage());
    }

    public function notifications() {
        $data = Notification::query();
        $data->where('notification_for',Auth::id());
        $data->when(request()->get('creation_date'),function($query) {
            $data->whereDate('created_at',date('Y-m-d',strtotime(request()->get('creation_date'))));
        });
        $notifications = $data->latest()->paginate(50);
        Notification::where('notification_for',Auth::id())->update(['read_status' => true]);
        return view('admin.notifications',compact('notifications'));
    }
}
