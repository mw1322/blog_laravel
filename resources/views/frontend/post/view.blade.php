@extends('layouts.app')
@section('title',"$post->meta_title")
@section('meta_description',"$post->meta_description")
@section('meta_keyword',"$post->meta_keyword")
@section('content')

<div class="py-4">
    <div class="container">
        <div  class="row">
            <div  class="col-md-9">

                <div class="category-heading ">
                    <h4>{!! $post->name !!}</h4>
                </div>

                <div class="card card-shadow mt-4">
                    <div class="card-body post-description">
                        {!! $post->description !!}
                    </div>
                </div>
                <div class="comment-area mt-4">
                    @if (session('message'))
                    <h6 id="alertMessage" class="alert alert-warning">
                        {{session('message')}}
                    </h6>
                    <script>
                     // Automatically hide the alert after 10 seconds
                     setTimeout(function() {
                         document.getElementById('alertMessage').style.display = 'none'
                     }, 3000); // 10000 milliseconds = 10 seconds
                 </script>

                    @endif
                    <div class="card card-body">
                        <h6 class="card-title">Leave the Comment</h6>
                        <form action="{{url('comments')}}" method="post">
                            @csrf
                            <input type="hidden" name="post_slug" value="{{$post->slug}}">
                            <textarea name="comment_body" id="" cols="30" rows="3" class="form-control"></textarea>
                            <button class="btn btn-primary mt-3" type="submit">Submit</button>
                        </form>
                    </div>
                     @forelse($post->comments as $comment)
                    <div class="comment-container card card-body shadow-sm mt-3">

                        <div class="detail-area">
                            <h6 class="user-name mb-1">
                                @if ($comment->user)
                                    {!! $comment->user->name !!}
                                @endif
                                <small class="ms-3 text-primary">{!! $comment->user->created_at->format('d-m-Y') !!}</small>
                            </h6>
                            <p class="user-comment mb-1">
                                {!! $comment->comment_body !!}
                            </p>
                        </div>
                        @if(Auth::check() && Auth::id() == $comment->user_id)
                        <div style="margin-top: 2px;">
                            <button type="button" value="{{$comment->id}}" class="editComment btn btn-primary btn-sm me-2">Edit</button>
                            <button type="button" value="{{$comment->id}}" class="deleteComment btn btn-danger btn-sm me-2">Delete</button>
                        </div>
                        @endif
                    </div>
                        @empty
                    <div class="card card-body shadow-sm mt-3">
                        <h6>No Comments Yet</h6>
                    </div>
                    </div>
                     @endforelse
                </div>
                </div>
                <div  class="col-md-3">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Latest Posts</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($latest_posts as $latest_post_item)
                            <a href="{{url('blog/'.$latest_post_item->category->slug.'/'.$latest_post_item->slug)}}" class="text-decoration-none">
                                <h6 >
                                    > {{$latest_post_item->name}}
                                </h6>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $(document).ready(function () {
            $(document).on('click','.deleteComment', function () {
                event.preventDefault();
                // alert("Nice");.
                if(confirm("Are You Really Want To Delete Comment : ")){
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();
                    $.ajax({
                        type: "POST",
                        url: "/delete-comment",
                        data: {
                            'comment_id' : comment_id,
                        },
                        success: function (response) {
                            if(response.status == 200){
                                thisClicked.closest(".comment-container").remove();
                                alert(response.message);
                            }
                            else {
                                alert(response.message);
                            }
                        }

                    });
                }
            });
                $(document).on('click', '.editComment', function () {
                var thisClicked = $(this);
                var comment_id = thisClicked.val();
                var comment_container = thisClicked.closest('.comment-container');
                var userComment = comment_container.find(".user-comment");
                var editComment = comment_container.find(".editComment");

                userComment.replaceWith('<input type="text" class="form-control updated-comment" value="' + userComment.text().trim() + '">');
                editComment.replaceWith('<button type="button" class="submitButton btn btn-primary btn-sm me-2" data-comment-id="' + comment_id + '">Submit</button>');
            });

            // Event delegation for .submitButton outside the .editComment click event
            $(document).on('click', '.submitButton', function () {
                var comment_container = $(this).closest('.comment-container');
                var comment_id = $(this).data('comment-id');
                var comment_body = comment_container.find(".updated-comment").val();
                var updatedComment = comment_container.find(".updated-comment");
                var submitButton = comment_container.find(".submitButton");

                console.log(comment_body);
                $.ajax({
                    type: "PUT",
                    url: "/edit-comment",
                    data: {
                        'comment_id': comment_id,
                        'comment_body': comment_body,
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            updatedComment.replaceWith('<p class="user-comment mb-1">'+ response.commentBody + '</p>');
                            submitButton.replaceWith('<button type="button" value="{{$comment->id}}" class="editComment btn btn-primary btn-sm me-2">Edit</button>');
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
          });


    </script>
@endsection
