<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Validator;
use App\Helpers\Helper;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Inqury;
use Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_data = Blog::latest()->take(6)->get();
        return view('front.index',compact('blog_data'));
    }

    public function blog()
    {
        $blog_data = Blog::all();
        return view('front.blog',compact('blog_data'));
    }

    public function blog_single($id)
    {
        $blog_data = Blog::find($id);
        return view('front.blog_single',compact('blog_data'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function product()
    {
        $product_datas = Product::latest()->paginate(2);
        // dd($product_data);
        return view('front.product',compact('product_datas'));
    }

    public function productMail(Request $request,$id){
        $data = $request->toarray();
        Mail::send('mail.sendProduct',['data' => $data], function($message) use ($data) {
            $message->to('info@apurvawater.com', 'Apurva water solution')->subject('Apurva water solution');
        });

       return redirect()->route('front.thankyou');
    }

    public function thankyou()
    {
        return view('front.thankyou');
    }

    public static function contactInqury(Request $request){
        try{       
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'details' => 'required',
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            
            $data = Inqury::createInqury($request);

            Mail::send('mail.sendContact',['data' => $data], function($message) use ($data) {
                $message->to('info@apurvawater.com', 'Apurva water solution')->subject('Apurva water solution');
            });

            session()->flash('success',  trans('messages.inquryCreated'));
            return redirect()->route('front.home');
        }catch(\Exception $e){                  
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }

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
