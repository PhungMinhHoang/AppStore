$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    var id;
    $('.edit').click(function(){
        $('.error').hide();
        id = $(this).data('id');
        $.ajax({
            url: `admin/category/${id}/edit`,
            dataType: 'json',
            type: 'get',
            success: function(result){
                console.log(result)
                $('.name').val(result.name);
                $('.title').text(result.name);
                if(result.status == 1)
                {   
                    $('.kht').removeAttr('selected')
                    $('.ht').attr('selected','selected') 
                }
                else
                {   
                    $('.ht').removeAttr('selected')
                    $('.kht').attr('selected','selected')
                    
                }
            }
        })
    })
    SaveClick(id)
})

function SaveClick(id){
    console.log(id)
    $('.update').click(function(){
        let i = 1;
        let name = $('.name').val()
        let status = $('.status').val()
        
        $.ajax({
            url: `admin/category/${id}`,
            data: {
                name: name,
                status: status
            },
            type:'put',
            dataType: 'json',
            success: function(result){
                if(result.error)
                {
                    $('.error').show();
                    $('.error').html(result.message.name[0]);
                }
                else
                {
                    toastr.success(result.success,'Thông báo', {timeOut: 5000})
                    $('#edit').modal('hide')
                    location.reload()
                }
            }
        })
    })
    
}