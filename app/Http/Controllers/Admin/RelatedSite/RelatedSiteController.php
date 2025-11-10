<?php

namespace App\Http\Controllers\Admin\RelatedSite;

use App\Http\Controllers\Controller;
use App\Models\RelatedSite;
use Illuminate\Http\Request;

class RelatedSiteController extends Controller
{
    public function index()
    {
        $relatedSites = RelatedSite::query()->latest()->paginate(10);
        return view('admin.related-site.index', compact('relatedSites'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|unique:related_sites,name,' . $id,
            'url' => 'string|unique:related_sites,url,' . $id,
        ]);

        $site = RelatedSite::where('id', $id)->first();
        if(!$site){
            noty()->error('Site not found');
            return  redirect()->back();
        }

        $site->update($request->only('name', 'url'));
        noty()->success('Site Updated Successfully');
        return redirect()->route('admin.setting.site.index');

    }

    public function delete($id)
    {
        $site = RelatedSite::whereId($id)->first();
        if(!$site){
            noty()->error('Site not found');
            return  redirect()->back();
        }
        $site->delete();
        noty()->success('Site Deleted Successfully');
        return redirect()->route('admin.setting.site.index');
    }
}
