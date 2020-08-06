<?php

namespace Devpri\Tinre\Http\Controllers\Web;

use Carbon\Carbon;
use Devpri\Tinre\Http\Controllers\Controller;
use Devpri\Tinre\Models\Url;
use Devpri\Tinre\Services\StatsService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StatsController extends Controller
{

    protected $statsService;

    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    public function clicks(Request $request, $id)
    {
        $request->validate([
            'date' => ['required', 'array', 'min:2', 'max:2'],
        ]);

        $user = $request->user();

        $url = Url::where('id', $id)->firstOrFail();

        if ($user->cant('view', $url)) {
            abort(401);
        }

        $data = $this->statsService->getClicks($id, $request->date);

        return response()->json(['data' => $data]);
    }

    public function data(Request $request, $id, $column)
    {
        $request->validate([
            'date' => ['required', 'array', 'min:2', 'max:2'],
        ]);

        if (!in_array($column, ['country', 'region', 'city', 'device_type', 'device_brand', 'device_model', 'os', 'browser', 'referer', 'referer_host'])) {
            throw ValidationException::withMessages([
                'column' => [__('Unsupported column.')],
            ]);
        }

        $user = $request->user();

        $url = Url::where('id', $id)->firstOrFail();

        if ($user->cant('view', $url)) {
            abort(401);
        }

        $data = $this->statsService->getData($column, $id, $request->date);

        return response()->json($data);
    }
}
