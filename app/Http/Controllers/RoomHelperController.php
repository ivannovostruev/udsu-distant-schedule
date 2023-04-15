<?php

namespace App\Http\Controllers;

use App\Utilities\RoomHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomHelperController extends Controller
{
    /**
     * @param Request $request
     * @param RoomHelper $roomHelper
     * @return JsonResponse
     */
    public function getData(Request $request, RoomHelper $roomHelper): JsonResponse
    {
        $data = [
            'currentRooms'      => $roomHelper->getCurrentRooms(),
            'currentTimeslot'   => $roomHelper->getCurrentTimeslot()->name,
            'upcomingRooms'     => $roomHelper->getUpcomingRooms(),
            'upcomingTimeslot'  => $roomHelper->getUpcomingTimeslot()->name,
        ];
        return response()->json($data);
    }
}
