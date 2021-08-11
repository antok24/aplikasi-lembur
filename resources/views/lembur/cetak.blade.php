<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px;
    }
</style>
<center>
    <b><h2>Universitas Terbuka <br>
    Format Lembur Pegawai</h2></b>
</center>
    @foreach($lembur as $a)
    <table width="100%" border cellpadding="5" cellspacing="3">
        <tr>
        <td>Nama Pegawai</td>
        <td> : {{$a->name}} </td>
        </tr>
        <tr>
        <td>NIP</td>
        <td>: {{$a->nip}} </td>
        </tr>
        <tr>
        <td>Tanggal Lembur</td>
        <td>: {{$a->tanggal_kegiatan}}</td>
        </tr>
        <tr>
        <td>Waktu</td>
        <td>: Jam Masuk : {{$a->masuk}} &nbsp;,&nbsp; Jam Pulang : {{$a->pulang}}</td>
        </tr>
        <tr>
        <td>Total Jam</td>
        <td>: {{$a->totaljam}}</td>
        </tr>
        <tr>
            <td>Nama Kegiatan</td>
            <td>: {{$a->nama_kegiatan}}</td>
        </tr>
        <tr>
            <td>Volume Kegiatan (dalam satuan)</td>
            <td>: {{$a->volume}}&nbsp;{{$a->satuan}}</td>
        </tr>
        <tr>
        <td colspan="2"><b>Uraian Kegiatan : </b><br/>
            {!! $a->uraian_kegiatan !!}
        </td>
        </tr>
    </table>
    <br/>
    <br/>
        <table width="100%" cellpadding="30">
            <tr>
                <td align="margin-left">Pegawai lembur,</td>
                <td align="margin-left">Mengetahui,</td>
            </tr>
            <tr>
                <td align="left">{{$a->name}}<br/>NIP.{{$a->nip}}</td>
                <td align="Lef">{{$a->nama_atasan}}<br/>NIP.{{$a->nip_atasan}}</td>
            </tr> 
        </table>
    @endforeach
</div>
</div>