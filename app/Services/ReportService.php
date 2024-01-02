<?php

namespace App\Services;

use App\Models\Fee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService extends Service
{
    private const FEES_TABLE = 'fees';

    /**
     * Generates the Fees report
     * @param string $startDate
     * @param string $endDate
     * @param string $type can either be membership fee or loan processing fee
     * @return array
     */
    public function getFeesReport($startDate, $endDate, $type)
    {
        $membershipFees = DB::table(self::FEES_TABLE)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->where('type', $type)
        ->orderBy('created_at', 'desc')->get();

        $report = [];
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        // Get all the months between the start date and end date. Initialize the report data
        while ($startDate->lte($endDate)) {
            $month = $startDate->format('F Y');
            $report[$month] = [
                'month' => $month,
                'employees' => 0,
                'amount' => 0
            ];
            $startDate->addMonth();
        }

        foreach ($membershipFees as $membershipFee) {
            $createdDate = Carbon::parse($membershipFee->created_at)->format('F Y');
            $report[$createdDate]['employees'] += 1;
            $report[$createdDate]['amount'] +=  $membershipFee->fee;
        }

        return array_values($report);
    }
}
