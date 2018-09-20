@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Invoice</p>
            </header>
            <section class="scrollable wrapper">
              <i class="fa fa-power-off fa fa-3x"></i>
              <div class="row">
                <div class="col-xs-6">
                  <h4>McOcttleyBrokers</h4>
                  <p><a href="#">www.McOcttleyBrokers.com</a></p>
                  <br>
                 <p>{{ $customers->fullname }} <br>
                    {{  $customers->postal_address }}<br>
                    Ghana
                  </p>
                  <p>
                    Telephone:  +{{ $customers->mobile_number }}<br>
                    Email:  {{ $customers->email }}
                  </p> 
                </div>
                <div class="col-xs-6 text-right">
                  <p class="h4">Policy : {{ $policydetails->policy_number }} </p>
                  <h5>{{ date('Y-m-d') }}</h5>   
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($policydetails->ref_number, 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>

              <div class="col-sm-6">                
              <section class="panel panel-info portlet-item">
              <header class="panel-heading">
                                        Policy Details
                                      </header>
                                     <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Customer : {{ $policydetails->fullname }}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Coverage : {{ $policydetails->policy_product }}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Object : {{ $fetchrecord->vehicle_registration_number }}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Policy type : {{ $policydetails->policy_type }}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Insurer : {{ $policydetails->policy_insurer }}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Policy number : {{ $policydetails->policy_number }}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Issue date : {{ $policydetails->created_on }}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Start date : {{ $policydetails->insurance_period_from }}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>End date : {{ $policydetails->insurance_period_to }}
                                        </a>
                                    </div>
                                    </section>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                    <section class="panel panel-info portlet-item">
                                      <header class="panel-heading">
                                        Object Details
                                      </header>
                                      @if($policydetails->policy_product == 'Motor Insurance')
                                     <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Cover : {{ $fetchrecord->preferedcover}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Vehicle Value : {{ $fetchrecord->vehicle_currency}}{{ $fetchrecord->vehicle_value}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Buy Back Excess : {{ $fetchrecord->vehicle_buy_back_excess}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Increase Standard Limit : {{ $fetchrecord->vehicle_tppdl_value}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Vehicle Make : {{ $fetchrecord->vehicle_make}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Vehicle Model : {{ $fetchrecord->vehicle_model}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Body Type : {{ $fetchrecord->vehicle_body_type}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Vehicle Use : {{ $fetchrecord->vehicle_use}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Make Year : {{ $fetchrecord->vehicle_make_year}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Seating Capacity : {{ $fetchrecord->vehicle_seating_capacity}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Cubic Capacity : {{ $fetchrecord->vehicle_cubic_capacity}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Registration Number : {{ $fetchrecord->vehicle_registration_number}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Chassis Number : {{ $fetchrecord->vehicle_chassis_number}}
                                        </a>
                                    </div>

                                    @elseif($policydetails->policy_product == 'Travel Insurance')
                                      <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Date of Departure : {{ $fetchrecord->departure_date}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Date of Arrival : {{ $fetchrecord->arrival_date}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Destination Address : {{ $fetchrecord->destination_address}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Passport No. : {{ $fetchrecord->passport_number}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Issuing Country : {{ $fetchrecord->issuing_country}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Citizenship : {{ $fetchrecord->citizenship}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Name of Beneficiary : {{ $fetchrecord->beneficiary_name}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Relationship with Beneficiary : {{ $fetchrecord->beneficiary_relationship}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Beneficiary contact details : {{ $fetchrecord->beneficiary_contact}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Particulars of other persons who are to be insured : {{ $fetchrecord->insured_persons}}
                                        </a>
                                      </div>

                                       @elseif($policydetails->policy_product == 'Personal Accident Insurance')
                                        <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Sum Insured : {{ $fetchrecord->pa_sum_insured}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Height : {{ $fetchrecord->pa_height}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Weight : {{ $fetchrecord->pa_weight}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Marital Status : {{ $fetchrecord->marital_status}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Nature of Work : {{ $fetchrecord->nature_of_work}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Nature of Accident : {{ $fetchrecord->pa_nature_of_accident}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Activities Detail : {{ $fetchrecord->pa_activities}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Benefit Details : {{ $fetchrecord->pa_benefit_details}}
                                        </a>
                                        
                                      </div>

                                      @elseif($policydetails->policy_product == 'Fire Insurance')
                                        <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Risk Covered : {{ $fetchrecord->fire_risk_covered}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Sum Insured : {{ $fetchrecord->fire_building_cost}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Deductible : {{ $fetchrecord->fire_deductible}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Personal Property Coverage : {{ $fetchrecord->fire_personal_property_coverage}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Temporay Rental Costs Coverage : {{ $fetchrecord->fire_temporary_rental_cost}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Building Address : {{ $fetchrecord->fire_building_address}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Property Type : {{ $fetchrecord->fire_property_type}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Construction details of your wall : {{ $fetchrecord->walled_with}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Construction details of your roof : {{ $fetchrecord->roofed_with}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Is your building subject to a mortgage loan? : {{ $fetchrecord->fire_mortgage_status}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Mortgage company : {{ $fetchrecord->fire_mortgage_company}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Property Content  : {{ $fetchrecord->property_content}}
                                        </a>
                                        
                                      </div>

                                      @elseif($policydetails->policy_product == 'Bond Insurance')
                                        <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Bond Type : {{ $fetchrecord->bond_risk_type}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Bond Interest : {{ $fetchrecord->bond_interest}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Bond Interest Address : {{ $fetchrecord->bond_interest_address}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Contract Sum : {{ $fetchrecord->contract_sum}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Sum Insured : {{ $fetchrecord->bond_sum_insured}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Contract Description : {{ $fetchrecord->bond_contract_description}}
                                        </a>
                                        
                                      </div>

                                      @elseif($policydetails->policy_product == 'Engineering Insurance')
                                        <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Risk Type : {{ $fetchrecord->car_risk_type}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Parties Involved : {{ $fetchrecord->car_parties}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Nature of Business : {{ $fetchrecord->car_nature_of_business}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Contract Description : {{ $fetchrecord->car_contract_description}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Engineering Sum Insured : {{ $fetchrecord->car_contract_sum}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Deductible : {{ $fetchrecord->car_deductible}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Items : {{ $fetchrecord->car_endorsements}}
                                        </a>
                                        
                                      </div>

                                      @else
                                      <div>
                                        
                                      </div>
                                      @endif
                                    </section>
                                    </div>


             
  

          </section>

          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <h4 class="text-center">Thank you for doing business with us!</h4><br><br>
@stop