<?php

namespace App\Http\Controllers;

use App\Testimoni;
use App\Category;
use App\Checkout;
use App\FAQ;
use App\Product;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('Image')->orderBy('id', 'desc');
        $category = Category::all();
        if (isset($request->category)) {
            $products->where('id_category', $request->category);
        }

        $settings = [];
        foreach (Settings::all() as $set) {
            $settings[$set->name] = $set->text;
        }
        // $request->session()->forget('cart');
        // dd($request->session()->get('cart'));

        $data = [
            'products' => $products->get(),
            'category' => $category,
            'settings' => $settings,
            'testimoni' => Testimoni::orderBy('order', 'asc')->get(),
            'detail' => false
        ];
        return view('landing', $data);
    }

    public function allProducts(Request $request)
    {
        $products = Product::with(['Image', 'Category'])
            ->orderBy('id', 'desc')
            ->limit(10);
        if (isset($request->category)) {
            $products->where('id_category', $request->category);
        }

        if (isset($request->search)) {
            $products->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->search%");
                $query->orWhereHas('Category', function ($query) use ($request) {
                    $query->where('name', 'LIKE', "%$request->search%");
                });
            });
        }

        return response()->json([
            'data' => $products->paginate(10)
        ]);
    }

    public function checkout($request)
    {
        $judul = Settings::where('name', 'judul')->first();
        $wa = Settings::where('name', 'whatsapp')->first();
        $pesan = "Halo Admin $judul->text, saya ingin memesan | ";
        $total = 0;

        $checkout = new Checkout();
        $checkout->trx_no = "TRX" . rand(1000000000, 99999999999);
        $checkout->data = json_encode($request->session()->get('cart'));


        foreach ($request->session()->get('cart') as $item) {
            $total += $item['harga'] * $item['jumlah'];
            $pesan .= " Produk ( " . $item['category'] . " ) " . $item['name'] . " Jumlah :" . $item['jumlah'] . " Harga : Rp. " . number_format($item['harga'] * $item['jumlah'], 0) . " | ";
        }
        $pesan .= " Total yang harus dibayar Rp . " . number_format($total, 0);

        $checkout->total = $total;
        $checkout->save();


        $pesan .= " Jika sudah melakukan pembayaran, mohon upload bukti transaksi pada link " . url('upload/' . $checkout->trx_no) . " . ";
        $pesan .= " Terimakasih.";



        return redirect()->to('https://api.whatsapp.com/send?phone=62' . $wa->text . '&text=' . $pesan);
    }

    public function addCart(Request $request)
    {
        if ($request->has('empty')) {
            $request->session()->forget('cart');

            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', 'Berhasil mengosongkan keranjang');
            return redirect()->back();
        } else if ($request->has('checkout')) {
            return $this->checkout($request);
        }
        $product = Product::with(['Image', 'Category'])->find($request->id_product);
        $data = $request->session()->has('cart') ? $request->session()->get('cart') : [];
        $filtered = Arr::where($data, function ($value, $key) use ($product) {
            return $value['id'] == $product->id;
        });
        // dd(key($filtered));
        if ($filtered != null) {
            $data[key($filtered)]['jumlah'] += $request->jumlah ?? 1;
        } else {
            array_push($data, [
                'id' => $product->id,
                'name' => $product->name,
                'harga' => $product->harga, 0,
                'image' => $product->Image->image,
                'category' => $product->Category->name,
                'jumlah' => $request->jumlah ?? 1
            ]);
        }
        $request->session()->forget('cart');
        $request->session()->put('cart', $data);
        // $_SESSION['cart'] = $data;
        // dd($request->session()->get('cart'));

        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', 'Berhasil menambah produk ' . $product->name . ' ke keranjang');

        return redirect()->back();
    }

    public function detail(Request $request, $id)
    {
        $products = Product::with(['Image', 'ImageAll', 'Category'])->where('id', $id);
        $category = Category::all();
        if (isset($request->category)) {
            $products->where('id_category', $request->category);
        }

        $settings = [];
        foreach (Settings::all() as $set) {
            $settings[$set->name] = $set->text;
        }

        $product = $products->first();

        if ($product == null) {
            $request->session()->flash('alert', 'danger');
            $request->session()->flash('message', 'Produk tidak ditemukan !');
            return redirect()->route('landing');
        }

        // dd($products->first());

        $data = [
            'product' => $product,
            'category' => $category,
            'settings' => $settings,
            'testimoni' => Testimoni::orderBy('order', 'asc')->get(),
            'detail' => true
        ];
        return view('landing', $data);
    }

    public function upload(Request $request, $trx)
    {

        $settings = [];
        foreach (Settings::all() as $set) {
            $settings[$set->name] = $set->text;
        }

        // dd($products->first());

        $data = [
            'checkout' => Checkout::where('trx_no', $trx)->firstOrFail(),
            'settings' => $settings,
            'category' => Category::all(),
            'detail' => true
        ];
        return view('upload', $data);
    }

    public function aboutUs(Request $request)
    {
        $category = Category::all();

        $settings = [];
        foreach (Settings::all() as $set) {
            $settings[$set->name] = $set->text;
        }

        // dd($products->first());

        $data = [
            'about_us' => Settings::where('name', 'about_us')->first(),
            'category' => $category,
            'settings' => $settings,
            'testimoni' => Testimoni::orderBy('order', 'asc')->get(),
            'detail' => true
        ];
        return view('aboutus', $data);
    }

    public function caraOrder(Request $request)
    {
        $category = Category::all();

        $settings = [];
        foreach (Settings::all() as $set) {
            $settings[$set->name] = $set->text;
        }

        // dd($products->first());

        $data = [
            'data' => Settings::where('name', 'cara_order')->first(),
            'category' => $category,
            'settings' => $settings,
            'detail' => true
        ];
        return view('caraorder', $data);
    }
}
