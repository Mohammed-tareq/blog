<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\RelatedSite\RelatedSiteResource;
use App\Http\Resources\Setting\SettingResource;
use App\Models\RelatedSite;
use App\Models\Setting;
use Illuminate\Http\Request;
use function App\Http\Helper\apiResponse;

class SettingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $setting = Setting::first();
        $related_site = $this->relatedSites();
        if(!$setting){
            return apiResponse('404','Setting Not Found');
        }

        $data = [
            'settings' => SettingResource::make($setting),
            'related_sites' => RelatedSiteResource::collection($related_site),
        ];
        return apiResponse('200','Success Reponse', $data);
    }
    private function relatedSites()
    {
        $related_site = RelatedSite::select('name','url')->get();

        if(!$related_site){
            return apiResponse('404','Related Site Not Found');
        }
        return $related_site;
    }
}
