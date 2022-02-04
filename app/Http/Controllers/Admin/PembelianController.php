<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pembelian;
use App\Product;
use App\Supplier;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('name')->get();  
        $product = Product::orderBy('name_product')->get();
        $user = User::orderBy('name')->get();
        $users = User::all();
        $pembelians = Pembelian::orderBy('tgl_pembelian', 'desc')->get();
        $total_pembelian_report = Pembelian::where('status', 'Sukses')->sum('total_harga');

        return view('pages.admin.pembelian.index', [
            'suppliers' => $suppliers,
            'product' => $product,
            'user' => $user,
            'users' => $users,
            'pembelians' => $pembelians,
            'total_pembelian_report' => $total_pembelian_report,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function tambah($id)
    {
        $tanggal = Carbon::now()->format('dmY');
        $tanggalAkhir = date('Y-m-d');
        $cek = Pembelian::count();
        if ($cek == 0) {
            $urut = 100001;
            $code = 'Pemb-' . $tanggal . $urut;
        } else {
            $ambil = Pembelian::all()->last();
            $urut = (int)substr($ambil->code, -6) + 1;  
            $code = 'Pemb-' . $tanggal . $urut;      
        }

        $pembelian = new Pembelian();
        $pembelian->code         = $code;
        $pembelian->users_id     =  1;
        $pembelian->tgl_pembelian =  $tanggalAkhir;
        $pembelian->id_supplier  = $id;
        $pembelian->total_item  = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon      = 0;
        $pembelian->bayar       = 0;
        $pembelian->status      = "Pending";
        $pembelian->save();

        session(['id_pembelian' => $pembelian->id_pembelian]);
        session(['id_supplier' => $pembelian->id_supplier]);

        return redirect()->route('pembelian_detail.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
