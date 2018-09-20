@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li >Reports</li>
                <li class="active">Installments accrued, but unpaid to insurer</li>
              </ul>
            
              <div class="col-lg-12">
                  <h2 class="font-thin">Installments accrued, but unpaid to insurer</h2>
                </div>
              <div class="row">
              <div class="col-sm-12">
               <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Report Criteria
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">PAYMENT DATE</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">INSURER</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">FORMAT</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="" class="form-control rounded">
                      </div>
                    </div>

                    </form>
                    </div>
                    </section>
                    </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop