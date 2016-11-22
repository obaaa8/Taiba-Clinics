@extends('layouts.master')@section('titel','Dashboard')@section('content')        <div class="content">            <div class="container-fluid">                <div class="row">                    <div class="col-lg-3 col-sm-6">                        <div class="card">                            <div class="content">                                <div class="row">                                    <div class="col-xs-5">                                        <div class="icon-big icon-warning text-center">                                            <i class="ti-user"></i>                                        </div>                                    </div>                                    <div class="col-xs-7">                                        <div class="numbers">                                            <p>Patient</p>                                            <?php $patients = count(App\Patient::all()); ?>                                            {{$patients}}                                        </div>                                    </div>                                </div>                                <div class="footer">                                    <hr />                                    <div class="stats">                                        <i class="fa-folder-open-o"></i> <a href="patient"> see all </a>                                    </div>                                </div>                            </div>                        </div>                    </div>                    <div class="col-lg-3 col-sm-6">                        <div class="card">                            <div class="content">                                <div class="row">                                    <div class="col-xs-5">                                        <div class="icon-big icon-danger text-center">                                            <i class="fa fa-exclamation-triangle"></i>                                        </div>                                    </div>                                    <div class="col-xs-7">                                        <div class="numbers">                                            <p>Hanging bills</p>                                            <?php                                              $visits = App\Visit::all();                                              $i = 0;                                              $paid = 0;                                              foreach ($visits as $visit) {                                              if($visit->visit_price != $visit->visit_paid){                                                $i++;                                                $x = $visit->visit_price - $visit->visit_paid;                                                $paid = $paid + $x;                                              }                                              }                                            ?>                                            {{$i}}                                        </div>                                    </div>                                </div>                                <div class="footer">                                    <hr />                                    <div class="stats">                                        {{$paid}} SDG <i class="fa-folder-open-o"></i></i> <a href="visit"> see all </a>                                    </div>                                </div>                            </div>                        </div>                    </div>                    <div class="col-lg-3 col-sm-6">                        <div class="card">                            <div class="content">                                <div class="row">                                    <div class="col-xs-5">                                        <div class="icon-big icon-info text-center">                                            <i class="fa fa-calendar"></i>                                        </div>                                    </div>                                    <div class="col-xs-7">                                        <div class="numbers">                                          <?php $today = date("Y-m-d"); $day = date("m.d");?>                                            <p>visits: {{$day}}</p>                                              <?php                                              $user_id = Auth::user()->id;                                              $role = App\UserRole::where('user_id','=',$user_id)->first();                                              if ($user_id == 1 || $role->role_id == 2) {                                                $visits = App\Visit::where('visit_date','=',$today)->get();                                              } else {                                                $visits = App\Visit::where('doctor_id','=',$user_id)->where('visit_date','=',$today)->get();                                              } ?>                                            {{count($visits)}}                                        </div>                                    </div>                                </div>                                <div class="footer">                                    <hr />                                    <div class="stats">                                        <i class="fa-folder-open-o"></i></i> <a href="visit"> see all </a>                                    </div>                                </div>                            </div>                        </div>                    </div>                    <div class="col-lg-3 col-sm-6">                        <div class="card">                            <div class="content">                                <div class="row">                                    <div class="col-xs-5">                                        <div class="icon-big icon-success text-center">                                          <i class="fa fa-money" aria-hidden="true"></i>                                        </div>                                    </div>                                    <div class="col-xs-7">                                        <div class="numbers">                                            <p>Expences</p>                                            123                                        </div>                                    </div>                                </div>                                <div class="footer">                                    <hr />                                    <div class="stats">                                        <i class=""></i>Today                                    </div>                                </div>                            </div>                        </div>                    </div>                </div>                <div class="row">                     <div class="col-lg-12 col-sm-12">                        <div class="card">                            <div class="header">                                <h4 class="title"><i class="ti-plus"></i>Appointment</h4>                            </div>                            <div class="content">                                @if (Session::has('message'))                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>                                @endif                                <form action="{{ url ('visit_check') }}" method="POST" enctype="multipart/form-data" >                                    {!! csrf_field() !!}                                      <div class="row">                                          <div class="col-md-4">                                              <div class="form-group">                                                  <label>Patient</label>                                                        <input list="patient" required="true" name="patient" class="form-control border-input">                                                  <datalist id="patient">                                                      <?php $patients = App\Patient::all(); ?>                                                    @foreach ($patients as $value)                                                    <option value="{{$value->patient_name}}">                                                    @endforeach                                                  </datalist>                                              </div>                                          </div>                                          <div class="col-md-4">                                              <div class="form-group">                                                  <label>Date</label>                                                  <input type="date" required="true" name="visit_date"class="form-control border-input" placeholder="visit_date">                                              </div>                                          </div>                                          <div class="col-md-3">                                              <div class="form-group">                                                  <label>Shift</label>                                                <select id="Shift_id" name="Shift_id" class="form-control border-input" required="true">                                                      <option disabled selected value> -- select shift -- </option>                                                      <option value="1">Morning</option>                                                      <option value="2">Evening</option>                                                </select>                                               </div>                                          </div>                                          <div class="col-md-1">                                              <div class="form-group">                                                  <label>______</label>                                           <button type="submit" class="btn btn-info btn-fill">Go</button>                                              </div>                                          </div>                                      </div>                                      <div class="clearfix"></div>                                  </form>                            </div>                        </div>                    </div>                </div>                <div class="row">                    <div class="col-md-12">                        <div class="card">                            <div class="header">                                <h4 class="title">Today</h4>                                <p class="category">visits</p>                            </div>                            <div class="content" style="overflow:auto;">                              <!--  -->                            <div class="content">                              <div class="input-group col-md-12">                                  <input type="search" class="light-table-filter" data-table="members_details" placeholder="Quick Filter">                              </div>                              <div class="text-center">                              <table class="members_details">                                <thead>                                  <tr>                                    <th class="name text_align_center"><b>Name</b></th>                                    <th class="date text_align_center"><b>Date</b></th>                                    <th class="day text_align_center"><b>Day | Time</b></th>                                    <th class="doctor text_align_center"><b>Doctor</b></th>                                    <th class="value text_align_center"><b>value | pid </b></th>                                    <th class="status text_align_center"><b>Status</b></th>                                    <th class="delete text_align_center"><b>delete</b></th>                                  </tr>                                </thead>                                <tbody>                                {{-- patient visits --}}                                <?php                                $today = date("Y-m-d");                                // $visits = App\Visit::where('visit_date','=',$today)->get();                                $user_id = Auth::user()->id;                                $role = App\UserRole::where('user_id','=',$user_id)->first();                                if ($user_id == 1 || $role->role_id == 2) {                                  $visits = App\Visit::where('visit_date','=',$today)->orderBy('created_at', 'desc')->paginate(15);                                } else {                                  $visits = App\Visit::where('doctor_id','=',$user_id)->where('visit_date','=',$today)->orderBy('created_at', 'desc')->paginate(15);                                }                                ?>                                @foreach($visits as $value)                                <tr>                                  <td class="name">                                    <a href="{{ url ('visit/'.$value->id) }}" class="" >{{App\Patient::find($value->patient_id)->patient_name}}</a>                                  </td>                                  <td class="date">                                    {{$value->visit_date}}                                  </td>                                  <td class="day">                                    <?php                                      $date_stamp = strtotime(date('Y-m-d', strtotime($value->visit_date)));                                      $stamp = date('l', $date_stamp);                                    ?>                                    {{$stamp}} | {{App\Divisions_time::find($value->divisions_time_id)->time}}                                  </td>                                  </td>                                  <td class="doctor">                                    {{App\User::find($value->doctor_id)->name}}                                  </td>                                  <td class="value text_align_center">                                    {{$value->visit_price}} | {{$value->visit_paid}}                                  </td>                                  <td class="status">                                    <?php if ($value->visit_price != $value->visit_paid) { ?>                                      <b>incomplete</b>                                    <?php } elseif($value->visit_price == $value->visit_paid && $value->visit_price != 0) { ?>                                      <b>complete</b>                                    <?php }elseif ($value->visit_price == 0) { ?>                                      <b>new</b>                                    <?php } ?>                                  </td>                                  <td class="delete">                                    {{Form::open(array(                                        'route' => array( 'visit.destroy', $value->id ),                                        'method' => 'delete',                                        'style' => 'display:inline',                                        'onsubmit' => "return confirm('Are you sure you want to delete?')",                                    ))}}                                         {{Form::submit('Delete', array('class' => 'btn btn-danger'))}}                                    {{Form::close()}}                                  </td>                                </tr>                                @endforeach                              </tbody>                            </table>                          </div>                        </div>                              <!--  -->                                <div id="chartHours" class="ct-chart"></div>                                <div class="footer">                                    <div class="chart-legend">                                      <div class="form-group text-center">                                        {{ $visits->links() }}                                      </div>                                        <!-- <i class="fa fa-circle text-info"></i> Open                                        <i class="fa fa-circle text-danger"></i> Click                                        <i class="fa fa-circle text-warning"></i> Click Second Time -->                                    </div>                                    <hr>                                    <div class="stats">                                        <!-- <i class="ti-reload"></i> Updated 3 minutes ago -->                                    </div>                                </div>                            </div>                        </div>                    </div>                </div><!--                <div class="row">                    <div class="col-md-6">                        <div class="card">                            <div class="header">                                <h4 class="title">Email Statistics</h4>                                <p class="category">Last Campaign Performance</p>                            </div>                            <div class="content">                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>                                <div class="footer">                                    <div class="chart-legend">                                        <i class="fa fa-circle text-info"></i> Open                                        <i class="fa fa-circle text-danger"></i> Bounce                                        <i class="fa fa-circle text-warning"></i> Unsubscribe                                    </div>                                    <hr>                                    <div class="stats">                                        <i class="ti-timer"></i> Campaign sent 2 days ago                                    </div>                                </div>                            </div>                        </div>                    </div>                    <div class="col-md-6">                        <div class="card ">                            <div class="header">                                <h4 class="title">2015 Sales</h4>                                <p class="category">All products including Taxes</p>                            </div>                            <div class="content">                                <div id="chartActivity" class="ct-chart"></div>                                <div class="footer">                                    <div class="chart-legend">                                        <i class="fa fa-circle text-info"></i> Tesla Model S                                        <i class="fa fa-circle text-warning"></i> BMW 5 Series                                    </div>                                    <hr>                                    <div class="stats">                                        <i class="ti-check"></i> Data information certified                                    </div>                                </div>                            </div>                        </div>                    </div>                </div> -->            </div>        </div><script type="text/javascript">$(document).ready(function(){    demo.initChartist();    $.notify({        icon: 'ti-gift',        message: "Welcome to <b>{{ config('app.name', 'Laravel') }}</b> - a beautiful system  for your clinic - by <b>obaaa</b>."      },{          type: 'success',          timer: 3000      });});</script>@endsection