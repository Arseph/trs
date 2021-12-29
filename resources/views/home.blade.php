@extends('layouts.app')

@section('content')
<div class="x_content">
<h3 class="text-muted font-13 m-b-30">
  Trainings
</h3>
@if(count($trainings) > 0)
<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Training Subject</th>
      <th>Venue</th>
      <th>Date</th>
    </tr>
  </thead>


  <tbody>
    @foreach($trainings as $row)
    <tr>
      <td>{{ $row->training_subject }}</td>
      <td>{{ $row->venue }}</td>
      <td>{{ \Carbon\Carbon::parse($row->date_training)->format('l, F d, Y') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <strong>No Trainings Found!</strong>
</div>
@endif
</div>
@endsection
