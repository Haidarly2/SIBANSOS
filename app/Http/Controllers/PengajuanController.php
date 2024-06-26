<?php
namespace App\Http\Controllers;

use App\Models\SuratModel;
use App\Models\WargaModel;
use App\Models\PenerimaModel;
use App\Models\PengajuanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    //surat
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Surat',
            'list'  => ['Home', 'Surat']
        ];

        $page = (object) [
            'title' => 'Silahkan Daftar Terlebih Dahulu'
        ];

        $activeMenu = 'pengajuan';
        $penerimaCount = PenerimaModel::where('status', 'Pending')->count();
        $pengajuanCount = pengajuanModel::where('status', 'Pending')->count();
        $user = Auth::user();
        $level = $user->id_level;
        if($level == 1){
            return view('pengajuan.surat.index', ['breadcrumb' => $breadcrumb,'penerimaCount' => $penerimaCount, 'page' => $page, 'activeMenu' => $activeMenu,'pengajuanCount' => $pengajuanCount]);
        }elseif($level == 2){
            $rt_logged_in = Auth::user()->rt;
            $penerimaCount = PenerimaModel::whereHas('user', function($query) use ($rt_logged_in) {
                $query->where('rt', $rt_logged_in);
            })->where('status', 'Pending')->count();
            $pengajuanCount = pengajuanModel::whereHas('warga', function($query) use ($rt_logged_in) {
                $query->where('rt', $rt_logged_in);
            })->where('status', 'Pending')->count();
            return view('pengajuan.surat.index', ['breadcrumb' => $breadcrumb,'penerimaCount' => $penerimaCount, 'page' => $page, 'activeMenu' => $activeMenu,'pengajuanCount' => $pengajuanCount]);
        }else{
            return view('pengajuan.surat.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
        }
    }

    public function list(Request $request) 
    {   
        $user = Auth::user();
        $id_warga = $user->id_warga;
        $surat = PengajuanModel::with('warga', 'surat')->where('id_warga', $id_warga)->get();
        return DataTables::of($surat)
            ->addIndexColumn()
            ->addColumn('aksi', function ($surats) {
              
                if ($surats) {
                    if ($surats->status == 'Pending') 
                    {
                        return '<span>Surat kamu sedang di proses</span>';
                    } elseif ($surats->status == 'Diterima Rt') 
                    {   
                        return '<span>Menunggu persetujuan Pak RW</span>';
                    } elseif ($surats->status == 'Ditolak Rt') 
                    {   
                        return '<span>Surat kamu ' . $surats->status . ', pada ' . $surats->updated_at->format('d-m-Y') . '</span>'; 
                    } elseif ($surats->status == 'Ditolak Rw') 
                    {   
                        return '<span>Surat kamu ' . $surats->status . ', pada ' . $surats->updated_at->format('d-m-Y') . '</span>';
                    } elseif ($surats->status == 'Selesai'){
                        return '<span>Surat dapat diambil</span> <a href="' . url('pengajuan-surat/download/' . $surats->id_pengajuan) . '" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Unduh</a>';
                    }
                }
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Formulir Pengajuan Surat',
            'list' => ['Home','Pengajuan','Formulir']
        ];

        $page = (object) [
            'title' => 'Isi Formulir Berikut :',
        ];
        
        $activeMenu = 'surat';
        
        $surat = SuratModel::all(); 
        return view('pengajuan.surat.create', compact('breadcrumb', 'page', 'surat', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_surat' => 'required|integer',
            'ktp' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'kk' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'bukti_kepimilikan_rumah' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'keterangan' => 'required|string',
            'status' => 'required|string',
        ]);

        // Proses unggah file
        if ($request->hasFile('ktp') && $request->hasFile('kk') && $request->hasFile('bukti_kepimilikan_rumah')) 
        {
                // Mengambil file dari request
                $fileKtp = $request->file('ktp');
                $fileKk = $request->file('kk');
                $fileBukti = $request->file('bukti_kepimilikan_rumah');
                
                $customPath = 'C:/laragon/www/SIBANSOS/storage/app/public/foto/surat';
                // memastikan directory penyimpanan ada, jika tidak,  buat directory
                if (!file_exists($customPath)) {
                    mkdir($customPath, 0755, true);
                }              

                // Menyimpan file KTP
                $fileNameKtp = time() . '_' .$fileKtp->getClientOriginalName();
                $fileKtp->move($customPath, $fileNameKtp);
                $filePathKtp = '/storage/foto/surat' . $fileNameKtp;
    
                // Menyimpan file KK
                $fileNameKk = time() . '_' . $fileKk->getClientOriginalName();
                $fileKk->move($customPath, $fileNameKk);
                $filePathkk = '/storage/foto/surat' . $fileNameKk;
    
                // Menyimpan file Bukti Kepemilikan Rumah
                $fileNameBukti = time() . '_' . $fileBukti->getClientOriginalName();
                $fileBukti->move($customPath, $fileNameBukti);
                $filePathBukti = '/storage/foto/surat' . $fileNameBukti;

        } else {
            return redirect()->back()->withErrors(['error' => 'File KTP, KK, dan Bukti Kepemilikan Rumah diperlukan']);
        }
        
        $id_warga = auth()->user()->id_warga;
        PengajuanModel::create([
            'id_surat' => $request->id_surat,
            'id_warga' => $id_warga,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'ktp' => $filePathKtp,
            'kk' => $filePathkk,
            'bukti_kepimilikan_rumah' => $filePathBukti,
        ]);
            return redirect('/pengajuan-surat')->with('success', 'Data berhasil ditambahkan');
    }
    
    //Pengajuan
    public function show()
    {
        $breadcrumb = (object) [
            'title' => 'Data Pendaftar Surat',
            'list'  => ['Home', 'Surat', 'Pengajuan']
        ];
    
        $page = (object) [
            'title' => 'Data Para Pengajuan Surat Pengantar'
        ];
    
        $activeMenu = 'surat';
    
        $surati = SuratModel::all();
        $penerimaCount = PenerimaModel::where('status', 'Pending')->count();
        $pengajuanCount = pengajuanModel::where('status', 'Pending')->count();
        $user = Auth::user();
        $level = $user->id_level;
        if($level == 1){
        return view('admin.pengajuan.index', ['breadcrumb' => $breadcrumb,'penerimaCount' => $penerimaCount, 'page' => $page, 'surati' => $surati, 'activeMenu' => $activeMenu,'pengajuanCount' => $pengajuanCount]);
        }elseif($level == 2){
            $rt_logged_in = Auth::user()->rt;
            $penerimaCount = PenerimaModel::whereHas('user', function($query) use ($rt_logged_in) {
                $query->where('rt', $rt_logged_in);
            })->where('status', 'Pending')->count();
            $pengajuanCount = pengajuanModel::whereHas('warga', function($query) use ($rt_logged_in) {
                $query->where('rt', $rt_logged_in);
            })->where('status', 'Pending')->count();
            return view('admin.pengajuan.index', ['breadcrumb' => $breadcrumb,'penerimaCount' => $penerimaCount, 'page' => $page, 'surati' => $surati, 'activeMenu' => $activeMenu,'pengajuanCount' => $pengajuanCount]);
        }
    }

    public function showup(Request $request) 
    {
        
        $user = Auth::user();
        $level = $user->id_level;
                

        if($level == 2){
            $userRt = $user->rt;
            $pengajuan2 = PengajuanModel::with(['surat', 'warga'])->where('status','Pending')
            ->whereHas('warga', function ($query) use ($userRt) {
            $query->where('rt', $userRt);});
            if ($request->id_surat) {
                $pengajuan2->where('id_surat', $request->id_surat);
            }

            return DataTables::of($pengajuan2)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pengajuans) {
                $btn = '<a href="' . url('/pengajuan/accept/' . $pengajuans->id_pengajuan) . '" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Terima</a> ';
                $btn .= '<a href="' . url('/pengajuan/reject/' . $pengajuans->id_pengajuan) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');"><i class="fas fa-times"></i> Tolak</a> ';

                
                return $btn;})
            ->rawColumns(['aksi'])
            ->make(true);
        }
        elseif($level == 1){
            $userRw = $user->rw; 
            $pengajuan1 = PengajuanModel::with(['warga', 'surat'])->where('status','Diterima RT')
            ->whereHas('warga', function ($query) use ($userRw) {
            $query->where('rw', $userRw);});
            if ($request->id_surat) {
                $pengajuan1->where('id_surat', $request->id_surat);
            }
            return DataTables::of($pengajuan1)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pengajuans) {
                $btn = '<a href="' . url('/pengajuan/terima/' . $pengajuans->id_pengajuan) . '" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Terima</a> ';
                $btn .= '<a href="' . url('/pengajuan/tolak/' . $pengajuans->id_pengajuan) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');"><i class="fas fa-times"></i> Tolak</a> ';


                return $btn;})
            ->rawColumns(['aksi'])
            ->make(true);
        } 
    }
    
    public function accept($id)
    {
        $pengajuan = PengajuanModel::find($id);
        if ($pengajuan) {
            $pengajuan->status = 'Diterima Rt';
            $pengajuan->save();
        }

        return redirect()->back()->with('success', 'Data Pengajuan Berhasil Diterima');
    }

    public function reject($id)
    {
        $pengajuan = PengajuanModel::find($id);
        if ($pengajuan) {
            $pengajuan->status = 'Ditolak Rt';
            $pengajuan->save();
        }

        return redirect()->back()->with('success', 'Data Pengajuan Berhasil Ditolak');
    }

    public function terima($id)
    {
        $pengajuan = PengajuanModel::find($id);
        if ($pengajuan) {
            $pengajuan->status = 'Selesai';
            $pengajuan->save();
        }

        return redirect()->back()->with('success', 'Data Pengajuan Berhasil Diterima');
    }

    public function tolak($id)
    {
        $pengajuan = PengajuanModel::find($id);
        if ($pengajuan) {
            $pengajuan->status = 'Ditolak Rw';
            $pengajuan->save();
        }

        return redirect()->back()->with('success', 'Data Pengajuan Berhasil Ditolak');
    }

    
    public function download($id_pengajuan)
    {
        // Temukan pengajuan berdasarkan id_pengajuan
        $pengajuan = PengajuanModel::findOrFail($id_pengajuan);
    
        // Temukan jenis surat dari tabel Surat
        $surat = SuratModel::where('id_surat', $pengajuan->id_surat)->first();
    
        // Pastikan surat ditemukan
        if (!$surat) {
            abort(404, 'Surat not found');
        }
    
        // Path file .docx sesuai dengan jenis surat
        $file = storage_path('app/public/files/' . $surat->nama_surat . '.docx');
    
        // Pastikan file ada sebelum diunduh
        if (Storage::exists('public/files/' . $surat->nama_surat . '.docx')) {
            return response()->download($file);
        } else {
            abort(404, 'File not found');
        }
    }
}