@extends('layouts.app')

@section('title', $title='Users')
@section('content')
<!-- Page -->
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-inverse bg-primary">
                        <div class="card-block">
                            <h1 class="card-title">Selamat Datang, {{ ucwords(Auth::user()->name) }}</h1>
                            <h3 class="card-title">Have a nice day</h3>
                        </div>
                    </div>
                </div>
            </div>
    <div class="row">
            <div class="col">
                <div class="card card-shadow">
                    <div class="card-block p-10 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-right py-0">
                                <i class="icon fa-users font-size-25"></i>
                            </div>
                            <span class="float-left grey-700 font-size-20">Jumlah Undangan</span>
                        </div>
                        <div class="mb-50 grey-700">
                            <span class="float-left grey-700 font-size-30">{{$undangan->total_undangan}}</span>
                        </div>
                        <div class="grey-500 float-right">
                            <a href="{{url('undangan')}}"><button>Lihat Undangan <i class="fa fa-chevron-circle-right"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-shadow">
                    <div class="card-block p-10 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-right py-0">
                                <i class="icon fa-users font-size-25"></i>
                            </div>
                            <span class="float-left grey-700 font-size-20">Jumlah RSVP</span>
                        </div>
                        <div class="mb-50 grey-700">
                            <span class="float-left grey-700 font-size-30">{{$rsvp->total_rsvp}}</span>
                        </div>
                        <div class="grey-500 float-right">
                            <a href="{{url('rsvps')}}"><button>Lihat RSVP <i class="fa fa-chevron-circle-right"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-shadow">
                    <div class="card-block p-10 pt-10">
                        <div class="clearfix">
                            <div class="grey-800 float-right py-0">
                                <i class="icon fa-bar-chart font-size-25"></i>
                            </div>
                            <span class="float-left grey-700 font-size-20">Jumlah Buku Tamu</span>
                        </div>
                        <div class="mb-50 grey-700">
                            <span class="float-left grey-700 font-size-30">{{$tamu->total_tamu}}</span>
                        </div>
                        <div class="grey-500 float-right">
                            <a href="{{url('bukutamu')}}"><button>Lihat Buku <i class="fa fa-chevron-circle-right"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Page -->
@endsection