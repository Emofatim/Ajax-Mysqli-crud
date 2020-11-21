$(document).ready(function(){
    $('.submit-form').on('click',function(event){
        event.preventDefault();
        const data = {};
        document.querySelectorAll('input').foreach(element => {
           data[element.name] = element.value;
        });
        /*$.each($('#registration-form input'),function(index,element){
            data[$(this).attr('name')] = $(this).val;
        })*/
        $.ajax({
            data:data,
            url:'ajaxregistration.php',
            type:'POST',
            dataType: 'json',
            success:function(response){
                swal({
                    icon: reponcse.status,
                    text: response.message,
                }).then(()=>{
                    if(response.status == 'success'){
                        window.location.href = 'http://localhost/p2c4/final-assignment-mysql-and-ajax/login.php'
                    }
                })
            })
        })
    })
})