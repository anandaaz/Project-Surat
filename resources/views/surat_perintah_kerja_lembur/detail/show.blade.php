@extends('layouts.app')

@section('content')
    
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Surat Perintah Kerja Lembur</h3>
</div>
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
                      
                      @unlessrole('Operator')
                      <tr align="right" style="width: 100% !important;">
                        <td align="right">
                          <a href="{{ route('letters.perintah-kerja-lembur.edit', $suratPerintahLembur->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                      </tr>
                      @endunlessrole
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
                              <th style="color:#fff;" rowspan="0">NPK</th>
                              <th style="color:#fff;" rowspan="0">Nama</th>
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
                              <td>{{ $perintahLembur->user->npk }}</td>
                              <td> {{ $perintahLembur->user->name }}</td>
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
                              
                          </tr>
                          @endforeach
                          </tbody>               
                      </table>
                      </div>  
                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection
