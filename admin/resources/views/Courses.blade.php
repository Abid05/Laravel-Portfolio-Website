

@extends('layouts.app')

@section('title','Course')

@section('content')


<div  id="mainDivCourse" class="container d-none">
    <div class="row">
    <div class="col-md-12 p-5">

      <button id="addNewBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>

    <table id="CourseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Name</th>
          <th class="th-sm">Fee</th>
          <th class="th-sm">Class</th>
          <th class="th-sm">Enroll</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="course_Table">
    	
        
      </tbody>
    </table>
    
    </div>
    </div>
    </div>



     
  <div id="loaderDivCourse" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
          <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
      </div>
    </div>
  </div>
  
  
  <div id="WrongDivCourse" class="container d-none">
    <div class="row">
      <div class="col-md-12 text-center p-5">
          <h3>Something Went Wrong !</h3>
      </div>
    </div>
  </div>



{{-- add-Modal-template --}}
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  <div class="modal-header">
      <h5 class="modal-title">Add New Course</h5>
      <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body  text-center">
     <div class="container">
       <div class="row">
         <div class="col-md-6">
             <input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
             <input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
         <input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
         <input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
         </div>
         <div class="col-md-6">
         <input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
         <input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
         <input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
         </div>
       </div>
     </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
      <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>

{{-- Update-Modal-template --}}
<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
      <h5 id="courseEditId"> </h5>
     <div id="courseEditForm" class="container d-none">
       <div class="row">
         <div class="col-md-6">
            <input id="CourseNameUpId" type="text"  class="form-control mb-3" placeholder="Course Name">
            <input id="CourseDesUpId" type="text" class="form-control mb-3" placeholder="Course Description">
            <input id="CourseFeeUpId" type="text" class="form-control mb-3" placeholder="Course Fee">
            <input id="CourseEnrollUpId" type="text"  class="form-control mb-3" placeholder="Total Enroll">
         </div>
         <div class="col-md-6">
         <input id="CourseClassUpId" type="text" class="form-control mb-3" placeholder="Total Class">      
         <input id="CourseLinkUpId" type="text"  class="form-control mb-3" placeholder="Course Link">
         <input id="CourseImgUpId" type="text"  class="form-control mb-3" placeholder="Course Image">
         </div>
       </div>
     </div>

     <img id="courseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
     <h3 id="courseEditWrong" class="d-none">Something Went Wrong !</h3>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-mdb-dismiss="modal">Cancel</button>
      <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>


{{--Delete-modal-section --}}
<div class="modal fade" id="deleteCourseModal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center mt-2">
          <h4>Do you want to delete?</h4>
          <h5 id="courseDeleteId"> </h5>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">No</button>
        <button  id="courseId" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection



@push('script')
    <script>
        getCourseData();



   //For sercvices table
