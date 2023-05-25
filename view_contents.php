<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <!-- JavaScript Bundle with Popper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Document</title>
    <style>
        * { 
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body, #contents{
            min-height: 100vh;
        }
        #footer{
            min-height: 5vh;
        }
    </style>
</head>
<body>
    <div class="header text-center py-5">
        <h1>SIMPLE BOARD</h1>
    </div>
    <div id="navbar" class="container border border-1 text-center p-3 bg-light">
        <div class="row bg-white">
            <div class="col border border-1 m-1 p-0 bg-secondary">메인</div>
            <div class="col border border-1 m-1 p-0 bg-secondary">소식</div>
            <div class="col border border-1 m-1 p-0 bg-secondary">게시판</div>
            <form class="col m-0 pe-0">
                <div class="row">
                    <div class="col-9 p-0">
                        <input type="text" id="search_params" class="h-100 w-100 ms-1" maxlength="30" placeholder="글제목검색">
                    </div>
                    <div class="col-3 p-0">
                        <button type="submit" class="m-0 btn btn-primary">검색</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="contents" class="container border border-1 my-2 bg-light">
        <div class="row w-100">
            <div class="col my-1">
                <div id="contents_wrap" class="container border border-1 bg-white p-0 m-0">
                    <div class="row w-100">
                        <div class="col-1 text-center">글제목</div>
                        <div id="view_title" class="col-11 p-0 my-1 bg-light"></div>
                    </div>
                    <div class="row h-auto w-100">
                        <div class="col-1 text-center">내용</div>
                        <div id="view_contents" class="col-11 p-0 h-auto bg-light"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100">
            <div class="col">
                <div id="comment_wrap" class="container d-inline border border-1 bg-white p-2 my-2">
                    <div class="row w-100">
                        <div class="col">댓글작성</div>
                    </div>
                    <form id="comment_write" class="row w-100 border border-1 bg-light" method="POST" action="/../process/comment_write_process.php">
                        <input type="hidden" name="post_idx" value="<?=$_GET['post_idx']?>">
                        <input type="hidden" name="depth_level" value="">
                        <input type="hidden" name="depth_order" value="1">
                        <input type="hidden" name="comment_order" value="">
                        <input type="hidden" name="comment_ref" value="">
                        <div class="row w-100">
                            <div class="col-1 text-center">작성자</div>
                            <div class="col-4 p-0 my-1">
                                <input type="text" name="comment_writer" id="comment_writer" class="w-100">
                            </div>
                            <div class="col"></div>
                            <div class="col-1 text-center">
                                <button id="comment_submit" type="submit" class="m-0 btn btn-primary">등록</button>
                            </div>
                        </div>
                        <div class="row w-100">
                            <div class="col-1 text-center">댓글내용</div>
                            <div class="col p-0 my-1">
                                <textarea name="contents" id="comment_contents" rows="3" class="w-100 h-100"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="row w-100">
                            <div class="col">댓글목록</div>
                        </div>
                    <div id="comment_list" class="border border-1 bg-light p-2 my-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer" class="container border border-1 mb-2 bg-secondary">
        
    </div>
    <script type="text/javascript">
        $(function(){

            
            var i = 0;
            var str = '';
            const urlParams = new URL(location.href).searchParams;
            const post_idx = urlParams.get('post_idx');
            $(window).on('load', function(){
                $.ajax({
                    url:'../process/get_contents.php?post_idx='+post_idx,
                    type:'GET',
                    dataType:'json',
                    data:'',
                    success:function(fetch){
                        if(!fetch.exec){
                            alert('문제발생');
                            return false;
                        }
                        console.log(fetch)
                        $('#view_title').text(fetch.post_contents.data[0].title);
                        $('#view_contents').text(fetch.post_contents.data[0].contents);
                        fetch.comments.data.forEach(element => {
                            // let i = 0;
                            // for(i = 0; i < element.depth; i++){
                                
                            // }
                            let str = `<div class="comment" style="margin-left:`+element.depth_level*20+`px;" data-depth-level="`+element.depth_level+`" data-depth-order="`+element.depth_order+`" data-comment-order="`+element.comment_order+`" data-comment-ref="`+element.comment_ref+`">
                            <div class="row w-100">
                                <div class="col-2 text-end" style="width:100px;">작성자</div>
                                <div class="col-auto p-0 comment_writer">`+element.writer+`</div>
                            </div>
                            <div class="row w-100 h-auto">
                                <div class="col-2 text-end" style="width:100px;">내용</div>
                                <div class="col-auto comment_contents p-0 h-auto flex-grow-1">`+element.contents+`</div>
                                <div class="col-2 justify-content-end d-flex" style="width:100px;"><button class="btn btn-primary addreple">추가</button></div>
                            </div>
                        </div>`;
                            $('#comment_list').append(str);
                        });
                    }
                })
            })
            
            $(document).on('click', '.addreple', function(){
                $(this).parents('.comment').append(`<form id="reple_write" class="row w-100 border border-1 bg-light" method="POST" action="/../process/comment_write_process.php" style="margin-left:`+$(this).parents('.comment').data('depth-level')*20+`px;">
                        <input type="hidden" name="depth_level" value="`+$(this).parents('.comment').data('depth-level')+`">
                        <input type="hidden" name="post_idx" value="<?=$_GET['post_idx']?>">
                        <input type="hidden" name="depth_order" value="`+$(this).parents('.comment').data('depth-order')+`">
                        <input type="hidden" name="comment_order" value="`+$(this).parents('.comment').data('comment-order')+`">
                        <input type="hidden" name="comment_ref" value="`+$(this).parents('.comment').data('comment-ref')+`">
                        <div class="row w-100">
                            <div class="col-1 text-center">작성자</div>
                            <div class="col-4 p-0 my-1">
                                <input type="text" name="comment_writer" id="reple_writer" class="w-100">
                            </div>
                            <div class="col"></div>
                            <div class="col-1 text-center">
                                <button id="reple_submit" type="submit" class="m-0 btn btn-primary">등록</button>
                            </div>
                        </div>
                        <div class="row w-100">
                            <div class="col-1 text-center">댓글내용</div>
                            <div class="col p-0 my-1">
                                <textarea name="contents" id="reple_contents" rows="3" class="w-100 h-100"></textarea>
                            </div>
                        </div>
                    </form>`);
            })

            $('#contents_list_body').on('mouseenter', '.row',
            function(ev){
                $(this).css('cursor','pointer');
                $(this).addClass('bg-secondary');
            });
            $('#contents_list_body').on('mouseleave', '.row', 
            function(ev){
                $(this).removeClass('bg-secondary');
            });

            // $('#comment_submit').click(function(){
            //     console.log($('#form_write').serializeObject());
            //     $.ajax({
            //         url:'../process/comment_write_process.php',
            //         type:'POST',
            //         dataType:'json',
            //         data:$('#form_comment').serializeObject(),
            //         success:function(data){
            //             if(!data.exec){
            //                 alert('문제발생');
            //                 return false;
            //             }

            //             alert('성공적으로 처리.');

            //         },
            //     })
            // })

            
            

            $('#main_write').on('click', function(){
                location.href='write.php';
                return false;
            });
        });
        
    </script>
</body>
</html>