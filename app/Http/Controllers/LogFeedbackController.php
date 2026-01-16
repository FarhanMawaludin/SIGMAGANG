<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LogMingguan;
use App\Models\LogHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;

class LogFeedbackController extends Controller
{
    // Check if weekly log is complete
    private function isWeeklyLogComplete(LogMingguan $log)
    {
        $startDate = Carbon::parse($log->tanggal_awal);
        $endDate = Carbon::parse($log->tanggal_akhir);
        $days = $startDate->diffInDays($endDate) + 1;
        
        return $log->logHarians->count() >= $days;
    }

    // Show mahasiswa feedback form
    public function showMahasiswaFeedback(LogMingguan $log)
    {
        if (!$this->isWeeklyLogComplete($log)) {
            return redirect()->back()->with('error', 'Log mingguan belum lengkap');
        }

        return view('logs.mahasiswa_feedback', compact('log'));
    }

    // Store mahasiswa feedback
    public function storeMahasiswaFeedback(Request $request, LogMingguan $log)
    {
        if (!$this->isWeeklyLogComplete($log)) {
            return redirect()->back()->with('error', 'Log mingguan belum lengkap');
        }

        $request->validate([
            'mahasiswa_feedback' => 'required|string',
        ]);

        $log->update([
            'mahasiswa_feedback' => $request->mahasiswa_feedback,
            'status' => 'completed',
        ]);

        return redirect()->route('logs.index')->with('success', 'Feedback berhasil disimpan');
    }

    // Show dosen evaluation form
    public function showDosenEvaluation(LogMingguan $log)
    {
        if (!Auth::user()->hasRole('dosen')) {
            abort(403);
        }

        if ($log->status !== 'completed') {
            return redirect()->back()->with('error', 'Log mingguan belum selesai');
        }

        return view('logs.dosen_evaluation', compact('log'));
    }

    // Store dosen evaluation
    public function storeDosenEvaluation(Request $request, LogMingguan $log)
    {
        if (!Auth::user()->hasRole('dosen')) {
            abort(403);
        }

        $request->validate([
            'dosen_feedback' => 'required|string',
            'evaluasi_nilai' => 'required|integer|min:0|max:100',
            'evaluasi_komentar' => 'required|string',
        ]);

        $log->update([
            'dosen_feedback' => $request->dosen_feedback,
            'evaluasi_nilai' => $request->evaluasi_nilai,
            'evaluasi_komentar' => $request->evaluasi_komentar,
            'status' => 'evaluated',
        ]);

        return redirect()->route('logs.index')->with('success', 'Evaluasi berhasil disimpan');
    }

    // Generate PDF report
    public function exportToPDF(LogMingguan $log)
    {
        $log->load(['pengajuan', 'pengajuan.mahasiswa', 'pengajuan.lowongan', 'logHarians']);

        $pdf = PDF::loadView('logs.pdf.report', compact('log'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('log-mingguan-' . $log->id . '.pdf');
    }
}
