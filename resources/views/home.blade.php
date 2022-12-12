@extends('LayoutsLanding.layout')
@section('container')
<div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
        <div class="img1">
        </div>
<!--<img class=" imgCstm " src="images/home/bng_00.jpg" alt="First slide">-->
    </div> 
</div> 


<style>
  .carousel-inner { 
     height: 100vh;
     <! --  custom hight -->
  }

  .carousel-item  { 
     height: 100%;
  }

  .img1 {
     background-image: url('https://thumbs.dreamstime.com/b/group-doctors-hospital-communication-making-scientific-experiments-diverse-medical-workers-blue-background-flat-banner-group-121864009.jpgg');
     height: 50%;
     width: 100%;
     background-repeat: no-repeat;
     background-attachment: fixed !important;
     background-size: cover !important;   
     background-position: center !important;
    }
</style>
@endsection