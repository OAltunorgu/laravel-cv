@extends('layouts.admin')
@section('title')
    Portfolyo Resim Listesi
@endsection
@section('css')
<style>
    .table th img, .jsgrid .jsgrid-table th img, .table td img, .jsgrid .jsgrid-table td img {
        width: 100px;
        height: unset !important;
        border-radius: unset !important;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">Portfolyo Resim Listesi</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portfolyo Resim Listesi</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="javascript:void(0)"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-block">Yeni Portfolyo Resmi Ekle</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Resim</th>
                                <th>Sil</th>
                                <th>Öne Çıkart</th>
                                <th>Status</th>
                                <th>Eklenme Tarihi</th>
                                <th>Güncellenme Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $item)
                                <tr id="{{$item->id}}">
                                    <td>{{$item->id}}</td>
                                    <td>
                                            <img src="{{$item->image ? asset('storage/portfolyo/' . $item->image) : ''}}" width="100">
                                    </td>
                                    <td><a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-danger deletePortfolyo">Sil <i class="mdi mdi-delete-forever"></i></a></td>
                                    <td><a data-id="{{$item->id}}" href="javascript:void(0)" class="btn
                                            {{$item->featured ? 'btn-success feauturedImage' : 'btn-warning feautureImage'}} ">
                                            {{$item->featured ? 'Öne Çıkarılmış' : 'Öne Çıkart'}}
                                            <i class="mdi mdi-eye"></i></a></td>

                                    <td>
                                        @if ($item->status)
                                            <a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-success changeStatus">Aktif</a>
                                        @else
                                            <a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-danger changeStatus">Pasif</a>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format("d-m-Y H:i:s") }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->format("d-m-Y H:i:s") }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yeni Resim Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="POST" id="newImageForm" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="images[]" id="images" multiple>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" id="saveImage" class="btn btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $('#images').change(function (){
            let images = $(this);
            let imageCheckStatus = imageCheck(images);

        });

        function imageCheck(images) {
            let length = images[0].files.length;
            let files = images[0].files;
            let checkImage = ['png', 'jpg', 'jpeg'];

            for (let i = 0; i < length; i++) {
                let type = files[i].type.split('/').pop();
                let size = files[i].size;
                if ($.inArray(type, checkImage) == '-1') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Uyarı!',
                        text: "Seçilen " + files[i].name + "'ine sahip resim belirlenen formatlarda değildir. .png, .jpg, .jpeg formatlarından birisi olmalıdır.",
                        confirmButtonText: "Tamam"
                    });
                    return false;
                }
                if (size > 2048000) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Uyarı!',
                        text: "Seçilen " + files[i].name + "'i resmi 2MB'tan fazla olamaz.",
                        confirmButtonText: "Tamam"
                    });
                    return false;
                }
            }
            return true;
        }

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr("content")
            }
        });

        $('#saveImage').click(function (){

            let imageCheckStatus = imageCheck($('#images'));

            if(!imageCheckStatus){
                Swal.fire({
                    icon: 'error',
                    title: 'Uyarı!',
                    text: "Seçilen resimleri kontrol ediniz.",
                    confirmButtonText: "Tamam"
                });
            }
            else{
                $('#newImageForm').submit();
            }
        });


        $('.changeStatus').click(function (){
            let portfolyoID = $(this).attr('data-id');
            let self = $(this);
            let route ='{{route('portfolyo.changeStatusImage', ['id' => 'featureImage' ])}}';
            let finalRoute = route.replace('featureImage', portfolyoID)
            $.ajax({
                url: finalRoute,
                type : "POST",
                async: false,
                data : {
                    portfolyoID: portfolyoID
                },
                success: function (response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: response.id + " ID'li kayıt durumu " + response.newStatus + " olarak güncellenmeiştir.",
                        confirmButtonText:"Tamam"
                    });
                    if(response.status == 1){
                        self[0].innerHTML="Aktif";
                        self.removeClass("btn-danger");
                        self.addClass("btn-success");
                    }else if (response.status == 0){
                        self[0].innerHTML="Pasif";
                        self.removeClass("btn-success");
                        self.addClass("btn-danger");
                    }
                },
                error: function (){

                }
            });
            /*           }).done(function (){

                       }).fail(function (){

                       });*/
        });

        $('.deletePortfolyo').click(function () {

            let portfolyoID = $(this).attr('data-id');

            Swal.fire({
                title: 'Emin misiniz?',
                text: portfolyoID + " ID'li portfolyo resmini silmek istediğinize emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    let route ='{{route('portfolyo.deleteImage', ['id' => 'deletePortfolyo' ])}}';
                    let finalRoute = route.replace('deletePortfolyo', portfolyoID)
                    $.ajax({
                        url: finalRoute,
                        type : "POST",
                        async: false,
                        data : {
                            '_method' : 'DELETE'
                        },
                        success: function (response){
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: "Silme işlemi başarılı.",
                                confirmButtonText:"Tamam"
                            });
                            $("tr#"+portfolyoID).remove();
                        },
                        error: function (){

                        }
                    });
                }
            })
        });

        $(document).on('click', '.feautureImage', function (){

            let feautureImageID = $(this).attr('data-id');
            let self = $(this);

            Swal.fire({
                title: 'Emin misiniz?',
                text: feautureImageID + " ID'li portfolyo resmini öne çıkarmak istediğinize emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    let route ='{{route('portfolyo.featureImage', ['id' => 'featureImage' ])}}';
                    let finalRoute = route.replace('featureImage', feautureImageID)
                    $.ajax({
                        url: finalRoute,
                        type : "POST",
                        async: false,
                        data : {
                            '_method' : 'PUT'
                        },
                        success: function (response){
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: "Öne Çıkarma işlemi başarılı.",
                                confirmButtonText:"Tamam"
                            });

                            $('.feauturedImage').removeClass('btn-success');
                            $('.feauturedImage').addClass('btn-warning');
                            $('.feauturedImage').html('Öne Çıkart');
                            $('.feauturedImage').addClass('feautureImage');
                            $('.feauturedImage').removeClass('feauturedImage');

                            self.removeClass('btn-warning');
                            self.addClass('btn-success');
                            self.removeClass('feautureImage');
                            self.addClass('feauturedImage');
                            self.html('Öne Çıkarılmış');
                        },
                        error: function (){

                        }
                    });
                }
            })
        });

    </script>

@endsection

