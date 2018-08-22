@extends('layouts.app')
@section('content')

<div class="container">
	<div>
	    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for hospitals..">

	    <table  class="display" id="patie-data-table">
	        <tr style="background-color: #eee">
	            <th style="width: 20%">Year of admission</th>
	            <th style="width: 20%">Age group</th>
				<th style="width: 5%">Sex</th>
				<th style="width: 10%">Comorbidity</th>
				<th style="width: 20%">Exclusive breast feeding</th>
				<th style="width: 10%">Birthweight</th>
				<th style="width: 15%"></th>
			</tr>

			@if(!is_null($pneumonia_factors))
				@foreach($pneumonia_factors as $factor)
				<tr>
				    <td>{{ Carbon\Carbon::parse($factor->year_of_admission)->format('Y')  }}</td>
				    <!-- '1'=>'0-20 months','2'=>'21-40 months','3'=>'41-60 months' -->
				    @if($factor->age_group == 1)
				        <td>0-20 months</td>
				    @elseif($factor->age_group == 2)
				        <td>21-40 months</td>
				    @else
				        <td>41-60 months</td>
				    @endif
				
					<td>{{ $factor->gender == 2 ? 'Female' : 'Male' }}</td>
					<td>{{ $factor->comorbidity }}</td>
					<td>{{ $factor->exclusive_breast_feeding }}</td>
					<td>{{ $factor->birthweight }}</td>
					<td align="right">
					    <a action="edit" class="btn btn-primary" href="#"><span class="glyphicon glyphicon-pencil pull-left">&nbsp;</span>Edit</a>
					    <a action="delete" class="btn btn-danger" href="#"><span class="pull-left">&nbsp;</span>Delete</a>
					</td>
				</tr>
				@endforeach
			@else
			    <tr>
			    	<td colspan="4">No records in the db</td>
			    </tr>
			@endif
		</table>
	</div>
</div>
@endsection
<script type="text/javascript">
	function myFunction() {
	  // Declare variables 
	  var input, filter, table, tr, td, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("patie-data-table");
	  tr = table.getElementsByTagName("tr");

	  // Loop through all table rows, and hide those who don't match the search query
	  for (i = 0; i < tr.length; i++) {
	    td = tr[i].getElementsByTagName("td")[0];
	    if (td) {
	      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
	        tr[i].style.display = "none";
	      }
	    } 
	  }
	}
</script>
<style type="text/css">
	#myInput {
	    /*background-image: url('/css/searchicon.png');*/ /* Add a search icon to input */
	    background-position: 10px 12px; /* Position the search icon */
	    background-repeat: no-repeat; /* Do not repeat the icon image */
	    width: 100%; /* Full-width */
	    font-size: 16px; /* Increase font-size */
	    padding: 12px 20px 12px 40px; /* Add some padding */
	    border: 1px solid #ddd; /* Add a grey border */
	    margin-bottom: 12px; /* Add some space below the input */
	}
</style>