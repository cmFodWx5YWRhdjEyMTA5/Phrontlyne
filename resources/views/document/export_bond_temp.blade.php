@extends('layouts.default')
@section('content')

 <section class="vbox bg-white">
          
<form method="post" action="/add-bond-template">
  
 <textarea id="bond_template_exp" name="bond_template_exp">  </textarea>
 <br>
 <br>
 <br>

  <footer class="panel-footer text-right bg-light lter">
  <button type="submit" class="btn btn-success btn-s-xs">Save Report</button>
  <input type="hidden" name="_token" value="{{ Session::token() }}">
  <input type="text" name="template_name" id="template_name" class="form-control" value="">
  <input type="text" name="template_description" id="template_description" class="form-control" value="">
 </footer>

</form>

  </section>

             
@stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script src="{{ asset('/js/tinymce/tinymce.min.js')}}"></script>
 
 <script>tinymce.init({
  selector: '#bond_template_exp',
  height: 700,
  menubar: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount',
    'template'
  ],
  toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  templates: [
    
    //{title: 'Bid Bond', description: 'Bid Bond', url: 'http://127.0.0.1:8001/bond-test/4'}
    {title: 'Exp Bond', description: 'Exportation Bond', url: 'http://127.0.0.1:8001/bond-test/3'}
  
  ],
  template_replace_values: {
    bond_number: "{{ $policy->policy_number }}",
    bond_description: "{{ $risk->bond_contract_description }}",
    insured_name: "{{ strtoupper($policy->fullname) }}",
    insured_address: "{{ strtoupper($customers->postal_address) }}",
    bond_date: "{{ Carbon\Carbon::parse($policy->created_on)->format('l jS \\of F Y') }}",
    principal: "{{ strtoupper($risk->bond_interest) }}",
    company_name: "{{ strtoupper($company->legal_name) }}",
    amount_in_words: "{{ ucwords(strtoupper($amountinwords)) }}",
    bond_amount:"{{ $suminsured }}",
    covertype:"{{ $policy->coverage }}",
    bond_currency:"{{ $policy->policy_currency }}",
    created_by:"{{ Auth::user()->getNameOrUsername() }}"
  }

  

});
 </script>



