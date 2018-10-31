

if (WebUploader != undefined)
{

    window.create_uploader = function (type) {

        var btnId = "#" + type + "Btn";

        var barId = "#" + type + "Bar";
        var progressId = "#" + type + "Progress";
        var self = this;

        this.uploader = WebUploader.create({

            auto: true,
            // 文件接收服务端。
            server: '/data/file/upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {id: btnId, multiple: false},

            formData: {"file_type": type},

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            accept: {
                title: 'Images',
                extensions: '*',
                mimeTypes: '*/*'
            }
        });
        this.uploader.on("fileQueued", function (file) {
            $(progressId).css('width', '0%').attr('aria-valuenow', 0);
            $(barId).show();
        })
        this.uploader.on("uploadProgress", function (file, percentage) {

            console.log("percentage is " + percentage)
            var value = percentage * 100;

            $(progressId).css('width', value + '%').attr('aria-valuenow', value);
        });

        this.uploader.on('uploadSuccess', function (file, res) {

            if (res.code == 0) {


                swal("上传成功!", "", "success").then((value) => {
                    window.location.reload();
                });
            }else
            {
                swal("上传失败!", res.msg, "error").then((value) => {

                });
            }

        });

        this.uploader.on( 'uploadError', function( file ) {
            console.log(file);
            swal("上传失败!", "", "error").then((value) => {

            });
        });
        this.uploader.on('uploadComplete', function (file) {
            console.log(file);
            $(barId).hide();
            $(progressId).css('width', '0%').attr('aria-valuenow', 0);
            self.uploader.reset();

        });

        return this.uploader;
    }
}
