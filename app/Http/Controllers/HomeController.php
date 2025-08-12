<?php

namespace App\Http\Controllers;

use App\Models\Store;

use Illuminate\Http\Request;
use App\Models\PriceTrend;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $stores = Store::latest()->take(6)->get();

        // [BARU] Mengambil data harga untuk 6 bulan terakhir
        $priceTrends = PriceTrend::select(
            DB::raw("DATE_FORMAT(date, '%b') as month"),
            DB::raw("AVG(farmer_price) as avg_farmer_price"),
            DB::raw("AVG(distributor_price) as avg_distributor_price")
        )
            ->where('date', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderByRaw("MIN(date)")
            ->get();

        // Memformat data untuk Chart.js
        $priceLabels = $priceTrends->pluck('month');
        $farmerPrices = $priceTrends->pluck('avg_farmer_price');
        $distributorPrices = $priceTrends->pluck('avg_distributor_price');

        // Mengirim semua data ke view
        return view('home', [
            'stores' => $stores,
            'priceLabels' => $priceLabels,
            'farmerPrices' => $farmerPrices,
            'distributorPrices' => $distributorPrices,
        ]);
    }
}
