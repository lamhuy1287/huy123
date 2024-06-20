<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    
  <style>
    .text{
        font-size:30px;
    }
    .ck-editor__editable {
            min-height: 500px;
        }
  </style>
</head>
<body>
<div class="d-flex vh-100">
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="text" >ADMIN</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/doAn/admin/home.php" class="nav-link  text-white" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Trang chủ
        </a>
      </li>
      <li>
        <a href="/doAn/admin/product/index.php" class="nav-link active text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Quản lý sản phẩm
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Quản lý đơn hàng
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Thống kê doanh thu
        </a>
      </li>
      <li>
        <a href="../../customer/home.php" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Trang khách hàng
        </a>
      </li>
    </ul>
    
  </div>
<!-- CONTENT -->
<div class="container">
    <h1 style="text-align:center;">Thêm sản phẩm mới</h1>
    <form method='POST' action="create_process.php" enctype="multipart/form-data">
        <input class="form-control mt-2 " name='product_code' placeholder="Nhập mã sản phẩm" required>
        <input class="form-control mt-2" name='name' placeholder="Nhập tên sản phẩm" required> 
        <input type="number" step="1" class="form-control mt-2" name='price' placeholder="Nhập giá sản phẩm" required>
        <input type="file" class="form-control mt-2" name='image' >  
        <input class="form-control mt-2" name='themes' placeholder="Phân loại sản phẩm" required>
        <div class="form-floating mt-2">
                <textarea name="description" class="form-control" placeholder="Leave a comment here"
                    id="editor"></textarea>
         </div>
        <button type="submit" class="btn btn-primary  mt-2">Thêm sản phẩm</button>
    </form>
</div>
</div>
<script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>