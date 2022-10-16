@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Form Surat Perintah Lembur</h3>
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
                                    <a class="btn btn-warning" data-toggle="modal" data-target="#modalCreateCutiForm" title="Klik untuk mengajukan form pertukaran hari kerja.">Tambahkan Form Perintah Lembur</a>                        
                                </div>
                                
                                <div class="d-flex">
                                    <a href="{{ route('letter-types.download', 4) }}" class="btn btn-secondary mr-auto" title="Click to add a new department.">Download Template Form</a>                        
                                </div>

                            </div>
                            
                            <hr/>
                        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">waktu</th>
                                    <th style="color:#fff;">NPK</th>
                                    <th style="color:#fff;">Nama</th>
                                    <th style="color:#fff;">Department</th>
                                    <th style="color:#fff;">Jadwal Kerja</th>
                                    <th style="color:#fff;">Rencana Lembur</th>
                                    <th style="color:#fff;">Aktual Lembur</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($suratPerintahLembur as $perintahLembur)
                                <tr>                           
                                    <td>{{ $perintahLembur->waktu }}</td>
                                    <td>{{ $perintahLembur->user->npk }}</td>
                                    <td>{{ $perintahLembur->user->name }}</td>
                                    <td>{{ $perintahLembur->user->department->name }}</td>
                                    <td>{{ $perintahLembur->jadwal_kerja }}</td>
                                    <td>{{ $perintahLembur->rencana_lembur_start . ' - ' . $perintahLembur->rencana_lembur_to }}</td>
                                    <td>{{ $perintahLembur->aktual_lembur_start . ' - ' . $perintahLembur->aktual_lembur_to }}</td>
                                    <td class="p-1">   
                                        <a class="btn btn-success mb-1" href="{{ route('letters.perintah-kerja-lembur.download',[$perintahLembur->user->department->id, $perintahLembur->id]) }}">Download</a>
                                        <br/>
                                        <a class="btn btn-primary mb-1" href="{{ route('letters.perintah-kerja-lembur.show',$perintahLembur->id) }}">Detail</a>
                                        <br/>
                                        
                                        @can('edit-department')
                                        <a class="btn btn-info mb-1" href="{{ route('letters.perintah-kerja-lembur.edit',$perintahLembur->id) }}">Edit</a>
                                        @endcan
                                        <br/>
                                        
                                        @can('delete-department')
                                            {!! Form::open(['method' => 'DELETE','route' => ['letters.perintah-kerja-lembur.destroy', $perintahLembur->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $suratPerintahLembur->links() !!} 
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
            
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endpush