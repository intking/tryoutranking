<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterTryoutRequest;
use App\Models\Cluster;
use App\Models\RegisterTryout;
use App\Models\Score;
use App\Models\Tryout;
use App\Services\QRCodeServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterTryoutController extends Controller
{
    protected $qrCode;
    protected $qrCode_service;

    public function __construct(QRCodeServiceInterface $qrCode)
    {
        $this->qrCode = $qrCode;

    }

    public function index()
    {
        //

    }

    public function create($id){

        $tryout = Tryout::find($id);
        $clusters = Cluster::all();

        return view('register-to.create')
                ->with('tryout', $tryout)
                ->with('clusters', $clusters);
    }

    public function store(StoreRegisterTryoutRequest $request, $id){
        // RegisterTryout::create($request->validated());

        $tryout = DB::table('tryouts')
            ->where('id', $id)
            ->first();
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['tryout_id'] = $tryout->id;
        $register = RegisterTryout::create($data);

        $score = new Score();
        $score->register_id = $register->id;
        $score->indonesia = 0;
        $score->english = 0;
        $score->mathematic = 0;
        $score->physic = 0;
        $score->biology = 0;
        $score->chemistry = 0;
        $score->geography = 0;
        $score->economy = 0;
        $score->history = 0;
        $score->sociology = 0;
        $score->passing_grade = 0;
        $score->save();

        session()->flash('success', 'Berhasil mendaftar Tryout');
        return redirect()->route('myTryout.index');
        /*
        * use for endroid library
        */
        //return view('register-to.qrcode-lib1', ['qrcode' => $qrcode]);

        /*
        * use for simplesoftwareIO library
        */
        // return view('register-to.qrcode-lib2', ['qrcode' => $qrcode]);

    }

    public function show($id)
    {
        //
        $tryout = Tryout::find($id);
        $participant = RegisterTryout::where('tryout_id', $id)
                                ->first();

        $now = Carbon::now()->toDateTimeString();
        $qrCode = $this->qrCode->generate($participant->tryout_id.'|'.$participant->user_name.'|'.$participant->school_name.'|'.$now);

        return view('register-to.show')
                ->with('tryout', $tryout)
                ->with('qrCode', $qrCode)
                ->with('success', 'Berhasil mendaftar tryout');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
