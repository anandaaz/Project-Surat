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
                                  <a href="{{ route('letters.perintah-kerja-lembur.edit', $suratPerintahLembur->id) }}" type="button" class="btn btn-secondary btn-circle">1</a>
                                  <p>Identitas Surat</p>
                                </div>
                                <div class="stepwizard-step">
                                  <a href="{{ route('letters.perintah-kerja-lembur.edit-detail', $suratPerintahLembur->id) }}" type="button" class="btn btn-primary btn-circle" disabled="disabled">2</a>
                                  <p>Detail Surat</p>
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

                        {!! Form::model($suratPerintahLembur, array('route' => array('letters.perintah-kerja-lembur.store-detail', $suratPerintahLembur->id),'method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                              <h5>Tambah Data Pegawai Lembur</h5>
                            </div>
                            
                            <div class="col-xs-6 col-sm-6 col-md-6">
                              <div class="form-group">
                                <label for="">NPK - Nama</label>  
                                    {!! Form::select('user_id', $users, [], ['class' => 'form-control select2']) !!}
                              </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                              <div class="form-group">
                                  <label for="">Section</label>                                    
                                  {!! Form::text('section', null, array('class' => 'form-control',)) !!}
                              </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                  <label for="">Pekerjaan yang dilakukan</label>                                  
                                  {!! Form::textarea('pekerjaan', null, array('class' => 'form-control','style' => "width: 100%;")) !!}
                              </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label for="" class="form-label">Jadwal Kerja</label>                                  
                              <div class="form-group row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                  {!! Form::time('jadwal_kerja_start', null, array('class' => 'form-control lembur', 'id' => 'lembur')) !!}
                                </div> 
                                <span> - </span>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                  {!! Form::time('jadwal_kerja_to', null, array('class' => 'form-control',)) !!}
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="">Rencana Lembur</label>                                  
                                <div class="form-group row">
                                  <div class="col-md-3 col-sm-3 col-xs-3">
                                    {!! Form::time('rencana_lembur_start', null, array('class' => 'form-control lembur', 'id' => 'lembur')) !!}
                                  </div> 
                              
                                  <span> - </span>
                                  <div class="col-md-3 col-sm-3 col-xs-3">
                                    {!! Form::time('rencana_lembur_to', null, array('class' => 'form-control',)) !!}
                                  </div>
                                </div>
                                <label for="">Aktual Lembur</label>                                  
                                <div class="form-group row">
                                  <div class="col-md-3 col-sm-3 col-xs-3">
                                    {!! Form::time('aktual_lembur_start', null, array('class' => 'form-control lembur', 'id' => 'lembur')) !!}
                                  </div> 
                                  
                                  <span> - </span>
                                  <div class="col-md-3 col-sm-3 col-xs-3">
                                    {!! Form::time('aktual_lembur_to', null, array('class' => 'form-control',)) !!}
                                  </div>
                                </div>
                            </div>
                           
                            <div class="col-md-4 col-xs-4 col-sm-4 offset-md-9 offset-xs-9 offset-sm-9 mt-4">
                              <button type="submit" class="btn btn-primary">Tambah Data</button>
                              {!! Form::close() !!}
                            
                              <a href="{{ route('letters.perintah-kerja-lembur.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
     
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header">
                     <table>
                      <tr>
                        <td>Hari</td>
                        <td>: {{ $suratPerintahLembur->waktu }}</td>
                      </tr>
                      <tr>
                        <td>Tanggal</td>
                        <td>: {{ $suratPerintahLembur->waktu }}</td>
                      </tr>
                      <tr>
                        <td>Department</td>
                        <td>: {{ $suratPerintahLembur->department->name }} </td>
                      </tr>
                      <tr>
                        <td>Evidence</td>
                        <td>: <a href="#">{{ $suratPerintahLembur->evidence }}</a> </td>
                      </tr>
                     </table>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-md">
                          <thead style="background-color:#6777ef;" align="center">                                                       
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff; " colspan="2" rowspan="1" align="center">
                              Rencana Lembur
                              </th>
                              <th style="color:#fff;" colspan="2" rowspan="1" align="center">Aktual Lembur</th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" colspan="2" rowspan="0"></th>
                          </thead>
                          <thead style="background-color:#6777ef" align="center">                                                       
                              <th style="color:#fff;" rowspan="0">No</th>
                              <th style="color:#fff;" rowspan="0">NPK - Nama</th>
                              <th style="color:#fff;" rowspan="0">Section</th>
                              <th style="color:#fff;" rowspan="0">Pekerjaan</th>
                              <th style="color:#fff;" rowspan="0">Jadwal Kerja</th>
                              <th align="center" style="color:#fff; vertical-align:middle;"  colspan="2">Waktu</th>
                              <th style="color:#fff; vertical-align:middle;" colspan="2" align="center">Waktu</th>
                              <th style="color:#fff;" rowspan="0">Jumlah Jam Lembur (jam)</th>
                              <th style="color:#fff;" colspan="2">Personnel Check</th>
                          </thead>
                          <thead style="background-color:#6777ef">                                                       
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;" align="center" colspan="1">Dari</th>
                              <th style="color:#fff;" align="center" colspan="1">Sampai</th>
                              <th style="color:#fff;" align="center" colspan="1">Dari</th>
                              <th style="color:#fff;" align="center" colspan="1">Sampai</th>
                              <th style="color:#fff;" rowspan="0"></th>
                              <th style="color:#fff;">Jml</th>
                              <th style="color:#fff;">Tul</th>
                            </thead>
                          <tbody>
                          @foreach ($suratPerintahLembur->surat_perintah_lembur_details as $key =>  $perintahLembur)
                          <tr align="center">
                              <td>{{ ++$key }}</td>
                              <td>{{ $perintahLembur->user->npk . ' - ' .  $perintahLembur->user->name }}</td>
                              <td>{{ $perintahLembur->section }}</td>
                              <td>{{ $perintahLembur->pekerjaan }}</td>
                              <td>{{ $perintahLembur->jadwal_kerja_start . ' - ' . $perintahLembur->jadwal_kerja_to }}</td>
                              <td>{{ $perintahLembur->rencana_lembur_start}}</td>
                              <td>{{ $perintahLembur->rencana_lembur_to }}</td>
                              <td>{{ $perintahLembur->aktual_lembur_start}}</td>
                              <td>{{ $perintahLembur->aktual_lembur_to }}</td>
                              <td>{{ $perintahLembur->jumlah_lembur }}</td>
                              <td>{{ $perintahLembur->personal_check_jml }}</td>
                              <td>{{ $perintahLembur->personal_check_tul }}</td>
                              <td style="color:#fff; border: 0pt solid white;">
                                {!! Form::open(['method' => 'DELETE','route' => ['letters.perintah-kerja-lembur.delete-detail', [$suratPerintahLembur->id,$perintahLembur->id]],'style'=>'display:inline']) !!}
                                    {!! Form::submit('X', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                              </td>
                          </tr>
                          @endforeach
                          </tbody>               
                      </table>
                      </div>  

                      
                      <div class="col-md-4 col-xs-4 col-sm-4 offset-md-10 offset-xs-10 offset-sm-10 mt-4">
                        <a href="{{ route('letters.perintah-kerja-lembur.index') }}" class="btn btn-primary">Simpan</a>
                        
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection

@section('scripts')
<script>
  $(function () {
    $('#datetimepicker').datetimepicker({
            format: 'HH:mm'
        });
    });

</script>
    
@endsection
