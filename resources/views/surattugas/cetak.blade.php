
<title>Surat Perintah Kerja Lembur</title>
<style>
    @page {
        margin: 0cm 0cm;
    }
    div{
        line-height: normal;
    }
    body {
        margin-top: 0.5cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 0cm;
        color: #000;
        font-family: "Times New Roman", Times, serif;
    }
    body {
        font-size: 12px;
    }
    div.content{
        margin-top: 2.5cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 0cm;
        color: #000;
        font-family: "Times New Roman", Times, serif;
        font-size: 15px;
    }
    h3 {
    font-size: 15px;
    }
    p {
    font-size: 15px;
    line-height: : 12px;
    }
    a {
    font-size: 20px;
    line-height: : 12px;
    }
    header {
        position: fixed;
        top: 0.5cm;
        left: 0.5cm;
        right: 0.5cm;
        height: 3cm;
    }
    div.footer {
        position: absolute; 
        bottom: 0cm; 
        left: 0cm; 
        right: 0cm;
        height: 3cm;
        background-repeat: no-repeat;
    }
    #bg {
        position: absolute;
        z-index: -1; 
        top: 3.5cm; 
        left: 35%; 
        width: 100px; 
        height: 300px;
        color: invert;
    }
    #ttd{
        float: right;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 10px;
    }
</style>
    
<body>
    @foreach($st as $a)

<header>
    <img src="adminlte/img/KOP SURAT.png" width="100%" height="100%"><hr />
</header> 
  <div class="footer">
    <img src="adminlte/img/footer.png" width="101%" height="100%" />
  </div>
   <div class="content">
    <br/>
    <br/>
    <center>
    <p style="line-height: 1px;">
    <h3><u>SURAT PERINTAH KERJA LEMBUR </u><br/>
        Nomor: {{$a->nomor_surat_tugas}}</h3></p></center><br/>
    
       Yang bertanda tangan dibawah ini Kepala Unit Program Belajar Jarak Jauh (UPBJJ) Universitas Terbuka Bandung, dengan ini memerintahkan pegawai berikut :
        <br/>
        <br/>
    <table>
        <tr>
            <td width="5px"><center>No.</center></td>
            <td><center>Nama Pegawai</center></td>
            <td><center>NIP</center></td>
            <td><center>Tanggal Tugas</center></td>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($a->surattugasdetail->sortBy('tanggal_kegiatan')->sortBy('name') as $detail)
        <tr>
            <td><center>{{ $no++ }}</center></td>
            <td>{{ $detail->user->name }}</td>
            <td>{{ $detail->nip }}</td>
            <td><center>{{ $detail->tanggal_kegiatan }}</center></td>
        </tr>   
        @endforeach
    </table>
    <br />
    Demikian surat perintah kerja lembur ini kami buat untuk dipergunakan sebagaimana mestinya
    <br/>
    <br/>
    <br/>
    <div id="ttd" class="row">
        <div class="col-md-12">
            Bandung,  <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            Drs. Enceng, M.Si<br>
            NIP. 199231222131231231
        </div>
    </div>
    
    @endforeach	
</body>
</html>