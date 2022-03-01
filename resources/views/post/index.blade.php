@extends('layout.master')
@section('title')
    Post
    @endsection

@section('content')
    <div class="row ">
        <div class="col-md-4 tickets">
            <div class="row zmargin">
                <h4 class="mh4">
                    Useful Links:
                </h4>
                <div class="col-md-12 openticket">
                    <div class="row" style="margin-top: 16px;">
                        <div class="col-md-9 col-xs-8 activeticket" style="margin-top: 2px;">
                           Create A Post
                        </div>
                        <div class="col-md-3 col-xs-4">
                            <a href="{{route('post.create')}}" class="btn btnopenticket">Create</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 ">
            <div class="row myprofileeddit">
                <div class="col-md-12 ticketdesc zpadding">
                    <div class="container-fluid zpadding" style="margin-top: 21px; ">
                        <h4 class="messagesh4">
                            It has survived not only five centuries?
                        </h4>
                        <p class="messagesp">Investor Spotlight</p>
                        <hr style="width: 100%;">
                    </div>
                    <div class="col-md-12 umessage" style="padding: 25px;">
                        <div class="row zmargin ">
                            <div class="usermessage">
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type?
                                </p>
                            </div>

                        </div>
                        <div class="row zmargin" style="padding-top: 5px;">
                            <div class="col-md-8 zpadding">

                            </div>
                            <div class="col-md-4 zpadding" style="text-align: right;">
                                <p>Post Created By John Doue • April 2022</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="cm">
                    </div>
                    <br><br>
                    <div class="col-md-12" style="height: 110px;position: absolute;bottom: 0;border-top: 1px solid #EBEBEB;">
                        <form>
                            <div class="row zmargin">
                                <input type="hidden" value="{{$post->id}}" id="postid">
                                <div class="col-md-9">
                                    <select id="username" class="input fullwidth">
                                        <option value="-1" disabled selected>Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="fullname " id="Messages" class="input fullwidth " placeholder="Type your Comment" style="margin-top: 12px;height: 90px;resize: none;"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <input type="button " name="submit " id="comment" class="btn-danger fullwidth Messagessubmit" style="font-size: 13px;" value="Send Your Comment ">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection
@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#comment').click(function () {
        let Messages = $('#Messages').val();
        let username = $('#username').val();
        let postid = $('#postid').val();
        if (username == null) {
            Swal.fire({
                icon: 'error',
                title: '',
                text: 'Please Select a User'
            });
            return false;
        }
        if (Messages == "") {
            Swal.fire({
                icon: 'error',
                title: '',
                text: 'Please Type Your Comment'
            });
            return false;
        }
        $.ajax({
            url:"{{ route('post.store') }}",
            type:'POST',
            dataType: 'json',
            data: {
                'id':username,
                'comment':Messages,
                'postid':postid,
                _token: "{{ csrf_token() }}"
            },
            beforeSend:function () {
                $('#comment').prop('disabled',true);
            },
            complete:function(){
                $('#comment').prop('disabled',false);
            },
            success:function (data) {
                var string1 = JSON.stringify(data);
                var parsed = JSON.parse(string1);
                if(parsed.data.error==false){
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        text: parsed.data.message
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '',
                        text: parsed.data.message
                    })
                }
                $.ajax({
                    url:"{{ route('comment') }}",
                    type:'POST',
                    dataType: 'json',
                    data: {
                        'postid':postid,
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend:function () {
                    },
                    complete:function(){
                    },
                    success:function (data) {
                        let htm="";
                        $.each(data.data.comments,function (key,value) {
                            htm+='<div class="col-md-12 omessage" style="padding: 25px;padding-top: 0;">\n' +
                                '                        <div class="row zmargin ">\n' +
                                '                            <div class="operatormessage">\n' +
                                '                                <p>\n' + value.reply +
                                '                            </div>\n' +
                                '\n' +
                                '                        </div>\n' +
                                '                        <div class="row zmargin" style="padding-top: 5px;">\n' +
                                '                            <div class="col-md-4 zpadding">\n' +
                                '                                <p>'+value.name+' '+value.date+'</p>\n' +
                                '                            </div>\n' +
                                '                            <div class="col-md-8 zpadding">\n' +
                                '\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>'
                        });

                        $('#cm').html(htm);
                    }
                });
            }
        });
    })

</script>
    @endpush
