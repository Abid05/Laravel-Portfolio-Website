

@extends('layouts.app')

@section('title','Projects')

@section('content')


<div  id="mainDivProject" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">

      <button id="addNewBtnIdProject" class="btn my-3 btn-sm btn-danger">Add New </button>

    <table id="ProjectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Name</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="project_Table">
    	
        
      </tbody>
    </table>
    
    </div>
    </div>
    </div>



     
  <div id="loaderDivProject" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
          <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
      </div>
    </div>
  </div>
  
  
  <div id="WrongDivProject" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
          <h3>Something Went Wrong !</h3>
      </div>
    </div>
  </div>



{{-- add-Modal-template --}}
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  <div class="modal-header">
      <h5 class="modal-title">Add New Project</h5>
      <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body  text-center">
     <div class="container">
       <div class="row">
         <div class="col-md-12">

            <input id="ProjectNameId" type="text"  class="form-control mb-3" placeholder="Project Name">
            <input id="ProjectDesId" type="text"  class="form-control mb-3" placeholder="Project Description">
            <input id="ProjectlinkId" type="text" class="form-control mb-3" placeholder="Project Link">
            <input id="ProjectImgId" type="text"  class="form-control mb-3" placeholder="Project Image">

         </div>

       </div>
     </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
      <button  id="ProjectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>

{{-- Update-Modal-template --}}
<div class="modal fade" id="updateProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  <div class="modal-header">
      <h5 class="modal-title">Update Course</h5>
      <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body  text-center">
      <h5 id="ProjectEditId"> </h5>
     <div id="ProjectEditForm" class="container d-none">
       <div class="row">
         <div class="col-md-12">
            <input id="ProjectNameUpId" type="text"  class="form-control mb-3" placeholder="Project Name">
            <input id="ProjectDesUpId" type="text" class="form-control mb-3" placeholder="Project Description">
            <input id="ProjectlinkUpId" type="text" class="form-control mb-3" placeholder="Project Link">
            <input id="ProjectImgUpId" type="text"  class="form-control mb-3" placeholder="Project Image">
         </div>
       </div>
     </div>

     <img id="projectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
     <h3 id="projectEditWrong" class="d-none">Something Went Wrong !</h3>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
      <button  id="projectUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>


{{--Delete-modal-section --}}
<div class="modal fade" id="deleteProjectModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center mt-2">
          <h4>Do you want to delete?</h4>
          <h5 id="projectDeleteId"> </h5>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button  id="projectId" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection



@push('script')
    <script>
        getProjectData();





    </script>
@endpush


