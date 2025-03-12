<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function classify(Request $request)
    {
        $validated = $request->validate([
            'teks' => 'required|string'
        ]);

        $text = escapeshellarg($validated['teks']);
        $scriptPath = base_path('app/Scripts/predict.py');

        $pythonPath = 'C:\\Users\\Ilman\\AppData\\Local\\Programs\\Python\\Python313\\python.exe';
        $command = "{$pythonPath} {$scriptPath} {$text}";
        $result = shell_exec($command);
        $result = trim($result);

        if (str_contains($result, 'Error loading model')) {
            $hasil = 'Terjadi kesalahan saat memuat model';
        } else {
            if ($result === 'POSITIVE') {
                $hasil = 'Positif';
            } elseif ($result === 'NEGATIVE') {
                $hasil = 'Negatif';
            } else {
                $hasil = 'Hasil tidak diketahui';
            }
        }

        return redirect()->route('show.form')->with('hasil', $hasil);
    }
}
