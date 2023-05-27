@extends('admin.layouts.master')

@section('content')
<form>Start date: <input type="date" name="start_date"> End date: <input type="date"name="end_date" > <button type="submit">Submit</button></form>
<br>
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-customView_index-list') }}</div>
        </div>
        <div class="portlet-body">
            {{ trans('quickadmin::templates.templates-customView_index-welcome_custom_view') }}
        </div>
	</div>
   

@endsection