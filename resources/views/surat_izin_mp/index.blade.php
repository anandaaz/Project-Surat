@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Form Surat Izin Meninggalkan Pekerjaan</h4>
        </div>

        @include('layouts.partials.alert')

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
                                <div class="d-flex">
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#modalCreateCutiForm" title="Klik untuk mengajukan form cuti.">Tambahkan Form Izin Meninggalkan Pekerjaan</a>                        
                                </div>
                                
                                <div class="d-flex">
                                    <a href="{{ route('letter-types.download', 1) }}" class="btn btn-secondary text-dark" title="Click to download Form.">Download Template Form</a>                        
                                </div>

                            </div>
                            
                            <hr/>
                        
                            <div class="table-respon">
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">NPK</th>
                                    <th style="color:#fff;">Nama</th>
                                    <th style="color:#fff;">Section</th>
                                    <th style="color:#fff;">Department</th>
                                    <th style="color:#fff;">Berangkat</th>
                                    <th style="color:#fff;">Kembali</th>
                                    <th style="color:#fff;">Keperluan</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($suratIzinMP as $izinMP)
                                <tr>                           
                                    <td>{{ $izinMP->user->npk }}</td>
                                    <td>{{ $izinMP->user->name  }}</td>
                                    <td>{{ $izinMP->section }}</td>
                                    <td>{{ $izinMP->user->department->name }}</td>
                                    <td>{{ $izinMP->berangkat }}</td>
                                    <td>{{ $izinMP->kembali }}</td>
                                    <td>{{ $izinMP->keperluan }}</td>
                                    <td class="p-1">  
                                        @if ($izinMP->evidence !== null)
                                            <a class="btn btn-success mb-1" href="{{ route('letters.izin-meninggalkan-pekerjaan.download',[$izinMP->id]) }}">Download</a>
                                        @endif 
                                        <br/>
                                        
                                        @if (request()->user()->hasRole('Admin') || request()->user()->id === $izinMP->user->id)
                                            
                                        <a class="btn btn-info mb-1" href="{{ route('letters.izin-meninggalkan-pekerjaan.edit',$izinMP->id) }}">{{ $izinMP->evidence == null ? 'Upload Evidence' : 'Edit' }}</a>
                                        <br/>   
                                        
                                            {!! Form::open(['method' => 'DELETE','route' => ['letters.izin-meninggalkan-pekerjaan.destroy', $izinMP->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>
                        </div>
                            <div class="pagination justify-content-end">
                                @role('Admin')
                                {!! $suratIzinMP->links() !!} 
                                @endrole
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('modal')
<div class="modal fade" id="modalCreateCutiForm" role="dialog" aria-labelledby="modalCreateCutiFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateCutiFormTitle">Tambah Form Izin Meninggalkan Pekerjaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(array('route' => 'letters.izin-meninggalkan-pekerjaan.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="">Pilih NPK - Nama - Departments</label>  
                        <select style="width: 100% !important" name="user_id" id="user_id"  class="form-control user_id">
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
                                                         
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Berangkat Tanggal</label>   
                            {!! Form::date('berangkat_date', null, array('class' => 'form-control datepicker', )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Jam</label>   
                            {!! Form::time('berangkat_time', null, array('class' => 'form-control timepicker', )) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Kembali Tanggal</label>                                    
                            {!! Form::date('kembali_date', null, array('class' => 'form-control tanggal', )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Jam</label>   
                            {!! Form::time('kembali_time', null, array('class' => 'form-control timepicker', )) !!}
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

@section('scripts')
<script>
    $(document).ready(function() {
        $(".user_id").select2({
            dropdownParent: $("#modalCreateCutiForm"),
        });
    });
</script>
@endsection