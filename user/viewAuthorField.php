<?php
    require_once "../header.php";
    
    // get filed of Books
    $sql = "SELECT DISTINCT(title)
            FROM field";
    $fields = executeResult($sql);

    $fillterField  = $fillterKeyword1 = $fillterKeyword2   = '1';
    //handle fillter Field
    if(isset($_GET["filed"]) && $_GET["keyword1"]==1 && $_GET["keyword2"]==1){
        $fillterField = $_GET["filed"];

        $sql = "SELECT * 
                FROM author 
                WHERE author.phone IN (SELECT written.phone_author
                                        FROM field JOIN written ON field.isbn=written.isbn
                                        WHERE field.title LIKE '$fillterField')";

        $authors = executeResult($sql);
    }

    // get keyword of Books
    $sql = "SELECT DISTINCT(title)
            FROM keyword";
    $keywords = executeResult($sql);

    //handle fillter Keyword
    if($_GET["keyword1"]!=1 && $_GET["keyword2"]!=1){
        $fillterKeyword1 = $_GET["keyword1"];
        $fillterKeyword2 = $_GET["keyword2"];

        $sql = "SELECT * 
                FROM author 
                WHERE author.phone IN (SELECT written.phone_author
                                       FROM keyword JOIN written ON keyword.isbn=written.isbn
                                       WHERE keyword.title IN ('$fillterKeyword1','$fillterKeyword2'))";

        $authors = executeResult($sql);
    }

    if($_GET["filed"]==1  && $_GET["keyword1"]==1 && $_GET["keyword2"]==1){
        $sql = "SELECT name,phone 
            FROM author";
        $authors = executeResult($sql);
    }
?>
<form style="margin-top:70px" id="flex1" method="GET" action="user/viewAuthorField.php">
    <div class="col-sm">
        <p style="font-weight:600">Lọc tác giả cùng thể loại:</p>

        <select name="filed" class="form-select" aria-label="Default select example">
            <option value="1" <?php if($fillterField=="all" ) echo "selected" ; ?>>Tất cả</option>
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
        <p style="font-weight:600">Lọc theo từ khóa 1:</p>
        <select name="keyword1" class="form-select" aria-label="Default select example">
            <option value="1" <?php if($fillterKeyword1=="all" ) echo "selected" ; ?>>Tất cả</option>
            <?php
                            $countKeywords = count($keywords);
                            for($i=0;$i<$countKeywords;$i++){
                                echo '<option';
                                if($fillterKeyword1==$keywords[$i]["title"]) echo " selected"; 
                                echo ' value="'.$keywords[$i]["title"].'">'.$keywords[$i]["title"].'</option>';
                            }
                        ?>
        </select>
    </div>
    <div class="col-sm">
        <p style="font-weight:600">Lọc theo từ khóa 2:</p>
        <select name="keyword2" class="form-select" aria-label="Default select example">
            <option value="1" <?php if($fillterKeyword2=="all" ) echo "selected" ; ?>>Tất cả</option>
            <?php
                            $countKeywords = count($keywords);
                            for($i=0;$i<$countKeywords;$i++){
                                echo '<option';
                                if($fillterKeyword2==$keywords[$i]["title"]) echo " selected"; 
                                echo ' value="'.$keywords[$i]["title"].'">'.$keywords[$i]["title"].'</option>';
                            }
                        ?>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Lọc </button>
    </div> <!-- form-group// -->
</form>
<table style="margin-top:10px" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên</th>
            <th scope="col">SĐT</th>
        </tr>
    </thead>
    <tbody>
<?php
    $countAuthor = count($authors);
    for($i=0;$i<$countAuthor;$i++){
        echo '<tr>
                <th scope="row">'.($i+1).'</th>
                <td>'.$authors[$i]["name"].'</td>
                <td>'.$authors[$i]["phone"].'</td>
            </tr>';
    }
?>
        
    </tbody>
</table>
<?php
  require_once "../footer.php";
?>