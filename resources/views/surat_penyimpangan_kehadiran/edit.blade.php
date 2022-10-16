@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Edit Form {{ $penyimpanganKehadiran->user->name }}</h3>
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

                {!! Form::model($penyimpanganKehadiran, ['method' => 'PUT','route' => ['letters.penyimpangan-kehadiran.update', $penyimpanganKehadiran->id], 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="">NPK - Nama - Departments</label>  
                        <input class="form-control" type="text" name="name" id="name" value="{{ $penyimpanganKehadiran->user->npk .'-'. $penyimpanganKehadiran->user->name . '-' .$penyimpanganKehadiran->user->department->name }}" readonly aria-readonly disabled>
                                                   
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
                        <label for="">File Evidence Saat Ini</label>                                  
                        <br/>
                        <a href="{{ route('letters.penyimpangan-kehadiran.download', $penyimpanganKehadiran->id) }}">{{ $penyimpanganKehadiran->evidence ?? "belum ada file evidence yang diupload" }}</a>
                    </div>

                     <div class="form-group">
                        <label for="">Ganti File Evidence</label>                                    
                        {!! Form::file('evidence', null, array('class' => 'form-control select2', 'style' => "width: 100%")) !!}
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
