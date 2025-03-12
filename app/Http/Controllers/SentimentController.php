<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Log;

class SentimentController extends Controller
{
    public function index()
    {
        return view('sentiment'); // Tampilkan form input
    }

    public function analyze(Request $request)
    {
        $text = $request->input('text');

        // Pastikan input tidak kosong
        if (!$text) {
            return back()->with('error', 'Masukkan teks terlebih dahulu.');
        }

        // Path ke script Python
        $pythonScript = base_path('app/Models/predict.py');
        $pythonPath = 'C:\\Users\\Ilman\\AppData\\Local\\Programs\\Python\\Python313\\python.exe';

        // Pastikan file predict.py ada
        if (!file_exists($pythonScript)) {
            return back()->with('error', 'File predict.py tidak ditemukan.');
        }

        // Jalankan Python
        $process = new Process([$pythonPath, $pythonScript, $text]);
        $process->run();

        // Cek apakah proses berhasil
        if (!$process->isSuccessful()) {
            // Return error output directly to the view
            return back()->with('error', 'Analisis gagal: ' . $process->getErrorOutput());
        }

        // Ambil hasil prediksi dari Python
        $result = trim($process->getOutput());

        // Kembalikan ke halaman dengan hasil
        return view('sentiment', compact('text', 'result'));
    }
}
