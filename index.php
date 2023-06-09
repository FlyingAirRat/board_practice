<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 d-flex justify-content-end"><button id="main_write" class="btn btn-primary m-2">게시글작성</button></div>
        </div>
        <div id="contents_list" class="container border border-1 bg-white p-2 m-0 text-center">
            <div id="contents_list_header">
                <div class="row">
                    <div class="col-1">글번호</div>
                    <div class="col-5">제목</div>
                    <div class="col-2">작성자</div>
                    <div class="col-4">작성일자</div>
                </div> 
            </div>
            <div id="contents_list_body" class="p-3">

            </div>
            
        </div>
    </div>
    <div id="footer" class="container border border-1 mb-2 bg-secondary">
        
    </div>
    <script type="text/javascript">
        $(function(){
            var i = 0;
            var str = '';
            $(window).on('load', function(){
                $.ajax({
                    url:'../process/get_list.php',
                    type:'POST',
                    dataType:'json',
                    data:'',
                    success:function(fetch){
                        if(!fetch.exec){
                            alert('문제발생');
                            return false;
                        }
                        console.log(fetch);

                        fetch.data.forEach(function(row, post_idx){
                            str+=`<div class="row" data-post-idx="`+row.post_idx+`">
                                <div class="col-1">`+row.post_idx+`</div>
                                <div class="col-5 text-start">`+row.title+`</div>
                                <div class="col-2">`+row.contents+`</div>
                                <div class="col-4">`+row.inpt_dttm+`</div>
                            </div>`;
                        });      
                        $('#contents_list_body').html(str);
                    }
                })
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

            $('#contents_list_body').on('click', '.row', function(ev){
                let redirect = "/view_contents.php?post_idx="+$(this).data().postIdx;
                console.log(redirect);
                // similar behavior as clicking on a link
                window.location = redirect;
                return false;
            })

            
            

            $('#main_write').on('click', function(){
                location.href='write.php';
                return false;
            });
        });
        
    </script>
</body>
</html>