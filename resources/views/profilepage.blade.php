
@extends('layouts.app')
@section('content')
  
<div id="app" >


@if (Auth::guard('Admin')->check())
@if (Auth::guard('Admin')->user()->platform==env('Super'))
<admin-page></admin-page>
                                        
 @else

 @endif
 
 @elseif (Auth::check())
 @if (Auth::user()->platform==env('Client'))
 <client-page></client-page>
   
  @else

  @endif  

 @else

 @endif                                          
                                                              



</div>
<!--app-display-->
  <!-- ======= Hero Section ======= -->
 

  
  

@endsection