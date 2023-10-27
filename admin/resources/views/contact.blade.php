@extends('layouts.app')

@section('title','Contact')

@section('content')


<div  id="mainDivContact" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">

    <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Name</th>
          <th class="th-sm">Mobile</th>
          <th class="th-sm">Email</th>
          <th class="th-sm">Message</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="contact_Table">
    	
        
      </tbody>
    </table>
    
    </div>
    </div>
    </div>

     
  <div id="loaderDivContact" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
          <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
      </div>
    </div>
  </div>
  
  
  <div id="WrongDivContact" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
          <h3>Something Went Wrong !</h3>
      </div>
    </div>
  </div>


{{--Delete-modal-section --}}
<div class="modal fade" id="contactDeleteModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center mt-2">
          <h4>Do you want to delete?</h4>
          <h5 id="contactDeleteId"> </h5>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button  id="contactId" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection



@push('script')
    <script>
        getContactData();



//For sercvices table
function getContactData(){


axios.get('/getcontactData')

.then(function (response) {

    if(response.status==200){

        $('#mainDivContact').removeClass('d-none');
        $('#loaderDivContact').addClass('d-none');

        var jsonData=response.data;

        $('#contactDataTable').DataTable().destroy();
        $('#contact_Table').empty();

        $.each(jsonData, function(i) {
        $('<tr>').html(

            "<td>"+jsonData[i].contact_name+"</td>" +
            "<td>"+jsonData[i].contact_mobile+"</td>" + 
            "<td>"+jsonData[i].contact_email+"</td>" + 
            "<td>"+jsonData[i].contact_mgz+"</td>" + 
            "<td><a class='contactDeleteBtn'  data-id= " + jsonData[i].id + "> <i class='fas fa-trash-alt'></i></a></td>"

     
        ).appendTo('#contact_Table');

        });


        //courses table delete icon click
        $('.contactDeleteBtn').click(function(){

            var id =  $(this).data('id');

            $('#contactDeleteId').html(id);
            $('#contactDeleteModal').modal('show');

        })

        //Courses Delete modal Yes btn click    
        $('#contactId').click(function(){

            var id =  $('#contactDeleteId').html();
            contactDelete(id);
        
        });

 

        //service jquery data table

        $('#contactDataTable').DataTable({"order":false});
        $('.dataTables_length').addClass('bs-select');

     

    }else{

    $('#loaderDivContact').addClass('d-none');
    $('#WrongDivContact').removeClass('d-none');

    }

})

.catch(function(){

    $('#loaderDivContact').addClass('d-none');
    $('#WrongDivContact').removeClass('d-none');


});

}




//Courses Delete 

function contactDelete(deleteId){
axios.post('/contactDelete',{id:deleteId})

.then(function(response){

    if(response.data==1){
        $('#contactDeleteModal').modal('hide');
        getContactData();

    }else{
        $('#contactDeleteModal').modal('hide');
        getContactData();
        
    }
    
})
.catch(function(){

    $('#contactDeleteModal').modal('hide');
    getContactData();
        
});
}








    </script>
@endpush


