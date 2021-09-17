@extends('layouts.admin')
@section('title')
    Becerileriniz
@endsection
@section('css')

@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">Becerileriniz</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Becerileriniz</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{route('admin.skills.add')}}" class="btn btn-primary btn-block">Yeni Hesap Ekle</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Düzenle</th>
                                <th>Sil</th>
                                <th>Beceri Adı</th>
                                <th>Detay</th>
                                <th>İcon</th>
                                <th>Status</th>
                                <th>Eklenme Tarihi</th>
                                <th>Güncellenme Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr id="{{$item->id}}">
                                    <td>{{$item->id}}</td>
                                    <td><a href="{{route('admin.skills.add', ['skillsID' => $item->id])}}" class="btn btn-warning editEducation">Düzenle<i class="mdi mdi-pencil-box-outline"></i></a></td>
                                    <td><a data-id="{{$item->id}}" href="javascript:void(0)" class="btn btn-danger deleteSkills">Sil<i class="mdi mdi-delete-forever"></i></a></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->detail}}</td>
                                    <td>{{$item->icon}}</td>
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
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr("content")
            }
        });

        $('.changeStatus').click(function (){
            let skillsID = $(this).attr('data-id');
            let self = $(this);
            $.ajax({
                url: "{{route('admin.skills.changeStatus')}}",
                type : "POST",
                async: false,
                data : {
                    skillsID: skillsID
                },
                success: function (response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: response.skillsID + " ID'li kayıt durumu " + response.newStatus + " olarak güncellenmeiştir.",
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
        });


        $('.deleteSkills').click(function () {

            let skillsID = $(this).attr('data-id');

            Swal.fire({
                title: 'Emin misiniz?',
                text: skillsID + " ID'li beceriyi silmek istediğinize emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{route('admin.skills.delete')}}",
                        type : "POST",
                        async: false,
                        data : {
                            skillsID: skillsID
                        },
                        success: function (response){
                            Swal.fire({
                                icon: 'success',
                                title: 'Başarılı!',
                                text: "Silme işlemi başarılı.",
                                confirmButtonText:"Tamam"
                            });
                            $("tr#"+skillsID).remove();
                        },
                        error: function (){

                        }
                    });
                }
            })
        });
    </script>
@endsection

