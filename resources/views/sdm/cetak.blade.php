<!DOCTYPE html>
<html>
<head>
  <title>Print</title>
        <style>
            @page {
                margin-top: 1cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 1cm;
            }
            div{
              line-height: normal;
            }
            body {
                margin-top: 0cm;
                margin-left: 0.5cm;
                margin-right: 1cm;
                margin-bottom: 0cm;
                color: #000;
                font-family: "Times New Roman", Times, serif;
                font-size: 14px;

            }
            div.content{
                margin-top: 0cm;
                margin-left: 0cm;
                margin-right: 0cm;
                margin-bottom: 0cm;
                color: #000;
                font-family: "Times New Roman", Times, serif;
                font-size: 12px;
            }

            h1 {
              font-size: 40px;
              word-spacing: 1px;
            }

            h2 {
              font-size: 16px;
              word-spacing: 1px;
            }
            h3 {
              font-size: 12px;
              word-spacing: 1px;
            }
            p {
              font-size: 14px;
              line-height: : 12px;
            }
            .table {
                font-family: sans-serif;
                color: #232323;
                border-collapse: collapse;
            }
             
            .table, th, td {
                border: 1px solid #999;
                padding: 8px 20px;
            }

            .table1 {
                font-family: "Times New Roman", Times, serif;
                font-size: 10px;
                color: #232323;
                border-collapse: collapse;
            }
             
            .table1, td {
                border: 1px solid #999;
                padding: 2px 5px;
            }
          </style>
        </head>
<body>
    <table class="table1" align="right">
      <tr>
        <td><b>SM04a-RK02-RII.0</b></td>
      </tr>
      <tr>
        <td><b>25 Juni 2013</b></td>
      </tr>
    </table>
    <div class="content">
        <h2 align="center">Riwayat Pengembangan Kompetensi Karyawan</h2>
        <h3 align="left">Nama : {{Auth::user()->name}}<br/>
          NIP &nbsp;&nbsp;&nbsp;: {{Auth::user()->nip}}</h3><br/>
        <p><b>A. Pendidikan</b></p>
            <table class="table">
              <thead>
                <tr>
                    <th align="center" width="5%">No</th>
                    <th align="center" width="5%">Judul / Bidang Ilmu</th>
                    <th align="center" width="5%">Waktu</th>
                    <th align="center" width="20%">Institusi Pendidikan</th>
                    <th align="center" width="5%">Pendidikan Efektif ? (Ya/Tidak)</th>
                    <th align="center" width="20%">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($pendidikan as $a)
                <tr>
                  <td align="center">{{$no++}}</td>
                  <td align="center">{{$a->jenjang}}</td>
                  <td align="center">{{$a->tahun}}</td>
                  <td align="left">{{$a->pendidikan}}</td>
                  <td align="center">{{$a->efektif}}</td>
                  <td align="center">{{$a->kabko}}</td>
                </tr>
                @endforeach
              </tbody>   
            </table>
        <br/>
        <p><b>B. Pengalaman Kerja</b></p>
            <table class="table">
              <thead>
                <tr>
                    <th align="center">No</th>
                    <th align="center">Periode</th>
                    <th align="center">Jabatan/Fungsi</th>
                    <th align="center">Unit Kerja</th>
                    <th align="center">Nomor SK</th>
                    <th align="center">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($pekerjaan as $b)
                <tr>
                  <td align="center">{{$no++}}</td>
                  <td align="center">{{$b->waktu}}</td>
                  <td align="center">{{$b->jabatan}}</td>
                  <td align="left">{{$b->unit_kerja}}</td>
                  <td align="center">{{$b->nomor_sk}}</td>
                  <td align="center">{{$b->keterangan}}</td>
                </tr>
                @endforeach
              </tbody>   
            </table>
        <br/>
        <p><b>C. Pelatihan / Diklat</b></p>
            <table class="table">
              <thead>
                <tr>
                    <th align="center" width="5%">No</th>
                    <th align="center" width="5%">Judul Pelatihan</th>
                    <th align="center" width="5%">Waktu</th>
                    <th align="center" width="20%">Pelatih</th>
                    <th align="center" width="5%">Pendidikan Efektif ? (Ya/Tidak)</th>
                    <th align="center" width="20%">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($sdm as $c)
                <tr>
                  <td align="center">{{$no++}}</td>
                  <td align="center">{{$c->nama_kegiatan}}</td>
                  <td align="center">{{$c->waktu}}</td>
                  <td align="left">{{$c->pelatih}}</td>
                  <td align="center">{{$c->efektif}}</td>
                  <td align="center">{{$c->kabko}}</td>
                </tr>
                @endforeach
              </tbody>   
            </table>
    </div>  
</body>
</html>