@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Form Surat Pertukaran Hari Kerja</h3>
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
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#modalCreateCutiForm" title="Klik untuk mengajukan form pertukaran hari kerja.">Tambahkan Form Pertukaran Hari Kerja</a>                        
                                </div>
                                
                                <div class="d-flex">
                                    <a href="{{ route('letter-types.download', 3) }}" class="btn btn-secondary mr-auto" title="Click to download template pertukaran hari kerja.">Download Template Form</a>                        
                                </div>

                            </div>
                            
                            <hr/>
                        
                            <div class="table-responsive">
                                
                                <table class="table table-striped mt-2">
                                    <thead style="background-color:#6777ef">                                                       
                                        <th style="color:#fff;">NPK</th>
                                        <th style="color:#fff;">Nama</th>
                                        <th style="color:#fff;">Department</th>
                                        <th style="color:#fff;">Tanggal Kerja</th>
                                        <th style="color:#fff;">Tanggal Pertukaran</th>
                                        <th style="color:#fff;">Actions</th>
                                    </thead>  
                                    <tbody>
                                    @foreach ($suratPertukaranHK as $pertukaranHK)
                                    <tr>                           
                                        <td>{{ $pertukaranHK->user->npk }}</td>
                                        <td>{{ $pertukaranHK->user->name }}</td>
                                        <td>{{ $pertukaranHK->user->department->name }}</td>
                                        <td>{{ $pertukaranHK->tanggal_kerja }}</td>
                                        <td>{{ $pertukaranHK->tanggal_pertukaran }}</td>
                                        <td class="p-1">  
                                            <a class="btn btn-secondary text-dark mb-1" href="{{ route('letters.pertukaran-hari-kerja.show',[ $pertukaranHK->id]) }}">Detail</a>
                                            <br/>
                                            @if ($pertukaranHK->evidence !== null) 
                                                <a class="btn btn-success mb-1" href="{{ route('letters.pertukaran-hari-kerja.download',[$pertukaranHK->id]) }}">Download</a>
                                                <br/>
                                            @endif
                                    
                                            @if (request()->user()->hasRole('Admin') || request()->user()->id === $pertukaranHK->user->id)

                                            <a class="btn btn-info mb-1" href="{{ route('letters.pertukaran-hari-kerja.edit',$pertukaranHK->id) }}">{{ $pertukaranHK->evidence == null ? 'Upload Evidence' : 'Edit' }}</a>
                                            <br/>
                                        
                                            {!! Form::open(['method' => 'DELETE','route' => ['letters.pertukaran-hari-kerja.destroy', $pertukaranHK->id],'style'=>'display:inline']) !!}
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
                               {!! $suratPertukaranHK->links() !!} 
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
            {!! Form::open(array('route' => 'letters.pertukaran-hari-kerja.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
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
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Mulai Tanggal</label>                                    
                            {!! Form::date('tanggal_kerja_start_date', null, array('class' => 'form-control', )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Berakhir Tanggal</label>                              
                            {!! Form::date('tanggal_kerja_end_date', null, array('class' => 'form-control', )) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Mulai Jam</label>                                    
                            {!! Form::time('jam_kerja_start_time', null, array('class' => 'form-control', )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Sampai Jam</label>                              
                            {!! Form::time('jam_kerja_end_time', null, array('class' => 'form-control', )) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="">Jumlah Hari Kerja</label>
                            {!! Form::number('jumlah_kerja', 0, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="kondisi_kerja">Kondisi Kerja</label>
                            {!! Form::select('kondisi_kerja', ['Masuk', 'Libur'], 'Masuk', array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Tanggal Pertukaran</label>                                    
                            {!! Form::date('tanggal_pertukaran_start_date', null, array('class' => 'form-control', )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Sampai Tanggal</label>                              
                            {!! Form::date('tanggal_pertukaran_end_date', null, array('class' => 'form-control', )) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md-6"><label for="">Mulai Jam</label>                                    
                            {!! Form::time('jam_pertukaran_start_time', null, array('class' => 'form-control', )) !!}
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label for="">Sampai Jam</label>                              
                            {!! Form::time('jam_pertukaran_end_time', null, array('class' => 'form-control', )) !!}
                        </div>
                    </div>

                     <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="">Jumlah Hari Pertukaran</label>
                            {!! Form::number('jumlah_pertukaran', 0, array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="kondisi_pertukaran">Kondisi Pertukaran</label>
                            {!! Form::select('kondisi_pertukaran', ['Masuk', 'Libur'], 'Masuk', array('class' => 'form-control')) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-12 col">
                            <label for="alasan">Alasan</label>                                    
                            {!! Form::textarea('alasan',null, array('class' => 'form-control', 'style' => "width: 100%; min-height:120px")) !!}
                        </div>
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