<?php

namespace App\Http\Controllers;

use App\Models\Help;
use App\Models\Aduan;
use App\Models\Respon;
use App\Models\JenisAduan;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\SendEmail;
use DB;

class CrudController extends Controller
{
    public function index()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Pengaduan';
        $table_id = 't_help_aduan';
        return view('crud', compact('subtitle', 'table_id', 'icon'));
    }

    public function listdata()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Daftar Data Pengaduan';

        return view('list', compact('subtitle', 'icon','data'));
    }

    public function create()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Help';
        $aduan = Aduan::all();
        $jenis = JenisAduan::all();
        $bytes = random_bytes(8);
        $nomor = bin2hex($bytes);
        return view("create", compact('subtitle', 'icon','jenis','aduan','nomor'));
    }

    public function edit(Request $request)
    {
        $data = Help::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Help';
        return view('edit', compact('subtitle', 'icon', 'data'));
    }

    public function store(Request $request)
    {
        $data = ($request->all());
        $help = new Help;
        $help->nama = $data['nama'];
        $help->alamat = $data['alamat'];
        $help->telepon = $data['telepon'];
        $help->email = $data['email'];
        $help->save();

        $aduan = new Aduan;
        $aduan->pengadu_id = $help->id;
        $aduan->nomor = $data['nomor'];
        $aduan->jenis_aduan_id = $data['jenis_aduan'];
        $aduan->tanggal = $data['tanggal'];
        $aduan->aduan = $data['pengaduan'];
        $aduan->aduan_foto = $data['foto'];
        $aduan->save();

        $respon = new Respon;
        $respon->aduan_id = $aduan->id;
        $respon->pengadu_id = $help->id;
        $respon->save();
        Mail::to($data['email'])->send(new \App\Mail\SendEmail($data['nomor']));
        return redirect()->route("crud.index")->with(['success' => 'Pengaduan Berhasil']);
    }

    public function update(Request $request)
    {
        $data = Respon::where('id', $request->id)->update([
            'respon' => $request->respon
        ]);
        $table_id = 'm_help_pengadu';
        $subtitle = 'Help';
        $icon = 'ni ni-dashlite';
       return redirect()->route("crud.list")->with(['success' => 'Data Berhasil Diubah']);
    }

    public function search(Request $request)
    {
        $cari= $request->cari;
        $pengaduan = DB::table('t_help_aduan')->where('nomor','like',"%".$cari."%")->paginate(8);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Daftar Data Pengaduan';
        return view('tampilan', ['pengaduan'=>$pengaduan, 'icon'=>$icon, 'subtitle'=>$subtitle]);
    }

}