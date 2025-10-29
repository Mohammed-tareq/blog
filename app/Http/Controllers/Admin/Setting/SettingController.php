<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingSiteRequest;
use App\Models\Setting;
use App\Utils\ImageManegment;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }


    public function update(SettingSiteRequest $request, $id)
    {

        $request->validated();
        try {
            DB::beginTransaction();
            $setting = Setting::findOrFail($id);
            $logoPath = $setting->logo;
            $faviconPath = $setting->favicon;

            if ($request->hasFile('logo')) {
                $logoPath = $this->checkLogo($request, $setting);
            }
            if ($request->hasFile('favicon')) {
                $faviconPath = $this->checkFav($request, $setting);
            }

            $data = $request->except('_token');
            $data['logo'] = $logoPath;
            $data['favicon'] = $faviconPath;


            $setting->update($data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            noty()->error('Something went wrong');
            return redirect()->back();
        }

        noty()->success('Setting Updated Successfully');
        return redirect()->back();


    }

    private function checkLogo($request, $setting)
    {
        $newPathLogo = ImageManegment::saveImageWithNewName($request->logo, 'settings');
        if ($newPathLogo) {
            ImageManegment::deleteImageFormLocal($setting->logo);
        }
        return $newPathLogo;
    }

    private function checkFav($request, $setting)
    {
        $newPathIcon = ImageManegment::saveImageWithNewName($request->favicon, 'settings');
        if ($newPathIcon) {
            ImageManegment::deleteImageFormLocal($setting->favicon);
        }
        return $newPathIcon;
    }
}
