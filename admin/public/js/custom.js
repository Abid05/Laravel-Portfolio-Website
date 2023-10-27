//For sercvices table
function getProjectData(){


    axios.get('/getprojectsData')
    
    .then(function (response) {
    
        if(response.status==200){
    
            $('#mainDivProject').removeClass('d-none');
            $('#loaderDivProject').addClass('d-none');
    
            var jsonData=response.data;
    
            $('#ProjectDataTable').DataTable().destroy();
            $('#project_Table').empty();
    
            $.each(jsonData, function(i) {
            $('<tr>').html(
    
                "<td>"+jsonData[i].project_name+"</td>" +
                "<td>"+jsonData[i].project_des+"</td>" + 
                "<td><a class='projectEditBtn' data-id= " + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                "<td><a class='projectDeleteBtn'  data-id= " + jsonData[i].id + "> <i class='fas fa-trash-alt'></i></a></td>"
    
         
            ).appendTo('#project_Table');
    
            });
    
    
            //courses table delete icon click
            $('.projectDeleteBtn').click(function(){
    
                var id =  $(this).data('id');
    
                $('#projectDeleteId').html(id);
                $('#deleteProjectModal').modal('show');
    
            })
    
            //Courses Delete modal Yes btn click    
            $('#projectId').click(function(){
    
                var id =  $('#projectDeleteId').html();
                projectDelete(id);
            
            });
    
            //courses table Update icon click
            $('.projectEditBtn').click(function(){
    
                var id =  $(this).data('id');
    
                $('#projectDeleteId').html(id);
                projectUpdateDetails(id);
                $('#ProjectEditId').html(id);
                $('#updateProjectModal').modal('show');
    
            })
    
            //service jquery data table
    
            $('#ProjectDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');
    
         
    
        }else{
    
        $('#loaderDivProject').addClass('d-none');
        $('#WrongDivProject').removeClass('d-none');
    
        }
    
    })
    
    .catch(function(){
    
        $('#loaderDivProject').addClass('d-none');
        $('#WrongDivProject').removeClass('d-none');
    
    
    });
    
    }
    
    // Add-course-methode
    
    $('#addNewBtnIdProject').click(function(){
        $('#addProjectModal').modal('show');
    })
    
    
    $('#ProjectAddConfirmBtn').click(function(){
    
        var p_name       = $('#ProjectNameId').val();
        var p_des        = $('#ProjectDesId').val();
        var p_link        = $('#ProjectlinkId').val();
        var p_img         = $('#ProjectImgId').val();
    
        projectAdd(p_name,p_des,p_link,p_img);
    })
    
    //Course add method
    function projectAdd(p_name,p_des,p_link,p_img){
    
    axios.post('/projectsAdd',
    
    {  
        project_name:p_name,
        project_des:p_des,
        project_link:p_link,
        project_img:p_img
    })
    
    .then(function(response){
    
        if(response.data==1){
            $('#addProjectModal').modal('hide');
            getProjectData();
            
    
        }else{
            $('#addProjectModal').modal('hide');
            getProjectData();
            
        }
              
    })
    .catch(function(){
     
        $('#addProjectModal').modal('hide');
    });
    }
    
    
    
    //Courses Delete 
    
    function projectDelete(deleteId){
    axios.post('/projectsDelete',{id:deleteId})
    
    .then(function(response){
    
        if(response.data==1){
            $('#deleteProjectModal').modal('hide');
            getProjectData();
    
        }else{
            $('#deleteProjectModal').modal('hide');
            getProjectData();
            
        }
        
    })
    .catch(function(){
    
        $('#deleteProjectModal').modal('hide');
        getProjectData();
            
    });
    }
    
    
    
    //Each Courses Update Details 
    function projectUpdateDetails(detailsId){
    
    axios.post('/projectsDetails',{id:detailsId})
    
    .then(function(response){
    
        if(response.status==200){
    
            $('#ProjectEditForm').removeClass('d-none');
            $('#projectEditLoader').addClass('d-none');
    
            var jsonData=response.data;
            $('#ProjectNameUpId').val(jsonData[0].project_name);
            $('#ProjectDesUpId').val(jsonData[0].project_des);
            $('#ProjectlinkUpId').val(jsonData[0].project_link);
            $('#ProjectImgUpId').val(jsonData[0].project_img);
        }else{
    
            $('#projectEditLoader').addClass('d-none');
            $('#projectEditWrong').removeClass('d-none');
    
        }
              
    })
    
    .catch(function(){
        $('projectEditLoader').addClass('d-none');
        $('projectEditWrong').removeClass('d-none');
    
    });
    
    }
    
    
    //Courses edit modal save btn
    
    $('#projectUpdateConfirmBtn').click(function(){
    
       var courseId=$('#ProjectEditId').html();
       var courseName= $('#ProjectNameUpId').val();
       var courseDes= $('#ProjectDesUpId').val();
       var courseLink= $('#ProjectlinkUpId').val();
       var courseImg= $('#ProjectImgUpId').val();
    
    
        projectUpdate(courseId,courseName,courseDes,courseLink,courseImg);
    
    });
    
    // Course Update  
    function projectUpdate(courseId,courseName,courseDes,courseLink,courseImg){
    
    axios.post('/projectsUpdate',
    
    {  
        id:courseId,
        project_name:courseName,
        project_des:courseDes,
        project_link:courseLink,
        project_img:courseImg,
    })
    
    .then(function(response){
    
        if(response.data==1){
            $('#updateProjectModal').modal('hide');
            getProjectData();
            
    
        }else{
            $('#updateProjectModal').modal('hide');
            getProjectData();
            
        }
              
    })
    .catch(function(){
     
    
    });
    }
    
    