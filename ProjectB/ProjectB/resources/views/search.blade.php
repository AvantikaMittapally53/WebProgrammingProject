@extends('layouts.app')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .row.mt-5.context .card-body {
    background: #f7f7f7;
}

.card.mt-2 {
    border: none;
}

ul.pagination {
    justify-content: center;
}
button.btn.btn-lg.btn-success {
    border-radius: 30px;
    line-height: normal;
    text-transform: uppercase;
    font-size: 16px;
}

.container.mt-5 h3 {
    text-align: center;
    margin-bottom: 20px;
    font-weight: 400;
}

.d-flex .form-control.form-control-lg.form-control-borderless {
    border: 1px solid #ddd;
    border-radius: 30px;
    font-size: 16px;
}
.d-flex :where(.col,.col-auto) {
    padding: 0;
}
@media (max-width:767px){
    ul.pagination {
    flex-wrap: wrap;
    grid-row-gap: 10px;
    grid-column-gap: 10px;
}
.container.mt-5 h3 {
    font-size: 1.25rem;
}
.top_searchbar form.card .card-body {
    padding: 20px 5px;
}
.top_searchbar form.card .card-body .d-flex {
    align-items: center;
}
}
.title-word {	
  animation: color-animation 4s linear infinite;	
}	
.title-word-1 {	
  --color-1: #DF8453;	
  --color-2: #3D8DAE;	
  --color-3: #E4A9A8;	
}	
@keyframes color-animation {	
  0%    {color: var(--color-1)}	
  32%   {color: var(--color-1)}	
  33%   {color: var(--color-2)}	
  65%   {color: var(--color-2)}	
  66%   {color: var(--color-3)}	
  99%   {color: var(--color-3)}	
  100%  {color: var(--color-1)}	
}

</style>
<div class="container">
    <br/>
	<div class="row justify-content-center top_searchbar">
                        <div class="col-12 col-md-10 col-lg-8">
                        <div class="d-flex align-items-center"> 	
                            <div class="p-2">	
                            	
                          <h2>  <span class="title-word title-word-1">Search Engine</span></h2>	
                        </div> 	
                        <div class="p-2  flex-grow-1">                            <form class="card card-sm" method="GET" action="/search">
                            @csrf

                                <div class="card-body row no-gutters align-items-center">
                                    <label>Searchtext:</label>
                                    <!-- <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div> -->
                                    <!--end of col-->
                                   <div class="d-flex gap-2"> <div class="col">
                                        <input  class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search topics or keywords" id="q" name="q" value={{ request()->get('q', '') }} >
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                   </div>
                                </div>
                            </form>
                            </div>	
</div>	
</div>
                        </div>
                        <!--end of col-->
                    </div>
</div>
<hr style="height:2px;border-width:0;color:gray;background-color:gray">
    <div class="container mt-5">
    <!-- <h1 class="text-center">All the documents</h1> -->
    @if (request()->get('q'))
    <h4> About {{$documents->total()}}  Results for <b>{{request()->get('q')}}</b></h4>	
    @else	
    <h4> About {{$documents->total()}}  Results </h4>	
    @endif	
@if (request()->get('q'))	
{!! $documents->appends($_GET)->links("pagination::bootstrap-5") !!}	
@else	
{!! $documents->appends($_GET)->links("pagination::bootstrap-5") !!}
@endif
    <div class="row mt-5 context search_main">
    @foreach($documents as $document)
            <div class="col-lg-12 search_list">
                <div class="card mt-2">
                    <div class="card-body">
                        <a href="/search/{{$document->id}}" ><h5 class="card-title">{{$document->title}}</h5></a>
                        <p class="card-text"><b>Author</b> : {{$document->author}}</p>                        <div class="description">
                            <div class="short-decscription" style="height:100%;max-height:100px;overflow: hidden;">
                            <p><b>Abstract</b>: {{$document->text_data}}</p>                            </div>
                            <a href="javascript:void(0);" class="read_more">read more....</a>
                            <a href="javascript:void(0);" class="read_less" style="display:none;">read less</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/mark.min.js" integrity="sha512-5CYOlHXGh6QpOFA/TeTylKLWfB3ftPsde7AnmhuitiTX4K5SqCLBeKro6sPS8ilsz1Q4NRx3v8Ko2IBiszzdww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
     function triggerModal(url,title){
        console.log(url,title);
        $("#title").html(title);
        $("#url").html("Wiki Link : <a href='"+url+"' target='_blank'>"+title+"</a>");

  const myModalEl = document.getElementById('exampleModal');
  const modal = new mdb.Modal(myModalEl);
  modal.toggle();
  }
    jQuery(document).ready(function(){
        $(".search_main .search_list").each(function() {
        var document_data = jQuery(this).find('.description p').text();
        var $this = jQuery(this);
        $.ajax({
               type:'GET',
               url:'/get_data',
               data:{text_data:document_data},
               success:function(result) {
                $.each(result.annotations, function (index,value) {
                   // console.log(value);
                    $this.find('.description .short-decscription p').each(function() {
                    $(this).html($(this).html().replace(value.title, "<a href='"+value.url+"' target='_blank'  data-mdb-target='#exampleModal' onmouseover=triggerModal('"+value.url+"','"+value.title+"') >"+ value.title+"</a>"));
                    });
                });
               }
            });  });
    jQuery('.description a.read_more').on("click",function(){
   jQuery(this).parent().find(".short-decscription").css('max-height','100%');
   jQuery(this).hide();
   jQuery(this).parent().find('.read_less').show();
});
jQuery('.description a.read_less').on("click",function(){
    jQuery(this).parent().find(".short-decscription").css('max-height','100px');
   jQuery(this).hide();
   jQuery(this).parent().find('.read_more').show();
});
})

var instance = new Mark(document.querySelector(".context"));
instance.mark("{{ request()->get('q', '') }}");
</script>

@endsection
