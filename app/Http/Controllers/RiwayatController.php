<?php

namespace App\Http\Controllers;

use App\Models\WargaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RiwayatController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Riwayat Warga',
            'list'  => ['Home', 'Riwayat']
        ];

        $page = (object) [
            'title' => 'Riwayat warga yang terdaftar dalam sistem'
        ];

        $activeMenu = 'riwayat';

        $rts = WargaModel::select('rt')->distinct()->get();

        $userLevel = Auth::user()->id_level;

        return view('admin.riwayat.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'rts' => $rts,
            'activeMenu' => $activeMenu,
            'userLevel' => $userLevel
        ]);
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $userLevel = $user->id_level;
        $userRt = $user->rt;

        $warga = WargaModel::with('level')->where('status', '!=', 'Aktif');

        if ($userLevel == 1) {
            if ($request->rt) {
                $warga->where('rt', $request->rt);
            }
        } elseif ($userLevel == 2) {
            $warga->where(function ($query) use ($user, $userRt) {
                $query->where('id_warga', $user->id_warga)
                    ->orWhere('rt', $userRt);
            });
        }

        return DataTables::of($warga)
            ->addIndexColumn()
            ->addColumn('aksi', function ($wargas) {
                $btn = '<a href="' . url('/riwayat/' . $wargas->id_warga) . '" class="btn btn-info btn-sm">Detail</a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(String $id)
    {
        $riwayat = WargaModel::with('level')->where('id_warga', $id)->first();

        $breadcrumb = (object) [
            'title' => 'Detail Warga',
            'list' => [
                'Home',
                'Riwayat',
                'Detail Riwayat'
            ]
        ];

        $page = (object) [
            'title' => 'Detail Warga',
        ];

        $activeMenu = 'riwayat';

        return view('admin.riwayat.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'riwayat' => $riwayat,
            'activeMenu' => $activeMenu
        ]);
    }
}
