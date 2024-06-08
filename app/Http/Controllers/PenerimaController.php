<?php
namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\WargaModel;
use App\Models\PenerimaModel;
use App\Models\BantuanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    // Function Pengajuan Bansos
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Bansos',
            'list'  => ['Home', 'Bansos']
        ];

        $page = (object) [
            'title' => 'Silahkan Daftar Terlebih Dahulu'
        ];

        $activeMenu = 'bansos';

        $bantuan = BantuanModel::all();

        return view('pengajuan.bansos.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bantuan' => $bantuan, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request) 
    {
        $bansos = BansosModel::with('bantuan');
    
        if ($request->id_bantuan) {
            $bansos->where('id_bantuan', $request->id_bantuan);
        }

        return DataTables::of($bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bansoss) {
                if ( $bansoss->tanggal_akhir <= now()) {
                    return '';
                }
                else {
                    $btn = '<a href="'.url('/pengajuan-bansos/create/'.$bansoss->id_bansos).'" class="btn btn-primary btn-sm">Daftar</a>';
                    return $btn;
                }
                
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar menjadi Penerima Bansos',
            'list' => ['Home','Bansos','Daftar Penerima']
        ];

        $page = (object) [
            'title' => 'Isi Formulir Berikut :',
        ];
        
        $activeMenu = 'bansos';
        $id_bansos = request()->segment(3); 
        return view('pengajuan.bansos.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'id_bansos' => $id_bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            //verifikasi data
            'nik' => 'required|string',
            'nokk' => 'required|string',
            'nama' => 'required|string', 
            'pekerjaanx' => 'required|string',
            'pekerjaany' => 'required|string',
            'gajix' => 'required|integer',
            'gajiy' => 'required|integer',
            'kewarganegaraan' => 'required|string',
            //data penerima
            'pln' => 'required|integer',
            'pdam' => 'required|integer',
            'status_kesehatan' => 'required|integer',
            'status_rumah' => 'required|integer',
        ]);
        
        // Hitung nilai pendapatan berdasarkan gajix dan gajiy
        $gajix = $request->input('gajix');
        $gajiy = $request->input('gajiy');
        $average_gaji = ($gajix + $gajiy) / 2;
    
        if ($average_gaji <= 1000000) {
            $pendapatan = 5;
        } elseif ($average_gaji >= 1000000 && $average_gaji <= 1500000) {
            $pendapatan = 4;
        } elseif ($average_gaji >= 1500000 && $average_gaji <= 2000000) {
            $pendapatan = 3;
        } elseif ($average_gaji >= 2000000 && $average_gaji <= 2500000) {
            $pendapatan = 2;
        } else {
            $pendapatan = 1;
        }
        $id_warga = auth()->user()->id_warga;
        // Simpan data ke database
        PenerimaModel::create([
            'pendapatan' => $pendapatan,
            'pln' => $request->pln,
            'pdam' => $request->pdam,
            'status_kesehatan' => $request->status_kesehatan,
            'status_rumah' => $request->status_rumah,
            'id_bansos'=> $request->input('id_bansos'),
            'status'=> $request->input('status'),
            'id_warga' => $id_warga,
        ]);
    
        return redirect('/pengajuan-bansos')->with('success', 'Pendaftaran sukses harap menunggu data selesai di verifikasi');
    }

    // Function Penerima Bansos
    public function show()
    {
        $breadcrumb = (object) [
            'title' => 'Data Pendaftar Bansos',
            'list'  => ['Home', 'Bansos','Pendaftar']
        ];

        $page = (object) [
            'title' => 'Data Para Pendaftar Bansos'
        ];

        $activeMenu = 'penerima';

        $bansos = BansosModel::all();

        return view('admin.penerima.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'activeMenu' => $activeMenu]);
    }

    public function showup(Request $request) 
    {
        
        $user = Auth::user();
        $level = $user->id_level;
        if($level == 2){
            $userRt = $user->rt;
            $penerima1 = PenerimaModel::with(['bansos', 'user'])
            ->whereHas('user', function ($query) use ($userRt) {
            $query->where('rt', $userRt);});

        return DataTables::of($penerima1)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penerimas) {
                $btn = '<a href="' . url('/penerima/accept/' . $penerimas->id_penerima) . '" class="btn btn-success btn-sm">Terima</a> ';
                $btn .= '<a href="' . url('/penerima/reject/' . $penerimas->id_penerima) . '" class="btn btn-danger btn-sm onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Tolak</a> ';
                return $btn;})
            ->rawColumns(['aksi'])
            ->make(true);
        }
        elseif($level == 1){
            $userRw = $user->rw;
            $penerima2 = PenerimaModel::with(['bansos', 'user'])
            ->whereHas('user', function ($query) use ($userRw) {
            $query->where('rw', $userRw);});

        return DataTables::of($penerima2)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penerimas) {
                $btn = '<a href="' . url('/penerima/accept/' . $penerimas->id_penerima) . '" class="btn btn-success btn-sm">Terima</a> ';
                $btn .= '<a href="' . url('/penerima/reject/' . $penerimas->id_penerima) . '" class="btn btn-danger btn-sm onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Tolak</a> ';
                return $btn;})
            ->rawColumns(['aksi'])
            ->make(true);
        }
        

        $penerima = PenerimaModel::with(['bansos', 'user']);
        if ($request->id_bansos) {
            $penerima->where('id_bansos', $request->id_bansos);
        }  
    }
    
    public function accept($id)
    {
        // Mengambil data penerima berdasarkan ID
        $penerima = PenerimaModel::find($id);
    
        if ($penerima) {
            $penerima->status = 'Diterima';
    
            // Mengambil semua data penerima
            $penerimas = PenerimaModel::all();
    
            // Memastikan bahwa tidak ada data penerima yang kosong
            if ($penerimas->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data penerima untuk dihitung.');
            }
    
            // Membuat matriks keputusan
            $matrix = [];
            foreach ($penerimas as $item) {
                $matrix[] = [
                    intval($item->pendapatan),
                    intval($item->status_rumah),
                    intval($item->pln),
                    intval($item->pdam),
                    intval($item->status_kesehatan)
                ];
            }
    
            // Bobot kriteria
            $bobot = [0.30, 0.20, 0.15, 0.20, 0.15];
    
            // Memanggil function Normalisasi
            $Nmatrix = $this->normalisasi($matrix);
    
            // Menghitung nilai EDAS
            $edas = $this->menghitung_edas($Nmatrix, $bobot);
            // Menghitung nilai SAW
            $saw = $this->menghitung_saw($Nmatrix, $bobot);

           // Menyimpan skor ke dalam model
            foreach ($penerimas as $index => $item) {
                $item->skoredas = $edas[$index];
                $item->skoresaw = $saw[$index];
                $item->save();
            }
    
            // Simpan status penerima
            $penerima->save();
    
            return redirect()->back()->with('success', 'Data penerima sudah diterima');
        } else {
            return redirect()->back()->with('error', 'Data penerima tidak ditemukan');
        }
    }
    
    // Function menormalisasi matrix
    private function normalisasi($matrix)
    {
        $kriteria = count($matrix[0]);
        $Nmatrix = [];
    
        for ($j = 0; $j < $kriteria; $j++) {
            $column = array_column($matrix, $j);
            $max_value = max($column);
    
            foreach ($column as $i => $value) {
                $Nmatrix[$i][$j] = $value / $max_value;
            }
        }
        return $Nmatrix;
    }

    // Function hitung skor edas
    private function menghitung_edas($Nmatrix, $bobot)
    {
        $alternatif = count($Nmatrix);
        $kriteria = count($bobot);
        $rata = $this->menghitung_rata($Nmatrix);
        $edas = [];
    
        for ($i = 0; $i < $alternatif; $i++) {
            $pda_sum = 0;
            $nda_sum = 0;
    
            for ($j = 0; $j < $kriteria; $j++) {
                $pda = max(0, $Nmatrix[$i][$j] - $rata[$j]);
                $nda = max(0, $rata[$j] - $Nmatrix[$i][$j]);
    
                $pda_sum += $pda * $bobot[$j];
             $nda_sum += $nda * $bobot[$j];
         }
    
            // Menghitung skor EDAS sebagai rata-rata dari PDA dan NDA
            $edas[$i] = ($pda_sum + (1 - $nda_sum)) / 2;
        }
    
        return $edas;
    }

    // Function hitung skor saw
    private function menghitung_saw($Nmatrix, $bobot)
    {
        $alternatif = count($Nmatrix);
        $kriteria = count($bobot);
        $saw_scores = [];

        for ($i = 0; $i < $alternatif; $i++) {
            $score = 0;

            for ($j = 0; $j < $kriteria; $j++) {
                $score += $Nmatrix[$i][$j] * $bobot[$j];
            }

            $saw_scores[$i] = $score;
        }

        return $saw_scores;
    }

    // Function hitung rata rata
    private function menghitung_rata($Nmatrix)
    {
        $kriteria = count($Nmatrix[0]);
        $alternatif = count($Nmatrix);
        $rata = [];
    
        for ($j = 0; $j < $kriteria; $j++) {
            $sum = 0;
            for ($i = 0; $i < $alternatif; $i++) {
                $sum += $Nmatrix[$i][$j];
            }
            $rata[$j] = $sum / $alternatif;
        }
    
        return $rata;
    }

    public function reject($id)
    {
        $penerima = PenerimaModel::find($id);
        if ($penerima) {
            $penerima->status = 'Ditolak';
            $penerima->save();
        }

        return redirect()->back()->with('success', 'Data penerimma sudah ditolak');
    }
}