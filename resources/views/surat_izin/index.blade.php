@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Form Surat Cuti</h3>
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

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row flex justify-content-between">
                                @can('create-department')
                                <div class="d-flex">
                                    <a class="btn btn-warning" data-toggle="modal" data-target="#modalCreateCutiForm" title="Klik untuk mengajukan form cuti.">Tambahkan Form Cuti</a>                        
                                </div>
                                @endcan
                                
                                <div class="d-flex">
                                    <a href="{{ route('letter-types.download', 4) }}" class="btn btn-secondary mr-auto" title="Click to add a new department.">Download Template Form Cuti</a>                        
                                </div>

                            </div>
                            
                            <hr/>
                        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Nama</th>
                                    <th style="color:#fff;">NPK</th>
                                    <th style="color:#fff;">Section</th>
                                    <th style="color:#fff;">Department</th>
                                    <th style="color:#fff;">Tanggal</th>
                                    <th style="color:#fff;">Jam</th>
                                    <th style="color:#fff;">Rencana Kembali</th>
                                    <th style="color:#fff;">Jam</th>
                                    <th style="color:#fff;">Keperluan</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($suratCuti as $cuti)
                                <tr>                           
                                    <td>{{ $cuti->user->npk }}</td>
                                    <td>{{ $cuti->user->name }}</td>
                                    <td>{{ $cuti->user->department->name }}</td>
                                    <td>{{ $cuti->tanggal_evidence ?? '' }}</td>
                                    <td>{{ $cuti->lama_cuti }}</td>
                                    <td class="p-1">   
                                        <a class="btn btn-success mb-1" href="{{ route('surat-cuti.download',[$cuti->user->department->id, $cuti->id]) }}">Download</a>
                                        <br/>
                                        <a class="btn btn-primary mb-1" href="{{ route('surat-cuti.show',$cuti->id) }}">Detail</a>
                                        <br/>
                                        
                                        @can('edit-department')
                                        <a class="btn btn-info mb-1" href="{{ route('surat-cuti.edit',$cuti->id) }}">Edit</a>
                                        @endcan
                                        <br/>
                                        
                                        @can('delete-department')
                                            {!! Form::open(['method' => 'DELETE','route' => ['surat-cuti.destroy', $cuti->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $suratCuti->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('modal')
<div class="modal fade" id="modalCreateCutiForm" tabindex="-1" role="dialog" aria-labelledby="modalCreateCutiFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateCutiFormTitle">Edit Form Izin Meninggalkan Pekerjaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(array('route' => 'surat-cuti.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="">NPK - Nama - Departments</label>  
                        <select class="form-control select2" style="width: 100%" name="user_id" id="user_id">
                            <option value="" disabled>Pilih NPK - Nama - Department</option>    
                            @foreach ($users as $user)                            
                                <option value="{{ $user->id }}" >{{ $user->npk . ' - ' .  $user->name . ' - ' . $user->department->name}} </option>    
                            @endforeach
                        </select>                                 
                    </div>
                    <div class="form-group">
                        <label for="">Section</label>                                    
                        {!! Form::text('section', null, array('class' => 'form-control',)) !!}
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Berangkat Tanggal</label>                                    
                            {!! Form::date('berangkat', null, array('class' => 'form-control', )) !!}
                            {!! Form::time('')}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Rencana Kembali</label>                                    
                            {!! Form::date('kembali', null, array('class' => 'form-control', )) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Keperluan</label>                                    
                        {!! Form::textarea('keperluan',null, array('class' => 'form-control', 'style' => "width: 100%; min-height:120px")) !!}
                    </div>
                     <div class="form-group">
                        <label for="">File Evidence</label>                                    
                        {!! Form::file('evidence', null, array('class' => 'form-control select2', 'style' => "width: 100%")) !!}
                    </div>
                </div>
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            {!! Form::close() !!}
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endpush