@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Edit Form {{ $permohonanSCP->user->name }}</h3>
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

                    {!! Form::model($permohonanSCP, ['method' => 'PUT','route' => ['letters.permohonan-saldo-cuti-pengganti.update', $permohonanSCP->id], 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">
                        <label for="">NPK - Nama - Departments</label>  
                        <input class="form-control" type="text" name="name" id="name" value="{{ $permohonanSCP->user->npk .'-'. $permohonanSCP->user->name . '-' .$permohonanSCP->user->department->name }}" readonly aria-readonly disabled>
                                                        
                    </div>

                    <div class="form-group">
                        <label for="">Section</label>                                    
                        {!! Form::text('section', null, array('class' => 'form-control',)) !!}
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah Hari</label>                                    
                        {!! Form::number('jumlah_hari', null, array('class' => 'form-control select2', 'style' => "width: 100%")) !!}
                    </div>
                   
                    <div class="form-group">
                        <label for="">Alasan</label>                                    
                        {!! Form::textarea('alasan',null, array('class' => 'form-control', 'style' => "width: 100%; min-height:120px")) !!}
                    </div>
                    
                     

                    <div class="form-group">
                        <label for="">File Evidence Saat Ini</label>                                  
                        <br/>
                        <a href="{{ route('letters.permohonan-saldo-cuti-pengganti.download', $permohonanSCP->id) }}">{{ $permohonanSCP->evidence ?? "belum ada file evidence yang diupload" }}</a>
                    </div>

                     <div class="form-group">
                        <label for="">Ganti File Evidence</label>                                    
                        {!! Form::file('evidence', null, array('class' => 'form-control select2', 'style' => "width: 100%")) !!}
                    </div>
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
