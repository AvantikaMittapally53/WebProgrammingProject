@extends('layouts.app')

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<div class="container">


        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Document Details</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>

                </div>

                <div class="card-body">

                    <form action="/user/update" method="POST">
                    @csrf
                    <div class="form-group">
                           <label for="phone"><strong>Title: </strong>{{$document->title}}</label>
                       </div>
                       <br />
                       <div class="form-group">
                           <label for="name"><strong>Author: </strong>{{$document->author}}</label>
                       </div><br />
                        <div class="form-group">
                           <label for="email"><strong>Advisor: </strong>{{$document->advisor}}</label>
                       </div><br />
                       <div class="form-group">
                           <label for="phone"><strong>Degree: </strong>{{$document->degree}}</label>
                       </div>
                       <br />
                       <div class="form-group">
                           <label for="phone"><strong>Program: </strong>{{$document->program}}</label>
                       </div>
                       <br />

                       <div class="form-group">
                           <label for="phone"><strong>University: </strong>{{$document->university}}</label>
                       </div>
                       <br />
                       <div class="form-group">
                           <label for="phone"><strong>Year: </strong>{{$document->year}}</label>
                       </div>
                       <br/>
                       <div class="form-group abstract_detail" data-content="{{$document->text_data}}">
                           <label for="phone"><strong>Abstract: </strong>{{$document->text_data}}</label>
                       </div>
                       <br/>
                       <div class="form-group">
                       <label for="phone"><strong>PDF: </strong> <a href="{{ URL::to('/') }}/pdf/{{ $document->id }}.pdf" download>{{ $document->id }}.pdf<i class="fas fa-download"></i></a>
</label>   
                    </div>
                       <br />

                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var data_text = $('.abstract_detail').attr('data-content');
        console.log('data_text that we passing in api',data_text)

        $.ajax({
               type:'GET',
               url:'/get_data',
               data:{text_data:data_text},
               success:function(data) {
                 console.log(data.annotations);
               }
            });
    })
    </script>
@endsection
