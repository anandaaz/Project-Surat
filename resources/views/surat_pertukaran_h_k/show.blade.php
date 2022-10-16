@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Detail Form Pertukaran Hari kerja {{ $pertukaranHK->user->name }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                    {!! Form::model($pertukaranHK, []) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="">NPK - Nama - Departments</label>  
                        <input class="form-control" type="text" name="name" id="name" value="{{ $pertukaranHK->user->npk .'-'. $pertukaranHK->user->name . '-' .$pertukaranHK->user->department->name }}" readonly aria-readonly disabled>
                                          
                    </div>
                    <div class="form-group">
                        <label for="">Section</label>                                    
                        {!! Form::text('section', null, array('class' => 'form-control', 'disabled', 'readonly')) !!}
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Mulai Tanggal</label>                                    
                            {!! Form::date('tanggal_kerja_start_date', null, array('class' => 'form-control','disabled', 'readonly' )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Berakhir Tanggal</label>                              
                            {!! Form::date('tanggal_kerja_end_date', null, array('class' => 'form-control','disabled', 'readonly' )) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Mulai Jam</label>                                    
                            {!! Form::time('jam_kerja_start_time', null, array('class' => 'form-control','disabled', 'readonly' )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Sampai Jam</label>                              
                            {!! Form::time('jam_kerja_end_time', null, array('class' => 'form-control','disabled', 'readonly' )) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="">Jumlah Hari Kerja</label>
                            {!! Form::number('jumlah_kerja', null, array('class' => 'form-control', 'disabled', 'readonly')) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="kondisi_kerja">Kondisi Kerja</label>
                            {!! Form::select('kondisi_kerja', ['Masuk', 'Libur'], 'Masuk', array('class' => 'form-control', 'disabled', 'readonly')) !!}
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Tanggal Pertukaran</label>                                    
                            {!! Form::date('tanggal_pertukaran_start_date', null, array('class' => 'form-control','disabled', 'readonly' )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Sampai Tanggal</label>                              
                            {!! Form::date('tanggal_pertukaran_end_date', null, array('class' => 'form-control','disabled', 'readonly' )) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Mulai Jam</label>                                    
                            {!! Form::time('jam_pertukaran_start_time', null, array('class' => 'form-control','disabled', 'readonly' )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Sampai Jam</label>                              
                            {!! Form::time('jam_pertukaran_end_time', null, array('class' => 'form-control','disabled', 'readonly' )) !!}
                        </div>
                    </div>

                     <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="">Jumlah Hari Pertukaran</label>
                            {!! Form::number('jumlah_pertukaran', null, array('class' => 'form-control', 'disabled', 'readonly')) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="kondisi_pertukaran">Kondisi Pertukaran</label>
                            {!! Form::select('kondisi_pertukaran', ['Masuk', 'Libur'], 'Masuk', array('class' => 'form-control', 'disabled', 'readonly')) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col">
                            <label for="alasan">Alasan</label>                                    
                            {!! Form::textarea('alasan',null, array('class' => 'form-control','disabled', 'readonly', 'style' => "width: 100%; min-height:120px")) !!}
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">File Evidence Saat Ini</label>                                  
                        <br/>
                        <a href="{{ route('letters.pertukaran-hari-kerja.download', $pertukaranHK->id) }}">{{ $pertukaranHK->evidence ?? 'belum ada file evidence yang diupload' }}</a>
                    </div>

                    
                    <div class="form-group">
    
                        <a href="{{ route('letters.pertukaran-hari-kerja.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
           
                    {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
