@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Form Surat Permohonan Saldo Cuti Pengganti</h3>
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
                                <div class="d-flex">
                                    <a class="btn btn-warning" data-toggle="modal" data-target="#modalCreateCutiForm" title="Klik untuk mengajukan form pertukaran hari kerja.">Tambahkan Form Permohonan Saldo Cuti Pengganti</a>                        
                                </div>
                                
                                <div class="d-flex">
                                    <a href="{{ route('letter-types.download', 4) }}" class="btn btn-secondary mr-auto" title="Click to add a new department.">Download Template Form</a>                        
                                </div>

                            </div>
                            
                            <hr/>
                        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">NPK</th>
                                    <th style="color:#fff;">Nama</th>
                                    <th style="color:#fff;">Department</th>
                                    <th style="color:#fff;">Jumlah Hari</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($suratPermohonSCP as $permohonanSCP)
                                <tr>                           
                                    <td>{{ $permohonanSCP->user->npk }}</td>
                                    <td>{{ $permohonanSCP->user->name }}</td>
                                    <td>{{ $permohonanSCP->user->department->name }}</td>
                                    <td>{{ $permohonanSCP->jumlah_hari }}</td>
                                    <td class="p-1">   
                                        <a class="btn btn-success mb-1" href="{{ route('letters.permohonan-saldo-cuti-pengganti.download',[$permohonanSCP->user->department->id, $permohonanSCP->id]) }}">Download</a>
                                        <br/>
                                        <a class="btn btn-primary mb-1" href="{{ route('letters.permohonan-saldo-cuti-pengganti.show',$permohonanSCP->id) }}">Detail</a>
                                        <br/>
                                        
                                        @can('edit-department')
                                        <a class="btn btn-info mb-1" href="{{ route('letters.permohonan-saldo-cuti-pengganti.edit',$permohonanSCP->id) }}">Edit</a>
                                        @endcan
                                        <br/>
                                        
                                        @can('delete-department')
                                            {!! Form::open(['method' => 'DELETE','route' => ['letters.permohonan-saldo-cuti-pengganti.destroy', $permohonanSCP->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $suratPermohonSCP->links() !!} 
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
          <h5 class="modal-title" id="modalCreateCutiFormTitle">Tambah Form Pertukaran Hari Kerja</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(array('route' => 'letters.permohonan-saldo-cuti-pengganti.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group">
                        <label for="">NPK - Nama - Departments</label>  
                        <select class="form-control user_id" style="width: 100%" name="user_id" id="user_id">
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

                    <div class="form-group">
                        <label for="">Jumlah Hari</label>                                    
                        {!! Form::number('jumlah_hari', null, array('class' => 'form-control select2', 'style' => "width: 100%")) !!}
                    </div>
                   
                    <div class="form-group">
                        <label for="">Alasan</label>                                    
                        {!! Form::textarea('alasan',null, array('class' => 'form-control', 'style' => "width: 100%; min-height:120px")) !!}
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

