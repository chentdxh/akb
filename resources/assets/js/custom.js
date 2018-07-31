




export const show_delete_dialog = function (url,data) {

    swal({
        title: '确定删除？',
        text: "删除后不可恢复",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText:"取消",
        confirmButtonText: '确认'
    }).then((result) => {
        if (result.value) {

            $.ajax({
                url:url,
                data:data,
                type:"post",
                success:function (response) {

                    if (response.code == 0)
                    {
                        swal({type:"success",title:"删除成功!" }).then((result) => {

                            window.location.reload();
                        });
                    }else
                    {
                        swal({type:"error",title:"删除失败!" })
                    }
                },
                error:function (response) {

                    swal({type:"error",title:"删除失败!" })
                }
            });

        }
    })
}



