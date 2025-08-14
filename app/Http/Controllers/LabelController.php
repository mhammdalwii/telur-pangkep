<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use Barryvdh\DomPDF\Facade\Pdf;

class LabelController extends Controller
{
    /**
     * Generate PDF untuk sebuah batch panen.
     */
    public function generatePanenLabel(Panen $panen)
    {
        // Load view 'panen_label' dengan data panen yang sesuai
        $pdf = Pdf::loadView('labels.panen_label', ['panen' => $panen]);

        // Tampilkan PDF di browser
        return $pdf->stream('label-' . $panen->batch_code . '.pdf');
    }
}