function getCourseData(){


    axios.get('/getCoursesData')
    
    .then(function (response) {
    
        if(response.status==200){
    
            $('#mainDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');
    
            var jsonData=response.data;
    
            $('#CourseDataTable').DataTable().destroy();
            $('#course_Table').empty();
    
            $.each(jsonData, function(i) {
            $('<tr>').html(
    
                "<td>"+jsonData[i].course_name+"</td>" +
                "<td>"+jsonData[i].course_fee+"</td>" + 
                "<td>"+jsonData[i].course_totalclass+"</td>"  +
                "<td>"+jsonData[i].course_totalenroll+"</td>"  +
                "<td><a class='courseEditBtn' data-id= " + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                "<td><a class='courseDeleteBtn'  data-id= " + jsonData[i].id + "> <i class='fas fa-trash-alt'></i></a></td>"
    
         
            ).appendTo('#course_Table');
    
            });


            //courses table delete icon click
            $('.courseDeleteBtn').click(function(){

                var id =  $(this).data('id');

                $('#courseDeleteId').html(id);
                $('#deleteCourseModal').modal('show');

            })

            //Courses Delete modal Yes btn click    
            $('#courseId').click(function(){

                var id =  $('#courseDeleteId').html();
                coursesDelete(id);
            
            });

            //courses table Update icon click
            $('.courseEditBtn').click(function(){

                var id =  $(this).data('id');

                $('#courseDeleteId').html(id);
                coursesUpdateDetails(id);
                $('#courseEditId').html(id);
                $('#updateCourseModal').modal('show');

            })

            //service jquery data table

            $('#CourseDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');

         
    
        }else{
    
        $('#loaderloaderDivCourse').addClass('d-none');
        $('#WrongDivCourse').removeClass('d-none');
    
        }
    
    })
    
    .catch(function(){
    
        $('#loaderloaderDivCourse').addClass('d-none');
        $('#WrongDivCourse').removeClass('d-none');
    
    
    });
    
    }

    // Add-course-methode

    $('#addNewBtnId').click(function(){
        $('#addCourseModal').modal('show');
    })


    $('#CourseAddConfirmBtn').click(function(){

        var c_name       = $('#CourseNameId').val();
        var c_des        = $('#CourseDesId').val();
        var c_fee        = $('#CourseFeeId').val();
        var c_enroll     = $('#CourseEnrollId').val();
        var c_totalclass = $('#CourseClassId').val();
        var c_link       = $('#CourseLinkId').val();
        var c_img        = $('#CourseImgId').val();

        courseAdd(c_name,c_des,c_fee,c_enroll,c_totalclass,c_link,c_img);
    })

    //Course add method
    function courseAdd(c_name,c_des,c_fee,c_enroll,c_totalclass,c_link,c_img){

    axios.post('/coursesAdd',
    
    {  
        course_name:c_name,
        course_des:c_des,
        course_fee:c_fee,
        course_totalenroll:c_enroll,
        course_totalclass:c_totalclass,
        course_link:c_link,
        course_img:c_img,
    })
    
    .then(function(response){
    
        if(response.data==1){
            $('#addCourseModal').modal('hide');
            getCourseData();
            
    
        }else{
            $('#addCourseModal').modal('hide');
            getCourseData();
            
        }
              
    })
    .catch(function(){
     
        $('#addCourseModal').modal('hide');
    });
    }



    //Courses Delete 

    function coursesDelete(deleteId){
    axios.post('/coursesDelete',{id:deleteId})
    
    .then(function(response){
    
        if(response.data==1){
            $('#deleteCourseModal').modal('hide');
            getCourseData();
    
        }else{
            $('#deleteCourseModal').modal('hide');
            getCourseData();
            
        }
        
    })
    .catch(function(){
    
        $('#deleteCourseModal').modal('hide');
        getCourseData();
            
    });
    }



    //Each Courses Update Details 
    function coursesUpdateDetails(detailsId){

    axios.post('/coursesDetails',{id:detailsId})
    
    .then(function(response){
    
        if(response.status==200){
    
            $('#courseEditForm').removeClass('d-none');
            $('#courseEditLoader').addClass('d-none');
    
            var jsonData=response.data;
            $('#CourseNameUpId').val(jsonData[0].course_name);
            $('#CourseDesUpId').val(jsonData[0].course_des);
            $('#CourseFeeUpId').val(jsonData[0].course_fee);
            $('#CourseEnrollUpId').val(jsonData[0].course_totalenroll);
            $('#CourseClassUpId').val(jsonData[0].course_totalclass);
            $('#CourseLinkUpId').val(jsonData[0].course_link);
            $('#CourseImgUpId').val(jsonData[0].course_img);
        }else{
    
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');
    
        }
              
    })

    .catch(function(){
        $('courseEditLoader').addClass('d-none');
        $('courseEditWrong').removeClass('d-none');
    
    });
    
    }


    //Courses edit modal save btn

    $('#CourseUpdateConfirmBtn').click(function(){

       var courseId=$('#courseEditId').html();
       var courseName= $('#CourseNameUpId').val();
       var courseDes= $('#CourseDesUpId').val();
       var courseFee= $('#CourseFeeUpId').val();
       var courseEnroll= $('#CourseEnrollUpId').val();
       var courseClass= $('#CourseClassUpId').val();
       var courseLink= $('#CourseLinkUpId').val();
       var  CourseImg= $('#CourseImgUpId').val();

        courseUpdate(courseId,courseName,courseDes,courseFee,courseEnroll,courseClass,courseLink,CourseImg);

    });

    // Course Update  
    function courseUpdate(courseId,courseName,courseDes,courseFee,courseEnroll,courseClass,courseLink,CourseImg){

    axios.post('/coursesUpdate',
    
    {  
        id:courseId,
        course_name:courseName,
        course_des:courseDes,
        course_fee:courseFee,
        course_totalenroll:courseEnroll,
        course_totalclass:courseClass,
        course_link:courseLink,
        course_img:CourseImg
    })
    
    .then(function(response){
    
        if(response.data==1){
            $('#updateCourseModal').modal('hide');
            getCourseData();
            
    
        }else{
            $('#updateCourseModal').modal('hide');
            getCourseData();
            
        }
              
    })
    .catch(function(){
     
    
    });
    }



    </script>
@endpush


