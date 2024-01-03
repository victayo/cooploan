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

    public function index(){
    }

}
