@extends('layouts.app')
@section('content')
<!--main content start-->
<section class="wrapper">
@include('layouts.newnotification')

    <h3><i class="fa fa-angle-right"></i> <strong>Dashboard</strong> </h3>
    <div>

    </div><br>




    <div class="row">
        <div class="col-md-12">
            <div class="content-panel table-responsive formi">


				<div class="row mt">
				  <!--CUSTOM CHART START -->
				  <div class="border-head">
				      <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Visitas</font></font></h3>
				  </div>
				  <div class="custom-bar-chart">
				      <ul class="y-axis">
				          <li><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10.000</font></font></span></li>
				          <li><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.000</font></font></span></li>
				          <li><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6.000</font></font></span></li>
				          <li><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4.000</font></font></span></li>
				          <li><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.000</font></font></span></li>
				          <li><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0 0</font></font></span></li>
				      </ul>
				      <div class="bar">
				          <div class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ENE</font></font></div>
				          <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top" style="height: 85%;"></div>
				      </div>
				      <div class="bar ">
				          <div class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FEB</font></font></div>
				          <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top" style="height: 50%;"></div>
				      </div>
				      <div class="bar ">
				          <div class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">MAR</font></font></div>
				          <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top" style="height: 60%;"></div>
				      </div>
				      <div class="bar ">
				          <div class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ABR</font></font></div>
				          <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top" style="height: 45%;"></div>
				      </div>

				      <div class="bar">
				          <div class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">MAYO</font></font></div>
				          <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top" style="height: 32%;"></div>
				      </div>
				      <div class="bar ">
				          <div class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">JUN</font></font></div>
				          <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top" style="height: 62%;"></div>
				      </div>
				      <div class="bar">
				          <div class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">JUL</font></font></div>
				          <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top" style="height: 75%;"></div>
				      </div>
				  </div>
				  <!--custom chart end-->
				</div>

				</div>
				</div><!-- /col-md-12 -->
				</div><!-- row -->


</section>
@endsection
