<?php

namespace Database\Seeders;

use App\Models\LetterType;
use Illuminate\Database\Seeder;

class LetterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Surat Lembur',
                'description' => 'Untuk Lembur',
                'department_id' => '1',
                'html' => '
                <table border="1" cellpadding="1" cellspacing="1" style="height:282px; width:870px">
                        <tbody>
                            <tr>
                                <td colspan="1" rowspan="4" style="width:122px">&nbsp;</td>
                                <td colspan="1" rowspan="4" style="text-align:center; width:443px"><span style="font-size:26px"><strong>IZIN MENINGGALKAN PEKERJAAN</strong></span></td>
                                <td style="width:111px">No. Document</td>
                                <td style="width:165px">FR-API-HRGA-HRAD/009/17</td>
                            </tr>
                            <tr>
                                <td style="width:111px">Revision</td>
                                <td style="width:165px">0</td>
                            </tr>
                            <tr>
                                <td style="width:111px">Effective Start</td>
                                <td style="width:165px">03 Juni 2017</td>
                            </tr>
                            <tr>
                                <td style="width:111px">Page</td>
                                <td style="width:165px">1 / 1</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="width:860px">
                                <table border="0" cellpadding="1" cellspacing="1" style="height:153px; width:867px">
                                    <tbody>
                                        <tr>
                                            <td style="width:156px">&nbsp;</td>
                                            <td style="width:334px">&nbsp;</td>
                                            <td style="width:40px">&nbsp;</td>
                                            <td style="width:311px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Nama</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">NRP</td>
                                            <td style="width:311px">:</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Bagian</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">&nbsp;</td>
                                            <td style="width:311px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Berangkat Tanggal</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">PKL</td>
                                            <td style="width:311px">:</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Rencana Kembali Tanggal</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">PKL</td>
                                            <td style="width:311px">:</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Keperluan / Atasan</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">&nbsp;</td>
                                            <td style="width:311px">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p style="text-align:right">Karawang,........................................... &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

                                <p style="text-align:right">Pemohon &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>

                                <p style="text-align:right">&nbsp;</p>

                                <p style="text-align:right">(.......................................) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</p>

                                <table border="1" cellpadding="1" cellspacing="1" style="height:209px; width:869px">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" rowspan="1" style="text-align:center">Disetujui</td>
                                            <td colspan="3" rowspan="1" style="text-align:center; width:426px">Diketahui</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center">KA. SIE</td>
                                            <td style="text-align:center">KA. DEPT</td>
                                            <td style="text-align:center">KA. DIV</td>
                                            <td colspan="3" rowspan="1" style="text-align:center; width:426px">KEAMANAN</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" rowspan="4">&nbsp;</td>
                                            <td colspan="1" rowspan="4">&nbsp;</td>
                                            <td colspan="1" rowspan="4">&nbsp;</td>
                                            <td colspan="1" rowspan="4">&nbsp;</td>
                                            <td>Keluar</td>
                                            <td style="width:137px">Kembali</td>
                                        </tr>
                                        <tr>
                                            <td>Pukul</td>
                                            <td style="width:137px">Pukul</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" rowspan="2">&nbsp;</td>
                                            <td colspan="1" rowspan="2" style="width:137px">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="width:860px">CC : Personalia</td>
                            </tr>
                        </tbody>
                    </table>

                    <table border="1" cellpadding="1" cellspacing="1" style="height:282px; width:870px">
                        <tbody>
                            <tr>
                                <td colspan="1" rowspan="4" style="width:122px">&nbsp;</td>
                                <td colspan="1" rowspan="4" style="text-align:center; width:443px"><span style="font-size:26px"><strong>IZIN MENINGGALKAN PEKERJAAN</strong></span></td>
                                <td style="width:111px">No. Document</td>
                                <td style="width:165px">FR-API-HRGA-HRAD/009/17</td>
                            </tr>
                            <tr>
                                <td style="width:111px">Revision</td>
                                <td style="width:165px">0</td>
                            </tr>
                            <tr>
                                <td style="width:111px">Effective Start</td>
                                <td style="width:165px">03 Juni 2017</td>
                            </tr>
                            <tr>
                                <td style="width:111px">Page</td>
                                <td style="width:165px">1 / 1</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="width:860px">
                                <table border="0" cellpadding="1" cellspacing="1" style="height:153px; width:867px">
                                    <tbody>
                                        <tr>
                                            <td style="width:156px">&nbsp;</td>
                                            <td style="width:334px">&nbsp;</td>
                                            <td style="width:40px">&nbsp;</td>
                                            <td style="width:311px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Nama</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">NRP</td>
                                            <td style="width:311px">:</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Bagian</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">&nbsp;</td>
                                            <td style="width:311px">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Berangkat Tanggal</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">PKL</td>
                                            <td style="width:311px">:</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Rencana Kembali Tanggal</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">PKL</td>
                                            <td style="width:311px">:</td>
                                        </tr>
                                        <tr>
                                            <td style="width:156px">Keperluan / Atasan</td>
                                            <td style="width:334px">:</td>
                                            <td style="width:40px">&nbsp;</td>
                                            <td style="width:311px">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p style="text-align:right">Karawang,........................................... &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

                                <p style="text-align:right">Pemohon &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>

                                <p style="text-align:right">&nbsp;</p>

                                <p style="text-align:right">(.......................................) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</p>

                                <table border="1" cellpadding="1" cellspacing="1" style="height:209px; width:869px">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" rowspan="1" style="text-align:center">Disetujui</td>
                                            <td colspan="3" rowspan="1" style="text-align:center; width:426px">Diketahui</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center">KA. SIE</td>
                                            <td style="text-align:center">KA. DEPT</td>
                                            <td style="text-align:center">KA. DIV</td>
                                            <td colspan="3" rowspan="1" style="text-align:center; width:426px">KEAMANAN</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" rowspan="4">&nbsp;</td>
                                            <td colspan="1" rowspan="4">&nbsp;</td>
                                            <td colspan="1" rowspan="4">&nbsp;</td>
                                            <td colspan="1" rowspan="4">&nbsp;</td>
                                            <td>Keluar</td>
                                            <td style="width:137px">Kembali</td>
                                        </tr>
                                        <tr>
                                            <td>Pukul</td>
                                            <td style="width:137px">Pukul</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" rowspan="2">&nbsp;</td>
                                            <td colspan="1" rowspan="2" style="width:137px">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    ',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Izin',
                'description' => 'Untuk Izin',
                'department_id' => '1',
                'html' => '<table border="1" cellpadding="1" cellspacing="1" style="height:282px; width:870px">
                <tbody>
                    <tr>
                        <td colspan="1" rowspan="4" style="width:122px">&nbsp;</td>
                        <td colspan="1" rowspan="4" style="text-align:center; width:443px"><span style="font-size:26px"><strong>IZIN MENINGGALKAN PEKERJAAN</strong></span></td>
                        <td style="width:111px">No. Document</td>
                        <td style="width:165px">FR-API-HRGA-HRAD/009/17</td>
                    </tr>
                    <tr>
                        <td style="width:111px">Revision</td>
                        <td style="width:165px">0</td>
                    </tr>
                    <tr>
                        <td style="width:111px">Effective Start</td>
                        <td style="width:165px">03 Juni 2017</td>
                    </tr>
                    <tr>
                        <td style="width:111px">Page</td>
                        <td style="width:165px">1 / 1</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="width:860px">
                        <table border="0" cellpadding="1" cellspacing="1" style="height:153px; width:867px">
                            <tbody>
                                <tr>
                                    <td style="width:156px">&nbsp;</td>
                                    <td style="width:334px">&nbsp;</td>
                                    <td style="width:40px">&nbsp;</td>
                                    <td style="width:311px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Nama</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">NRP</td>
                                    <td style="width:311px">:</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Bagian</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">&nbsp;</td>
                                    <td style="width:311px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Berangkat Tanggal</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">PKL</td>
                                    <td style="width:311px">:</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Rencana Kembali Tanggal</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">PKL</td>
                                    <td style="width:311px">:</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Keperluan / Atasan</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">&nbsp;</td>
                                    <td style="width:311px">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="text-align:right">Karawang,........................................... &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

                        <p style="text-align:right">Pemohon &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>

                        <p style="text-align:right">&nbsp;</p>

                        <p style="text-align:right">(.......................................) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</p>

                        <table border="1" cellpadding="1" cellspacing="1" style="height:209px; width:869px">
                            <tbody>
                                <tr>
                                    <td colspan="3" rowspan="1" style="text-align:center">Disetujui</td>
                                    <td colspan="3" rowspan="1" style="text-align:center; width:426px">Diketahui</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center">KA. SIE</td>
                                    <td style="text-align:center">KA. DEPT</td>
                                    <td style="text-align:center">KA. DIV</td>
                                    <td colspan="3" rowspan="1" style="text-align:center; width:426px">KEAMANAN</td>
                                </tr>
                                <tr>
                                    <td colspan="1" rowspan="4">&nbsp;</td>
                                    <td colspan="1" rowspan="4">&nbsp;</td>
                                    <td colspan="1" rowspan="4">&nbsp;</td>
                                    <td colspan="1" rowspan="4">&nbsp;</td>
                                    <td>Keluar</td>
                                    <td style="width:137px">Kembali</td>
                                </tr>
                                <tr>
                                    <td>Pukul</td>
                                    <td style="width:137px">Pukul</td>
                                </tr>
                                <tr>
                                    <td colspan="1" rowspan="2">&nbsp;</td>
                                    <td colspan="1" rowspan="2" style="width:137px">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="width:860px">CC : Personalia</td>
                    </tr>
                </tbody>
            </table>

            <table border="1" cellpadding="1" cellspacing="1" style="height:282px; width:870px">
                <tbody>
                    <tr>
                        <td colspan="1" rowspan="4" style="width:122px">&nbsp;</td>
                        <td colspan="1" rowspan="4" style="text-align:center; width:443px"><span style="font-size:26px"><strong>IZIN MENINGGALKAN PEKERJAAN</strong></span></td>
                        <td style="width:111px">No. Document</td>
                        <td style="width:165px">FR-API-HRGA-HRAD/009/17</td>
                    </tr>
                    <tr>
                        <td style="width:111px">Revision</td>
                        <td style="width:165px">0</td>
                    </tr>
                    <tr>
                        <td style="width:111px">Effective Start</td>
                        <td style="width:165px">03 Juni 2017</td>
                    </tr>
                    <tr>
                        <td style="width:111px">Page</td>
                        <td style="width:165px">1 / 1</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="width:860px">
                        <table border="0" cellpadding="1" cellspacing="1" style="height:153px; width:867px">
                            <tbody>
                                <tr>
                                    <td style="width:156px">&nbsp;</td>
                                    <td style="width:334px">&nbsp;</td>
                                    <td style="width:40px">&nbsp;</td>
                                    <td style="width:311px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Nama</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">NRP</td>
                                    <td style="width:311px">:</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Bagian</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">&nbsp;</td>
                                    <td style="width:311px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Berangkat Tanggal</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">PKL</td>
                                    <td style="width:311px">:</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Rencana Kembali Tanggal</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">PKL</td>
                                    <td style="width:311px">:</td>
                                </tr>
                                <tr>
                                    <td style="width:156px">Keperluan / Atasan</td>
                                    <td style="width:334px">:</td>
                                    <td style="width:40px">&nbsp;</td>
                                    <td style="width:311px">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="text-align:right">Karawang,........................................... &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

                        <p style="text-align:right">Pemohon &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>

                        <p style="text-align:right">&nbsp;</p>

                        <p style="text-align:right">(.......................................) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</p>

                        <table border="1" cellpadding="1" cellspacing="1" style="height:209px; width:869px">
                            <tbody>
                                <tr>
                                    <td colspan="3" rowspan="1" style="text-align:center">Disetujui</td>
                                    <td colspan="3" rowspan="1" style="text-align:center; width:426px">Diketahui</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center">KA. SIE</td>
                                    <td style="text-align:center">KA. DEPT</td>
                                    <td style="text-align:center">KA. DIV</td>
                                    <td colspan="3" rowspan="1" style="text-align:center; width:426px">KEAMANAN</td>
                                </tr>
                                <tr>
                                    <td colspan="1" rowspan="4">&nbsp;</td>
                                    <td colspan="1" rowspan="4">&nbsp;</td>
                                    <td colspan="1" rowspan="4">&nbsp;</td>
                                    <td colspan="1" rowspan="4">&nbsp;</td>
                                    <td>Keluar</td>
                                    <td style="width:137px">Kembali</td>
                                </tr>
                                <tr>
                                    <td>Pukul</td>
                                    <td style="width:137px">Pukul</td>
                                </tr>
                                <tr>
                                    <td colspan="1" rowspan="2">&nbsp;</td>
                                    <td colspan="1" rowspan="2" style="width:137px">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            ',
            'user_id' => 1,
            ],
            [
                'name' => 'Surat Sakit',
                'description' => 'Untuk Sakit',
                'department_id' => '1',
                'html' => '<br/>',
                'user_id' => 1,
            ],
           
            [
                'name' => 'Surat Lembur',
                'description' => 'Untuk Lembur',
                'department_id' => '2',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Izin',
                'description' => 'Untuk Izin',
                'department_id' => '2',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Sakit',
                'description' => 'Untuk Sakit',
                'department_id' => '2',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Lembur',
                'description' => 'Untuk Lembur',
                'department_id' => '3',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Izin',
                'description' => 'Untuk Izin',
                'department_id' => '3',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Sakit',
                'description' => 'Untuk Sakit',
                'department_id' => '3',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Lembur',
                'description' => 'Untuk Lembur',
                'department_id' => '4',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Izin',
                'description' => 'Untuk Izin',
                'department_id' => '4',
                'user_id' => 1,
            ],
            [
                'name' => 'Surat Sakit',
                'description' => 'Untuk Sakit',
                'department_id' => '4',
                'user_id' => 1,
            ],
           
           
        ])->each(function ($letterType) {
            $letterType = LetterType::create($letterType);
        });
    }
}
