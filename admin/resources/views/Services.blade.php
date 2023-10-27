@extends('layouts.app')

@section('title','Services')

@section('content')

  <div id="mainDiv" class="container d-none">
    <div class="row">
      
    <div class="col-md-12 p-3">
    
    <button id="addNewBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
    
    <table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Image</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="service_table">
    
      </tbody>
    </table>
    </div>
    </div>
  </div>
  
  
  <div id="loaderDiv" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
          <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
      </div>
    </div>
  </div>
  
  
  <div id="WrongDiv" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
          <h3>Something Went Wrong !</h3>
      </div>
    </div>
  </div>
 
  
  {{--Delete-modal-section --}}
<div class="modal fade" id="deleteModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center mt-2">
          <h4>Do you want to delete?</h4>
          <h5 id="serviceDeleteId"> </h5>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button  id="deleteId" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


{{--Edit-modal-section --}}
<div class="modal fade" id="editModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body text-center mt-2 ">

      <h5 id="serviceEditId"> </h5>
      <div id="serviceEditForm" class="d-none w-100">
        <input type="text" id="serviceNameId" class="form-control mb-4" placeholder="Service Name" />
        <input type="text" id="serviceDesId" class="form-control mb-4" placeholder="Service Description" />
        <input type="text" id="serviceImgId" class="form-control mb-4" placeholder="Service Image Link" />
      </div>

      <img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
      <h3 id="serviceEditWrong" class="d-none">Something Went Wrong !</h3>
    
    </div>
    <div class="modal-footer text-center">
      <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Cencle</button>
      <button  id="editId" type="button" class="btn btn-danger">Save</button>
    </div>
  </div>
</div>
</div>  


{{--AddService-modal-section --}}
<div class="modal fade" id="addModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body text-center mt-2 ">

    
      <div id="serviceAddForm" class=" w-100">
        <h6 class="mb-4">Add New Service</h6>
        <input type="text" id="serviceNameAddId" class="form-control mb-4" placeholder="Service Name" />
        <input type="text" id="serviceDesAddId" class="form-control mb-4" placeholder="Service Description" />
        <input type="text" id="serviceImgAddId" class="form-control mb-4" placeholder="Service Image Link" />
      </div>
    
    </div>
    <div class="modal-footer text-center">
      <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Cencle</button>
      <button  id="addNewId" type="button" class="btn btn-danger">Save</button>
    </div>
  </div>
</div>
</div>  



@endsection




{{-- javascript section add --}}

@push('script')

<script> 

    getServicesData();



   //For sercvices table
function getServicesData(){


axios.get('/getServiceData')

.then(function (response) {

    if(response.status==200){

        $('#mainDiv').removeClass('d-none');
        $('#loaderDiv').addClass('d-none');

        var jsonData=response.data;

        $('#serviceDataTable').DataTable().destroy();
        $('#service_table').empty();

        $.each(jsonData, function(i) {
        $('<tr>').html(


            "<td><img class='table-img' src="+jsonData[i].service_img+"></td>" +
            "<td>"+jsonData[i].service_name+"</td>" + 
            "<td>"+jsonData[i].service_des+"</td>"  +
            "<td><a class='serviceEditBtn' data-id= " + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
            "<td><a class='serviceDeleteBtn'  data-id= " + jsonData[i].id + "> <i class='fas fa-trash-alt'></i></a></td>"

     
        ).appendTo('#service_table');

        });


        //Services table delete icon click
        $('.serviceDeleteBtn').click(function(){

                var id =  $(this).data('id');

                $('#serviceDeleteId').html(id);
                $('#deleteModal').modal('show');

            })

        //Services Delete modal Yes btn click    
        $('#deleteId').click(function(){

            var id =  $('#serviceDeleteId').html();
            servicesDelete(id);
        
        });


        //Services table edit icon click
        $('.serviceEditBtn').click(function(){

            var id =  $(this).data('id');

            $('#serviceEditId').html(id);
            $('#editModal').modal('show');
            servicesUpdateDetails(id);

        })

        //Services edit modal save btn

        $('#editId').click(function(){

            var id   =  $('#serviceEditId').html();
            var name =  $('#serviceNameId').val();
            var des  =  $('#serviceDesId').val();
            var img  =  $('#serviceImgId').val();
            servicesUpdate(id,name,des,img);

        });


        //service jquery data table

        $('#serviceDataTable').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');
            

    }else{

    $('#loaderDiv').addClass('d-none');
    $('#WrongDiv').removeClass('d-none');

    }

})

.catch(function(){

    $('#loaderDiv').addClass('d-none');
    $('#WrongDiv').removeClass('d-none');

});

}


//Services Delete 
function servicesDelete(deleteId){
axios.post('/serviceDelete',{id:deleteId})

.then(function(response){

    if(response.data==1){
        $('#deleteModal').modal('hide');
        getServicesData();

    }else{
        $('#deleteModal').modal('hide');
        getServicesData();
        
    }
    
})
.catch(function(){


});
}

//Each Services Update Details 
function servicesUpdateDetails(detailsId){
axios.post('/serviceDetails',{id:detailsId})

.then(function(response){

    if(response.status==200){

        $('#serviceEditForm').removeClass('d-none');
        $('#serviceEditLoader').addClass('d-none');

        var jsonData=response.data;
        $('#serviceNameId').val(jsonData[0].service_name);
        $('#serviceDesId').val(jsonData[0].service_des);
        $('#serviceImgId').val(jsonData[0].service_img);
    }else{

        $('#serviceEditLoader').addClass('d-none');
        $('#serviceEditWrong').removeClass('d-none');

    }
          
})
.catch(function(){
    $('serviceEditLoader').addClass('d-none');
    $('serviceEditWrong').removeClass('d-none');

});
}


// Services Update  
function servicesUpdate(serviceId,serviceName,serviceDes,serviceImg){

axios.post('/serviceUpdate',

{   id:serviceId,
    name:serviceName,
    des:serviceDes,
    img:serviceImg
})

.then(function(response){

    if(response.data==1){
        $('#editModal').modal('hide');
        getServicesData();
        

    }else{
        $('#deleteModal').modal('hide');
        getServicesData();
        
    }
          
})
.catch(function(){
 

});
}


//Service add new btn click

$('#addNewBtnId').click(function(){
$('#addModal').modal('show');
})

//Services add modal save btn

$('#addNewId').click(function(){

var name =  $('#serviceNameAddId').val();
var des  =  $('#serviceDesAddId').val();
var img  =  $('#serviceImgAddId').val();
servicesAdd(name,des,img);

});


//sercvice add method
function servicesAdd(serviceName,serviceDes,serviceImg){

axios.post('/serviceAdd',

{  
    name:serviceName,
    des:serviceDes,
    img:serviceImg
})

.then(function(response){

    if(response.data==1){
        $('#addModal').modal('hide');
        getServicesData();
        

    }else{
        $('#addModal').modal('hide');
        getServicesData();
        
    }
          
})
.catch(function(){
 
    $('#addModal').modal('hide');
});
}


</script>

@endpush



