@extends('frontend2.master')

@section('header_title')
{{ $title or '' }}
@endsection

<!--
@section('contentheader_title')
{{  $title  or '' }}
@endsection

@section('contentheader_description')
{{ $title_description or '' }}
@endsection-->

@section('main-content')
<!-- content-section-starts-here -->
<div class="main-body">
    <div class="wrap">
        <ol class="breadcrumb">
            <li><a href="{{url('/2')}}">Home</a></li>
            <li class="active">About</li>
        </ol>
        <div class="col-md-8 content-left">
            <div class="about">
                <h2 class="head">Tentang Peneliti</h2>
                <!-- <h5>LITTLE BIT ABOUT US</h5> -->
                <!-- <p></p> -->
                
                <div class="more-address"> 
                            <address>
                              <strong>Irsal Shabirin</strong><br>
                              <!-- 795 Folsom Ave, Suite 600<br> -->
                              Klampis Harapan 5 no. 12<br>
                              <abbr title="Phone">P :</abbr> (+62) 89 77 23 70 22
                            </address>
                            <address>
                              <strong>Email</strong><br>
                              <a href="mailto:irsal@pasca.student.pens.ac.id">irsal@pasca.student.pens.ac.id</a>
                           </address>
                      </div>

            </div>

        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!-- content-section-ends-here -->
@endsection