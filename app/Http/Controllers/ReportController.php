<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Services\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    /**
     * @var ReportService
     */
    private $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function membershipFee(Request $request){
        $startDate = $request->query('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->query('end_date', Carbon::parse($startDate)->endOfMonth()->toDateString());

        if(Carbon::parse($startDate)->greaterThan($endDate)){
            abort(Response::HTTP_BAD_REQUEST, 'Start Date cannot be grater than End Date');
        }

        $report = $this->reportService->getFeesReport($startDate, $endDate, Fee::MEMBERSHIP_FEE);

        return response()->json(['report' => $report]);
    }
}
