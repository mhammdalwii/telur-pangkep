<?php

namespace App\Http\Controllers;

use App\Models\EggBatch;
use Barryvdh\DomPDF\Facade\Pdf; // Import class PDF

class LabelController extends Controller
{
    /**
     * Generate PDF untuk sebuah batch telur.
     */
    public function generatePdf(EggBatch $eggBatch)
    {
        // Load view 'batch_label' dengan data batch yang sesuai
        $pdf = Pdf::loadView('labels.batch_label', ['eggBatch' => $eggBatch]);

        // Tampilkan PDF di browser
        return $pdf->stream('label-' . $eggBatch->batch_code . '.pdf');
    }
}
