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




<!-- Modal -->
<div class="modal top fade"
     id="exampleModal"
     tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true"
     data-mdb-backdrop="true"
     data-mdb-keyboard="true">
  <div class="modal-dialog  ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wiki details</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Title: <span id="title"> asasa</san></p>
      <p id="url">Url: <span id="url"> asasa</san></p>



    </div>

    </div>
  </div>
</div>



<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" rel="stylesheet" />



<script>
    function triggerModal(url,title){
        console.log(url,title);
        $("#title").html(title);
        $("#url").html("Wiki link : <a href='"+url+"' target='_blank'>"+title+"</a>");

  const myModalEl = document.getElementById('exampleModal');
  const modal = new mdb.Modal(myModalEl);
  modal.toggle();
  }
    $(document).ready(function(){
        var document_data = jQuery('.form-group.document_data p').text();
        $.ajax({
               type:'GET',
               url:'/get_data',
               data:{text_data:document_data},
               success:function(result) {
                $.each(result.annotations, function (index,value) {

                  $(".form-group.document_data p").each(function() {

  $(this).html($(this).html().replace(value.title, "<a href='"+value.url+"' target='_blank'  data-mdb-target='#exampleModal' onmouseover=triggerModal('"+value.url+"','"+value.title+"') >"+ value.title+"</a>"));
});
});
               }
            });
    })
    </script>



@endsection
