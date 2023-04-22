<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JavaScript Bundle with Popper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
            <form id="form_search" name="search" method="post" action="searchtitle.php" class="col m-0 pe-0">
                <div class="row">
                    <div class="col-9 p-0">
                        <input type="text" id="search_params" name="search_title" class="h-100 w-100 ms-1" maxlength="30" placeholder="글제목검색">
                    </div>
                    <div class="col-3 p-0">
                        <button id="search_submit" type="submit" class="m-0 btn btn-primary">검색</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div id="contents" class="container border border-1 my-2 bg-light">
        <form id="form_write" method="post" action="write_process.php">
            <div class="row">
                <div class="col-1 text-center">글제목</div>
                <div class="col-10 p-0 my-1">
                    <input type="text" name="title" id="write_title" class="w-100">
                </div>
                <div class="col-1 text-center">
                    <button id="write_submit" type="submit" class="m-0 btn btn-primary">등록</button>
                </div>
            </div>
            <div class="row h-auto">
                <div class="col text-center">내용</div>
                <div class="col-10 p-0 h-auto">
                    <textarea name="contents" id="write_contents" rows="50" class="w-100 h-100"></textarea>
                </div>
                <div class="col"></div>
            </div>
        </form>
    </div>
    <div id="footer" class="container border border-1 mb-2 bg-secondary">
        
    </div>
    <script type="text/javascript">

    </script>
</body>
</html>