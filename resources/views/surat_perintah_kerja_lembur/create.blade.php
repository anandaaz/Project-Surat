@extends('layouts.app')

@section('css')
<style>

.stepwizard-step p {
  margin-top: 10px;
}
.stepwizard-row {
  display: table-row;
}
.stepwizard {
  display: table;
  width: 100%;
  position: relative;
}
.stepwizard-step button[disabled] {
  opacity: 1 !important;
  filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
  top: 14px;
  bottom: 0;
  position: absolute;
  content: " ";
  width: 100%;
  height: 1px;
  background-color: #ccc;
  z-order: 0;
}
.stepwizard-step {
  display: table-cell;
  text-align: center;
  position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Tambah Form Perintah Kerja Lembur</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="row mb-3">
                            <div class="stepwizard">
                              <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                  <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                  <p>Step 1</p>
                                </div>
                                <div class="stepwizard-step">
                                  <a href="#step-2" type="button" class="btn btn-secondary btn-circle" disabled="disabled">2</a>
                                  <p>Step 2</p>
                                </div>
                              </div>
                            </div>
                          </div>

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

                        {!! Form::open(array('route' => 'letters.perintah-kerja-lembur.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
        
                              <div class="form-group">
                                  <label for="">Hari/Tanggal</label>  
                                  {!! Form::date('waktu', '', ['class' => 'form-control']) !!}
                              </div>

                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                              <div class="form-group">
                                  <label for="">Departments</label>  
                                  {!! Form::select('department_id', $departments, [], ['class' => 'form-control select2']) !!}                               
                              </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 ">
                              <div class="form-group">
                                  <label for="">File Evidence</label> <br/>                                   
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFileLang" name="evidence" lang="id">
                                    <label class="custom-file-label text-danger" for="customFileLang">format file: docx, pdf | maksimal 10mb </label>
                                  </div>
                              </div>
                            </div>
                            
                            <div class="col-md-4 col-xs-4 col-sm-4 offset-md-9 offset-xs-9 offset-sm-9 mt-4">
                              <button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button>
                              {!! Form::close() !!}
                            
                              <a href="{{ route('letters.perintah-kerja-lembur.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
