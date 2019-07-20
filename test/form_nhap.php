<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<style>
body {
  font-family: Arial;
  width: 70%;
  margin: 0 auto;
}

#loaisach,#tacgia {
  width: 80%;
  float: left;
}
#themloai,#themtacgia {
  width: 20%;
  float: right;

}

input[type=text],[type=date],[id=noidung],[type=file]{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    border-style: outset;
    border-bottom-width: 2px;
}

input[type=submit],[type=button] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=button]{
  margin: 8px;
}


input[type=submit]:hover, [type=button]:hover {
    background-color: #45a049;
}

div.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
select{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

</style>
<body>

<h3>Thông tin sách</h3>


<div class="container">
  <form enctype="multipart/form-data" action="insert_sach.php" method = "post" style="clear:both">

    <label>Mã Sách</label>
    <input type="text" id="masach" name="masach" placeholder="VD:0001">

    <label>Tên Sách</label>
    <input type="text" id="tensach" name="tensach" placeholder="VD:Trên Đường Bay">

  <div>

    <div> <label>Loại sách</label> </div>

    <div>
      <select class="select" id="loaisach" name="loaisach">
        <option value="kinhte">KT</option>
        <option value="toanhoc">AV</option>
        <option value="cntt">TOAN</option>
      </select>
    </div>
    <div id="themloai"><input type="button" value="thêm loại"></div>
  </div>
  <div>
    <div> <label>Tên Tác Giả</label> </div>
    <div>
      <input type="text" id="tacgia" name="tacgia" placeholder="VD:Tony buổi sáng">
    </div>
    <div id="themtacgia"><input type="button" value="thêm tác giả"></div>
  </div>
  <div>
    <div><label>Ngày xuất bản</label></div>
    <div><input type="date" name="ngayxuatban"></div>
  </div>
  
    <label>Ảnh bìa</label><br>
    <input type = "file"  name = "imgname"> 
  
  <div>
    <div><label>Giới thiệu về sách</label></div>
    <div><textarea id="noidung" name="noidung" placeholder="viết gì đó" style="height: 7em"></textarea></div>
  </div>

  <div><input type="submit" value="Thêm"></div>

  </form>
</div>


</body>
</html>
