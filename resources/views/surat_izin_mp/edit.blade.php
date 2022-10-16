@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Edit Form Izin Meninggalkan Pekerjaan {{ $izinMP->user->name }}</h3>
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

                    {!! Form::model($izinMP, ['method' => 'PUT','route' => ['letters.izin-meninggalkan-pekerjaan.update', $izinMP->id], 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="">NPK - Nama - Departments</label>  
                        <input class="form-control" type="text" name="name" id="name" value="{{ $izinMP->user->npk .'-'. $izinMP->user->name . '-' .$izinMP->user->department->name }}" readonly aria-readonly disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Section</label>                                    
                        {!! Form::text('section', $izinMP->section, array('class' => 'form-control',)) !!}
                    </div>
                    <div class="form-group row">
                                                         
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Berangkat Tanggal</label>   
                            {!! Form::date('berangkat_date', $izinMP->berangkat_date, array('class' => 'form-control datepicker', )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Jam</label>   
                            {!! Form::time('berangkat_time', $izinMP->berangkat_time, array('class' => 'form-control timepicker', )) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Kembali Tanggal</label>                                    
                            {!! Form::date('kembali_date', $izinMP->kembali_date, array('class' => 'form-control tanggal', )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Jam</label>   
                            {!! Form::time('kembali_time', $izinMP->kembali_time, array('class' => 'form-control timepicker', )) !!}
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Keperluan</label>                                    
                        {!! Form::textarea('keperluan',$izinMP->keperluan, array('class' => 'form-control', 'style' => "width: 100%; min-height:120px")) !!}
                    </div>
                  
                     <div class="form-group">
                        <label for="">File Evidence Saat Ini</label>                                  
                        <br/>
                        <a href="{{ route('letters.izin-meninggalkan-pekerjaan.download', $izinMP->id) }}">{{ $izinMP->evidence ?? "belum ada file evidence yang diupload" }}</a>
                    </div>

                     <div class="form-group">
                        <label for="">Ganti File Evidence</label>                                    
                        {!! Form::file('evidence', null, array('class' => 'form-control select2', 'style' => "width: 100%")) !!}
                    </div>
                    
                </div>
            </div>
           
            <button type="submit" class="btn btn-primary">Save</button>
            
                    {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
