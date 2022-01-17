@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
        <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
            
              <div class="inner">
                <h4>{{$jumlah_mahasiswa}}</h4>

                <h5>Akun Penjual Mahasiswa</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
            
              <div class="inner">
                <h4>{{$jumlah_dosen}}</h4>

                <h5>Akun Penjual Dosen</h5>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
             
            </div>
          </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
            
              <div class="inner">
                <h4>{{$jumlah_tenagaPendidikan}}</h4>

                <h5>Akun Penjual Tenaga Pendidikan</h5>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4>{{$jumlah_penjualan_terbanyak[0]->Pengguna->nama}}</h4>

                <h5>Jumlah Penjualan Terbanyak</h5>

              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4>{{$jumlah_requestBelum}}</h4>

                <h5>Jumlah Request Penjual</h5>

              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4>{{$jumlah_requestPencairan}}</h4>

                <h5>Jumlah Request Pencairan Dana</h5>

              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
        </div>
        <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
        <div class="card"> 
        <div class="card-body">
        <canvas id="canvas" width="600" height="200"></canvas>

        </div>
      </div>
      
    </div>
  </div>
        <!-- BAR CHART -->

    <script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js"></script>
    <script>
    
    var label = <?php echo $label; ?>;
    var pemasukan = <?php echo $pemasukan; ?>;
    var pengeluaran = <?php echo $pengeluaran; ?>;


    var barChartData = {
        labels: label,
        datasets: [{
            label: 'Saldo Masuk',
            borderColor: "rgba(255,0,0,1)",
            fill: false ,
            data: pemasukan
        }, {
            label: 'Saldo Cair',
            borderColor: "rgba(50,205,50)",
            fill: false ,
            data: pengeluaran
        },
        
        ]
    };


    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Laporan Pemasukan dan Pengeluaran'
                }
            }
        });


    };
</script>
            <!-- /.card -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        </div>
      </div>
    </div>

@endsection
@section('scripts')
@parent

@endsection