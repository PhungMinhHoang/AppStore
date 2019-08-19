$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    let id, tdName, tdStatus, tdSlug, trSelected
    
    $('.edit').click(function(){
        $('.error').hide()
        id = $(this).data('id')
        tdName = $(this).closest('tr').find('.td-name')
        tdStatus = $(this).closest('tr').find('.td-status')
        tdSlug = $(this).closest('tr').find('.td-slug')
        // set data for modal
        $('.name').val(tdName.text());
        $('.title').text(tdName.text());
        if(tdStatus.data('status') == 1)
        {   
            $('.kht').removeAttr('selected')
            $('.ht').attr('selected','selected') 
        }
        else
        {   
            $('.ht').removeAttr('selected')
            $('.kht').attr('selected','selected')
            
        }
    })
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
                tdName.text(result.data.name)
                if(result.data.status === '1')
                {
                    tdStatus.text('Hiển thị')
                }
                else
                {
                    tdStatus.text('Không hiển thị')
                }
                tdSlug.text(result.data.slug)
            }
        })
    })
    
    //Delete Category
    $('.delete').click(function(){
        id = $(this).data('id')
        trSelected = $(this).closest('tr')
    })
    $('.del').click(function(){
        $.ajax({
            url: `admin/category/${id}`,
            dataType: 'json',
            type: 'delete',
            success: function(result){
            toastr.success(result.message,'Thông báo', {timeOut: 5000})
            $('#delete').modal('hide')
            trSelected.remove()
            },
            error: function(){
                console.log('error')
            }

        })
    })

    //Edit ProductType
})


    