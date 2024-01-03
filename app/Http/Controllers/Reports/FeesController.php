<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Services\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeesController extends Controller
{
    /**
     * @var ReportService
     */
    private $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(){
        return view('pages.reports.fees');
    }

    public function membershipFee(Request $request){
        $startDate = $request->query('start_date', now()->startOfYear()->toDateString());
        $endDate = $request->query('end_date', Carbon::parse($startDate)->endOfYear()->toDateString());

        if(Carbon::parse($startDate)->greaterThan($endDate)){
            abort(Response::HTTP_BAD_REQUEST, 'Start Date cannot be greater than End Date');
        }

        $report = $this->reportService->getFeesReport($startDate, $endDate, Fee::MEMBERSHIP_FEE);

        return response()->json(['report' => $report]);
    }

    public function loanProcessingFee(Request $request){
        $startDate = $request->query('start_date', now()->startOfYear()->toDateString());
        $endDate = $request->query('end_date', Carbon::parse($startDate)->endOfYear()->toDateString());

        if(Carbon::parse($startDate)->greaterThan($endDate)){
            abort(Response::HTTP_BAD_REQUEST, 'Start Date cannot be greater than End Date');
        }

        $report = $this->reportService->getFeesReport($startDate, $endDate, Fee::LOAN_PROCESSING_FEE);

        return response()->json(['report' => $report]);
    }
}
