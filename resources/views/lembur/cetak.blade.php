<!DOCTYPE html>
<html>
<head>
  <title>Print</title>
        <style>
            @page {
                margin: 0cm 0cm;
            }
            div{
            	line-height: normal;
            }
            body {
                margin-top: 2cm;
                margin-left: 0cm;
                margin-right: 0cm;
                margin-bottom: 0cm;
    			color: #000;
    			font-family: "Times New Roman", Times, serif;
    			font-size: 14px;

            }
            div.content{
                margin-top: 2cm;
                margin-left: 0cm;
                margin-right: 0cm;
                margin-bottom: 0cm;
                color: #000;
                font-family: "Times New Roman", Times, serif;
                font-size: 14px;
            }
            div.content1{
                margin-left: 2.5cm;
                margin-right: 2cm;
                font-family: "Times New Roman", Times, serif;
                font-size: 16px;
            }

            h1 {
  			font-size: 40px;
  			word-spacing: 1px;
			}

			h2 {
  			font-size: 30px;
  			word-spacing: 1px;
			}

            h3 {
                font-size: 20px;
                word-spacing: 1px;
            }
			p {
  			font-size: 15px;
  			line-height: : 12px;
			}
        </style>
    </head>
    <style>
        div.atas {
                text-align: right;
                margin-top: 0.5cm;
                margin-right: 1cm;
                font-family: "Optima, sans-serif";
                font-size: 14px;
            }
    </style>
    <div class="atas"> </div>
<body>
    <div class="content">
        <center>
        <p style="line-height: 1px;">
            <b><h2>Universitas Terbuka</h2>
            <h3>Format Lembur Pegawai</h3></b>
        </p>
        </center>
    <div class="content1">
      @foreach($lembur as $a)
           <table width="100%" rules="all" border="1" cellpadding="5" cellspacing="3">
             <tr>
               <td>Nama Pegawai</td>
               <td> : {{$a->namapegawai}} </td>
             </tr>
             <tr>
               <td>NIP</td>
               <td>: {{$a->nip}} </td>
             </tr>
             <tr>
               <td>Tanggal Lembur</td>
               <td>: {{$a->tgl_lembur}}</td>
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
                 <td>: {{$a->kegiatan}}</td>
             </tr>
             <tr>
                 <td>Volume Kegiatan (dalam satuan)</td>
                 <td>: {{$a->volume}}&nbsp;{{$a->satuan}}</td>
             </tr>
             <tr>
               <td colspan="2"><b>Uraian Kegiatan : </b><br/>
                
                   {{$a->uraiankegiatan}}
               
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
                    <td align="left">{{$a->namapegawai}}<br/>NIP.{{$a->nip}}</td>
                    <td align="Lef">{{$a->name}}<br/>NIP.{{$a->nip_atasan}}</td>
                </tr>   
            </table>
            @endforeach
    </div>
    </div>	
</body>
</html>