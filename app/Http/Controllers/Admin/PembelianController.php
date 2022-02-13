<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pembelian;
use App\PembelianDetail;
use App\Product;
use App\Supplier;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

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
        $pembelian = Pembelian::findOrFail($request->id_pembelian);
        $pembelian->users_id = $request->users_id;
        $pembelian->tgl_pembelian = $request->tgl_pembelian;
        $pembelian->total_item = $request->total_item;
        $pembelian->total_harga = $request->total;
        $pembelian->diskon = $request->diskon;
        $pembelian->bayar = $request->bayar;
        $pembelian->status ='Success';
        $pembelian->update();

        $detail = PembelianDetail::where('id_pembelian', $pembelian->id_pembelian)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->id_produk);
            $product->stok += $item->jumlah;
            $product->berat = $item->berat;
            $product->update();
        }

        return redirect()->route('pembelian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function detail($id)
    {
        $detail = PembelianDetail::with('product')->where('id_pembelian', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('code', function ($detail) {
                return '<span class="label label-success">'. $detail->code .'</span>';
            })
            ->addColumn('tanggal', function ($detail) {
                return date($detail->created_at, false);
            })
            ->addColumn('name', function ($detail) {
                return $detail->product->name_product;
            })
            ->addColumn('harga_beli', function ($detail) {
                return 'Rp'. number_format($detail->harga_beli);
            })
            ->addColumn('jumlah', function ($detail) {
                return number_format($detail->jumlah);
            })
            ->addColumn('berat', function ($detail) {
                return number_format($detail->berat).' '. $detail->product->satuan_berat;
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp'. number_format($detail->subtotal);
            })
            ->rawColumns(['code'])
            ->make(true);
    }


    public function show($id)
    {
        $pembelian = Pembelian::find($id);

        return response()->json($pembelian);
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
        $pembelian = Pembelian::find($id);
        $detail    = PembelianDetail::where('id_pembelian', $pembelian->id_pembelian)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->id_produk);
            if ($product) {
                $product->stok -= $item->jumlah;
                $product->update();
            }
            $item->delete();
        }

        $pembelian->delete();

        return redirect()->route('pembelian.index');
    }

    public function print($id)
    {
        // $setting = Setting::first();
        $pembelian = Pembelian::find($id);
            if (! $pembelian) {
                abort(404);
            }
        $detail = PembelianDetail::where('id_pembelian', $id)
            ->get(); 
        $customPaper = array(0,0,615,936);
        $pdf = PDF::loadView('pages.admin.pembelian.nota_besar',[
            // 'setting' => $setting,
            'pembelian' => $pembelian,
            'detail' => $detail,
            
        ])->setPaper($customPaper, 'potrait')->setWarnings(false);

        // ->setPaper('f4', 'portrait')

        return $pdf->stream('Pembelian-'. date('Y-m-d-his') .'.pdf');
    }
}
