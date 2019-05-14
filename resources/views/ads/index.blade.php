@extends('layout')

@section('content')
<myjob-ad-index ads='{!!json_encode($ads)!!}' ></myjob-ad-index>
@endsection
