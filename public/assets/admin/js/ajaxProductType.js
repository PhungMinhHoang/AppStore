$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    let id, tdName, tdStatus, tdSlug,tdCategory, trSelected
    
    $('.edit').click(function(){
        $('.error').hide()
        id = $(this).data('id')
        tdName = $(this).closest('tr').find('.td-name')
        tdStatus = $(this).closest('tr').find('.td-status')
        tdSlug = $(this).closest('tr').find('.td-slug')
        tdCategory = $(this).closest('tr').find('.td-category')
        // set data for modal
        $('.name').val(tdName.text());
        $('.title').text(tdName.text());
        $('.status').val(tdStatus.data('status'))
        $('.category').val(tdCategory.data('category'))
    })
    $('.update').click(function(e){
        let name = $('.name').val(),
        status = $('.status').val(),
        idCategory = $('.category').val()
        $.ajax({
            url: `admin/product_type/${id}`,
            data: {
                name: name,
                status: status,
                idCategory: idCategory
            },
            type:'put',
            dataType: 'json',
        })
        .done(function(result){
            console.log(result)
            if(result.error)
            {
                $('.error').show();
                $('.error').html(result.message.name[0]);
            }
            else
            {
                toastr.success(result.message,'Thông báo', {timeOut: 5000})
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
                tdCategory.text(result.data.category.name)
            }
        })
    })
    
    //Delete producttype
    $('.delete').click(function(){
        id = $(this).data('id')
        trSelected = $(this).closest('tr')
    })
    $('.del').click(function(){
        $.ajax({
            url: `admin/product_type/${id}`,
            dataType: 'json',
            type: 'delete',
            success: function(result){
                toastr.success(result.success,'Thông báo', {timeOut: 5000})
                $('#delete').modal('hide')
                trSelected.remove()
            }
        })
    })
    
})


    