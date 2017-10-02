@extends('backend.layouts.app')
@section('content')
  <section class="content-header">
    <h1 class="pull-left">Dashboard <small>Control Panel</small></h1>
    <form action="{{url('dashboard/data')}}" method="get">   
      <div class="form-group pull-right">
        <div class="input-group">
          <div class="input-group date">
            <input type="text" name="from_date" value="<?php echo isset($_GET['from_date'])?$_GET['from_date']:null ?>" id="form" class="form-control datetimepicker" placeholder="From">
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>

            <input type="text" name="to_date" value="<?php echo isset($_GET['to_date'])?$_GET['to_date']:null ?>" id="to" class="form-control datetimepicker" placeholder="To">
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>

          </div>

        </div>
      </div>
      @if(Auth::user()->role!=1)
        <div class="form-group pull-right">
          <select class="form-control" name="site">
              <option>Select Site</option>
              @foreach($data['sites'] as $key=>$value)
                <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>
      @endif
      
      <button type="submit" class="btn btn-primary pull-right">
        search
      </button> 
    </form>
    <br>
  </section>
    <br>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <div class="col-lg-{{Auth::user()->role==2?3:2}} col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                @if(count($data['sites'])>=1000)
                  {{count($data['sites'])/1000}}k
                @else
                  {{count($data['sites'])}}
                @endif
              </h3>
              <p>Sites</p>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <a href="{{url('dashboard/sites')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-{{Auth::user()->role==2?3:3}} col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                @if($data['guests']>=1000)
                  {{$data['guests']/1000}}k
                @else
                  {{$data['guests']}}
                @endif
              </h3>

              <p>Guest Login</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{url('dashboard/guests')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-{{Auth::user()->role==2?3:3}} col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>
                @if($data['visit']>=1000)
                  {{$data['visit']/1000}}k
                @else
                  {{$data['visit']}}
                @endif</h3>

              <p>Guest Visits</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{url('dashboard/guests')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-{{Auth::user()->role==2?3:2}} col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>
                @if($data['active']>=1000)
                  {{$data['active']/1000}}k
                @else
                  {{$data['active']}}
                @endif</h3>

              <p>Acitve Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{url('dashboard/guests')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        @if(Auth::user()->role==1)
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                @if($data['clients']>=1000)
                  {{$data['clients']/1000}}k
                @else
                  {{$data['clients']}}
                @endif</h3>

              <p>Clients</p>
            </div>
            <div class="icon">
              <i class="fa fa-filter"></i>
            </div>
            <a href="{{url('dashboard/clients')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endif
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <!-- /.col (LEFT) -->
        <div class="col-md-12">
          
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Activity <small>Active Login (This hourly is that today.)</small></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
          </div>
          <!-- /.box -->
          

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <div class="row">
        <div class="col-md-6">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Operating Systems<small></small></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <div class="col-md-6">
            <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Demographics <small>Gender/Age-group</small> </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:334px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  <!-- page script -->
  <script src="{{asset('assets/chartjs/Chart.bundle.js')}}"></script>
  <script src="{{asset('assets/chartjs/utils.js')}}"></script>
<script>
  $( ".datetimepicker" ).datetimepicker();
    var calender = [];var data_male=[0,0,0,0,0,0,0];
    var data_login=[];var PieData_label = [];var PieData_value = [];var PieData_color = [];
    var data_female=[0,0,0,0,0,0,0];
    var data_1 = JSON.parse('<?php echo $data['male'] ?>');
    var data_2 = JSON.parse('<?php echo $data['female'] ?>');
    var data_3 = JSON.parse('<?php echo $data['login'] ?>');
    var data_4 = JSON.parse('<?php echo $data['os_type'] ?>');
    
    data_1.map(function(index){
      if (index.age==1) {
        data_male[0] = index.total
      }
      if (index.age==2) {
        data_male[1] = index.total
      }
      if (index.age==3) {
        data_male[2] = index.total
      }
      if (index.age==4) {
        data_male[3] = index.total
      }
      if (index.age==5) {
        data_male[4] = index.total
      }
      if (index.age==6) {
        data_male[5] = index.total
      }
      if (index.age==7) {
        data_male[6] = index.total
      }
    });
    data_2.map(function(index){
      if (index.age==1) {
        data_female[0] = index.total
      }
      if (index.age==2) {
        data_female[1] = index.total
      }
      if (index.age==3) {
        data_female[2] = index.total
      }
      if (index.age==4) {
        data_female[3] = index.total
      }
      if (index.age==5) {
        data_female[4] = index.total
      }
      if (index.age==6) {
        data_female[5] = index.total
      }
      if (index.age==7) {
        data_female[6] = index.total
      }
    });

    data_3.map(function(index){
      //var month = index.time.split('-')
      //calender.push(moment(month[0]).format('LT')) 
      calender.push(index.time+' Hour')
      data_login.push(index.data);         
    });
    data_4.map(function(index,key){
      //var os_type = new Object;
      //os_type.value= index.data;
      //os_type.color= convertColor(index.os);
      PieData_value.push(index.data);
      PieData_color.push(convertColor(index.os));
      PieData_label.push(index.os);
      //os_type.highlight= convertColor(index.os);
      //os_type.label= index.os
      //PieData.push(os_type);        
    });
              donut_data = {
                datasets: [{
                  data: PieData_value,
                  backgroundColor: PieData_color,
                }],
                labels: PieData_label
              };
              bar_data = {
                  labels: calender,
                  datasets: [{
                    label: 'Active',
                    data: data_login,
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.9)',                    
                    borderWidth: 1
                  }]
              };
              hozbar_data = {
                labels: ['Age 13-17','Age 18-24','Age 25-34','Age 35-44','Age 45-54','Age 55-64','Over 65'],
                datasets: [{
                    label: 'Male',
                    backgroundColor: window.chartColors.orange,
                    borderColor: window.chartColors.orange,
                    borderWidth: 1,
                    data: data_male
                }, {
                    label: 'Female',
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: data_female
                }]
              }

              var ctx = document.getElementById("areaChart");
              var myChart = new Chart(ctx, {
                  type: 'bar',
                  data:bar_data,
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });

              var ctx = document.getElementById("pieChart");
              var myDoughnutChart = new Chart(ctx, {
                      type: 'doughnut',
                      data: donut_data,
                      options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: false,
                                text: 'Chart.js Doughnut Chart'
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
              });

              var ctx = document.getElementById("barChart").getContext("2d");
              var myhorBarChart = new Chart(ctx, {
                  type: 'horizontalBar',
                  data: hozbar_data,
                  options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                        }
                    },
                    responsive: true,
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Horizontal Bar Chart'
                    }
                  }
              });


</script>
@stop