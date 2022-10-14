@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Form Surat Penyimpangan Kehadiran</h3>
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
                                    <a class="btn btn-warning" data-toggle="modal" data-target="#modalCreateCutiForm" title="Klik untuk mengajukan form pertukaran hari kerja.">Tambahkan Form Surat Penyimpangan Kehadiran</a>                        
                                </div>
                                
                                <div class="d-flex">
                                    <a href="{{ route('letter-types.download', 5) }}" class="btn btn-secondary mr-auto" title="Click to add a new department.">Download Template Form</a>                        
                                </div>

                            </div>
                            
                            <hr/>
                        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">NPK</th>
                                    <th style="color:#fff;">Nama</th>
                                    <th style="color:#fff;">Department</th>
                                    <th style="color:#fff;">Jenis Penyimpangan</th>
                                    <th style="color:#fff;">Jam Masuk</th>
                                    <th style="color:#fff;">Jam Pulang</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($suratPenyimpanganKehadiran as $penyimpanganKehadiran)
                                <tr>                           
                                    <td>{{ $penyimpanganKehadiran->user->npk }}</td>
                                    <td>{{ $penyimpanganKehadiran->user->name }}</td>
                                    <td>{{ $penyimpanganKehadiran->user->department->name }}</td>
                                    <td>{{ $penyimpanganKehadiran->jenis_penyimpangan}}</td>
                                    <td>{{ $penyimpanganKehadiran->jam_masuk ?? ' - ' }}</td>
                                    <td>{{ $penyimpanganKehadiran->jam_pulang ?? ' - '}}</td>
                                    <td class="p-1">   
                                        <a class="btn btn-success mb-1" href="{{ route('letters.penyimpangan-kehadiran.download',[$penyimpanganKehadiran->user->department->id, $penyimpanganKehadiran->id]) }}">Download</a>
                                        <br/>
                                        <a class="btn btn-primary mb-1" href="{{ route('letters.penyimpangan-kehadiran.show',$penyimpanganKehadiran->id) }}">Detail</a>
                                        <br/>
                                        
                                        @can('edit-department')
                                        <a class="btn btn-info mb-1" href="{{ route('letters.penyimpangan-kehadiran.edit',$penyimpanganKehadiran->id) }}">Edit</a>
                                        @endcan
                                        <br/>
                                        
                                        @can('delete-department')
                                            {!! Form::open(['method' => 'DELETE','route' => ['letters.penyimpangan-kehadiran.destroy', $penyimpanganKehadiran->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $suratPenyimpanganKehadiran->links() !!} 
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
            {!! Form::open(array('route' => 'letters.penyimpangan-kehadiran.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
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
                        <div class="col-xs-6 col-sm-6 col-md" id='jadwal_start'>
                            <label for="">Mulai Tanggal</label>
                            {!! Form::date('jadwal_start', null, array('class' => "form-control")) !!}
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md" id="jadwal_end">
                            <label for="">Sampai Tanggal</label>
                            {!! Form::date('jadwal_end', null, array('class' => "form-control")) !!}
                        </div>
                    </div>
                   

                    <div class="form-group">
                        <label for="">Jenis Penyimpangan</label>
                        {!! Form::select('jenis_penyimpangan', ['Terlambat Hadir' => 'Terlambat Hadir Alasan Pribadi / Dinas', 'Pulang Lebih Awal' => 'Pulang Lebih Awal Alasan Pribadi / Dinas', 'Tidak Absen' => "Tidak Absen"], 'Terlambat Hadir', array('class' => "form-control", 'id' => 'jenis_penyimpangan')) !!}
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6 col-sm-6 col-md" id='jam_masuk'>
                            <label for="">Masuk Jam</label>
                            {!! Form::time('jam_masuk', null, array('class' => "form-control")) !!}
                        </div>
                        
                        <div class="col-xs-6 col-sm-6 col-md" id="jam_pulang">
                            <label for="">Pulang Jam</label>
                            {!! Form::time('jam_pulang', null, array('class' => "form-control")) !!}
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="">Alasan</label>                                    
                        {!! Form::textarea('alasan',null, array('class' => 'form-control', 'style' => "width: 100%; min-height:120px")) !!}
                    </div>
                 
                     <div class="form-group">
                        <label for="">File Evidence</label>                                    
                        {!! Form::file('evidence', null, array('class' => 'form-control', 'style' => "width: 100%")) !!}
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

        const JENIS_PENYIMPANGAN = document.getElementById("jenis_penyimpangan");

        // start manipulate element jam masuk jam pulang
        const hideJamMasuk = () => {
            document.getElementById('jam_masuk').setAttribute('class', 'col-xs-6 col-md-6 col-sm-6 d-none');
            document.getElementById('jam_masuk').value = null;
        }

        const hideJamPulang = () => {
            document.getElementById('jam_pulang').setAttribute('class', 'col-xs-6 col-md-6 col-sm-6 d-none');
            document.getElementById('jam_pulang').value = null;
        }
        const showJamMasuk = () => {
            document.getElementById('jam_masuk').setAttribute('class', 'col-xs-6 col-md-6 col-sm-6');
        }

        const showJamPulang = () => {
            document.getElementById('jam_pulang').setAttribute('class', 'col-xs-6 col-md-6 col-sm-6');
        }

        // finish manipulate element jam masuk jam pulang

        // fungsi reset element jam masuk dan jam pulang
        const resetJamMasukJamPulang = () => {
            hideJamMasuk();
            hideJamPulang();
        }

        // fungsi cek jenis penyimpangan
        const checkJenisPenyimpangan = () => {
            switch (JENIS_PENYIMPANGAN.value) {
                case 'Terlambat Hadir':
                    showJamMasuk();
                    break;
            
                case 'Pulang Lebih Awal':
                    showJamPulang();
                    break;
            
                case 'Tidak Absen':
                    showJamMasuk();
                    showJamPulang();
                    break;
                default:
                    break;
            }
        }
        
        // check jika jenis penyimpangan diganti
        JENIS_PENYIMPANGAN.addEventListener('change', () => {
            //reset value dan hide element jam
            resetJamMasukJamPulang();
            // check perubahan jenis penyimpangan
            checkJenisPenyimpangan();
        });

        // panggil fungsi ini saat document telah diload browser 
        // -> untuk cek value jenis penyimpangan pertama kali browser load halaman
        resetJamMasukJamPulang();
        checkJenisPenyimpangan();
    });
</script>
@endsection

