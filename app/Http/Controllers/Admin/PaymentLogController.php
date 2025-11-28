<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PaymentLogController extends Controller
{
    public function index()
    {
        $logs = PaymentLog::latest()->paginate(30);
        return view('admin.payments.logs', compact('logs'));
    }

    public function show($id)
    {
        $log = PaymentLog::findOrFail($id);
        return view('admin.payments.log_show', compact('log'));
    }

    public function exportPdf()
    {
        $logs = PaymentLog::latest()->get();

        $pdf = Pdf::loadView('admin.payments.logs_pdf', compact('logs'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('mpesa_logs_report.pdf');
    }
}
