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
        $.ajax({
            type: "get",
            url: `admin/product/${id}/edit`,
            dataType: "json",
            success: function (data) {
                $('.name').val(data.product.name);
                $('.quantity').val(data.product.quantity);
                $('.price').val(data.product.price);
                $('.promotional').val(data.product.promotional);
                $('.imageThum').attr('src',`img/upload/product/${data.product.image}`);
                $('.status').val(data.product.status)
                CKEDITOR.instances['demo'].setData(data.product.description)
                let html = '';
                $.each(data.category,function(key,value){
                    let id = value['id'];
                    let name = value['name'];
                    if(data.product.idCategory == value['id']){             
                        html += `<option selected value = ${id}>${name}</option>`
                    }
                    else{
                        html += `<option value = ${id}>${name}</option>`
                    }
                })
                $('.category').html(html)
                html = '';
                $.each(data.productType,function(key,value){
                    let id = value['id'];
                    let name = value['name'];
                    if(data.product.idProductType == value['id']){    
                        html += `<option selected value = ${id}>${name}</option>`
                    }
                    else{
                        html += `<option value = ${id}>${name}</option>`
                    }
                })
                $('.product-type').html(html)
            }
        });    
    })

    $('#updateProduct').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: `admin/updateProduct/${id}`,
            contentType: false,
            processData: false,
            cache: false,
            data: new FormData(this),
            success: function (data) {
                console.log(data)
                if(data.error == true){
                }
                else{
                    toastr.success(data.result,'Thông báo', {timeOut: 5000})
                    $('#edit').modal('hide')
                    location.reload()
                }
            }
        });
    })
    
    //Delete producttype
    $('.delete').click(function(){
        id = $(this).data('id')
        trSelected = $(this).closest('tr')
    })
    $('.del').click(function(){
        $.ajax({
            url: `admin/product/${id}`,
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


    