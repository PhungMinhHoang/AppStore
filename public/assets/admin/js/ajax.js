$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function(){
    $('.edit').click(function(){
        $('.error').hide();
        let id = $(this).data('id');
        $.get(`admin/category/${id}/edit`)
        .done(function(result){
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
            SaveClick(id)
        })
    }) 
})

function SaveClick(id){
    $('.update').click(function(){
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
        })
        .done(function(result){
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
        })
    })
    
}