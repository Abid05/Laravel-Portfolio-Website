// Owl Carousel Start..................
$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});
// Owl Carousel End..................

//Contact Send

$('#contactSendBtnId').click(function(){

   var contactName = $('#contactNameId').val();
   var contactMobile = $('#contactMobileId').val();
   var contactEmail = $('#contactEmailId').val();
   var contactMgz = $('#contactMgzId').val();

   sendContact(contactName,contactMobile,contactEmail,contactMgz);
})

function sendContact(contact_name,contact_mobile,contact_email,contact_mgz){

    if(contact_name.length==0){
        $('#contactSendBtnId').html('Written Your Name!')
        setTimeout(function(){
            $('#contactSendBtnId').html('Send')
        },3000)
    }else if(contact_mobile==0){
        $('#contactSendBtnId').html('Written Your Mobile Number!')
        setTimeout(function(){
            $('#contactSendBtnId').html('Send')
        },3000)
    }else if(contact_email==0){
        $('#contactSendBtnId').html('Written Your Email!')
        setTimeout(function(){
            $('#contactSendBtnId').html('Send')
        },3000)
    }else if(contact_mgz==0){
        $('#contactSendBtnId').html('Written Your Message!')
        setTimeout(function(){
            $('#contactSendBtnId').html('Send')
        },3000)
    }else{

    }

    axios.post('/contactSend',{

        contact_name:contact_name,
        contact_mobile:contact_mobile,
        contact_email:contact_email,
        contact_mgz:contact_mgz

    })
    .then(function(response){

        

    })
    .catch(function(error){

    })
}