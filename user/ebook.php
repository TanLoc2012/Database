<?php
    require_once "../header.php";

    // handel fillter product

    // get filed of Books
    $sql = "SELECT DISTINCT(title)
            FROM field";
    $fields = executeResult($sql);

    $fillterField = $fillterAuthor = $fillterKeyword = $fillterYear = '1';
    //handle fillter Field
    if(isset($_GET["filed"]) && $_GET["author"]==1 && $_GET["keyword"]==1 && $_GET["year"]==1 ){
        $fillterField = $_GET["filed"];

        $sql = "SELECT *
                FROM field JOIN book ON field.isbn=book.isbn
                WHERE field.title LIKE '$fillterField'";

        $allBook = executeResult($sql);
    }

    // get author of Books
    $sql = "SELECT DISTINCT(written.phone_author),author.name 
            FROM written JOIN author ON written.phone_author=author.phone";
    $authors = executeResult($sql);

    //handle fillter Author
    if(isset($_GET["author"]) && $_GET["filed"]==1 && $_GET["keyword"]==1 && $_GET["year"]==1){
        $fillterAuthor = $_GET["author"];

        $sql = "SELECT *
                FROM book
                WHERE book.isbn IN (SELECT written.isbn
                FROM author JOIN written ON author.phone=written.phone_author
                WHERE author.name='$fillterAuthor')";

        $allBook = executeResult($sql);
    }

    // get keyword of Books
    $sql = "SELECT DISTINCT(title)
            FROM keyword";
    $keywords = executeResult($sql);

    //handle fillter Keyword
    if(isset($_GET["keyword"]) && $_GET["filed"]==1 && $_GET["author"]==1 && $_GET["year"]==1){
        $fillterKeyword = $_GET["keyword"];

        $sql = "SELECT * 
                FROM keyword,book 
                WHERE keyword.isbn=book.isbn AND keyword.title LIKE '$fillterKeyword'";

        $allBook = executeResult($sql);
    }

    // get year of Books
    $sql = "SELECT DISTINCT(year)
            FROM book ";
    $years = executeResult($sql);

    //handle fillter Year
    if(isset($_GET["year"]) && $_GET["filed"]==1 && $_GET["author"]==1 && $_GET["keyword"]==1){
        $fillterYear = $_GET["year"];

        $sql = "SELECT * 
                FROM book 
                WHERE year='$fillterYear'";

        $allBook = executeResult($sql);
    }

    if($_GET["year"]==1 && $_GET["filed"]==1 && $_GET["author"]==1 && $_GET["keyword"]==1){
        $sql = "SELECT * 
                FROM book 
                WHERE book.typebook IN(1,2)";
        $allBook = executeResult($sql);
    }

    
?>

<!-- Begin Breadcrumb -->
<nav id="nav-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="ml125 breadcrumb-item"><a href="http://localhost/Laptrinhweb/Home">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ebook</li>
    </ol>
</nav>
<!-- End Breadcrumb -->
<div id="wrapper">

    <!-- Bộ lọc -->
            <form id="flex1" method="GET" action="user/ebook.php">
                <div class="col-sm">
                    <p style="font-weight:600">Lọc theo thể loại:</p>

                    <select name="filed" class="form-select" aria-label="Default select example">
                        <option value="1" <?php if($fillterField=="all") echo "selected"; ?>>Tất cả</option>
                        <?php
                            $countField = count($fields);
                            for($i=0;$i<$countField;$i++){
                                echo '<option';
                                if($fillterField==$fields[$i]["title"]) echo " selected"; 
                                echo ' value="'.$fields[$i]["title"].'">'.$fields[$i]["title"].'</option>';
                            }
                        ?>
                    </select>

                </div>
                <div class="col-sm">
                    <p style="font-weight:600">Lọc theo tác giả:</p>
                    <select name="author" class="form-select" aria-label="Default select example">
                        <option value="1" <?php if($fillterAuthor=="all") echo "selected"; ?>>Tất cả</option>
                        <?php
                            $countAuthors = count($authors);
                            for($i=0;$i<$countAuthors;$i++){
                                echo '<option';
                                if($fillterAuthor==$authors[$i]["name"]) echo " selected"; 
                                echo ' value="'.$authors[$i]["name"].'">'.$authors[$i]["name"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm">
                    <p style="font-weight:600">Lọc theo từ khóa:</p>
                    <select name="keyword" class="form-select" aria-label="Default select example">
                        <option value="1" <?php if($fillterKeyword=="all") echo "selected"; ?>>Tất cả</option>
                        <?php
                            $countKeywords = count($keywords);
                            for($i=0;$i<$countKeywords;$i++){
                                echo '<option';
                                if($fillterKeyword==$keywords[$i]["title"]) echo " selected"; 
                                echo ' value="'.$keywords[$i]["title"].'">'.$keywords[$i]["title"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-sm">
                    <p style="font-weight:600">Lọc theo năm:</p>
                    <select name="year" class="form-select" aria-label="Default select example">
                        <option value="1" <?php if($fillterYear=="all") echo "selected"; ?>>Tất cả</option>
                        <?php
                            $countYears = count($years);
                            for($i=0;$i<$countYears;$i++){
                                echo '<option';
                                if($fillterYear==$years[$i]["year"]) echo " selected"; 
                                echo ' value="'.$years[$i]["year"].'">'.$years[$i]["year"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Lọc </button>
                </div> <!-- form-group// -->
            </form>

    <hr>

    <!-- show product -->
    <div class="showproduct">
        <?php
            $countBook = count($allBook);
            for($i=0;$i<$countBook;$i++){
                echo    '<div style="margin-bottom:10px" class="card">';
                echo        '<a href="">
                                <img class="card-img-top mt-2"
                                    src="'.$allBook[$i]["thumbnail"].'"
                                    alt="Card image cap">
                            </a>';
                echo        '<div class="card-body">';
                echo            '<a id="taga" href=""><h5 class="card-title">'.$allBook[$i]["name"].'</h5></a>
                                <hr />';
                echo            '<span class="card-text">'.number_format($allBook[$i]["price"]).'đ</span>';
                echo        '</div>';
                echo        '<a href="index.php?filed=1&author=1&keyword=1&year=1&card='.$allBook[$i]["isbn"].'"><button type="button" class="btnOrder btn btn-danger">Đặt hàng</button></a>';
                echo    '</div>';
            }
        ?>
    </div>
</div>

<?php
  require_once "../footer.php";
?>