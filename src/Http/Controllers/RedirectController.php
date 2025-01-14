<?php

namespace Devpri\Tinre\Http\Controllers;

use Carbon\Carbon;
use Devpri\Tinre\Jobs\ProcessClick;
use Devpri\Tinre\Models\Url;
use Illuminate\Http\Request;
use shweshi\OpenGraph\Facades\OpenGraphFacade;

class RedirectController extends Controller
{
    public function redirect(Request $request, $path)
    {
        $path = strtolower($request->path);

        $url = Url::whereRaw('lower(path) = (?)', [$path])->where(['active' => 1])->first();

        if (! $url) {
            return redirect('/');
        }

        $userAgent = $request->header('User-Agent');
        $ip = $request->ip;
        $createdAt = Carbon::now();
        $referer = $request->server('HTTP_REFERER');

        ProcessClick::dispatch($url, $createdAt, $ip, $userAgent, $referer);

        $metaData = OpenGraphFacade::fetch($url->long_url, true);

        return view('tinre::redirect', compact('metaData', 'url'));

//        return redirect($url->long_url, config('tinre.redirect_type', 302));
    }
}
